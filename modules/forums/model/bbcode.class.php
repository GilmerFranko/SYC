<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Este modelo se encarga de gestionar lo relacionado a los threads (temas)
 *
 */
class bbcode extends Model
{

  public function sanitizeBBCode($bbcode)
  {
    // Permitir solo ciertos tags de BBCode
    $allowed_tags = ['b', 'i', 'u', 'url', 'img', 'quote', 'code'];

    // Eliminar cualquier tag de BBCode no permitido
    $bbcode = preg_replace_callback('/\[(\w+)([^\]]*)\](.*?)\[\/\1\]/s', function ($matches) use ($allowed_tags)
    {
      return in_array($matches[1], $allowed_tags) ? $matches[0] : '';
    }, $bbcode);

    // Escapar cualquier intento de inyección de script o HTML
    return htmlspecialchars($bbcode, ENT_QUOTES, 'UTF-8');
  }

  public function validateBBCode($bbcode)
  {
    // Validar el anidamiento correcto del BBCode
    $stack = [];
    $bbcode = preg_replace('/\[(\/?\w+)[^\]]*\]/', '[$1]', $bbcode); // Simplificar tags

    if (preg_match_all('/\[(\/?\w+)\]/', $bbcode, $matches))
    {
      foreach ($matches[1] as $tag)
      {
        if ($tag[0] == '/')
        {
          $last = array_pop($stack);
          if ($last != substr($tag, 1))
          {
            return false; // BBCode no está bien anidado
          }
        }
        else
        {
          array_push($stack, $tag);
        }
      }
    }

    return empty($stack); // Verificar si el stack está vacío (todo está cerrado correctamente)
  }

  public function convertBBCodeToHTML($bbcode)
  {
    // Esta función debe ser segura y confiable, usar una librería especializada es recomendable
    $bbcode = nl2br($bbcode); // Convertir nuevas líneas a <br>
    $bbcode = preg_replace('/\[b\](.*?)\[\/b\]/s', '<strong>$1</strong>', $bbcode);
    $bbcode = preg_replace('/\[i\](.*?)\[\/i\]/s', '<em>$1</em>', $bbcode);
    $bbcode = preg_replace('/\[u\](.*?)\[\/u\]/s', '<u>$1</u>', $bbcode);
    $bbcode = preg_replace('/\[url=(.*?)\](.*?)\[\/url\]/s', '<a href="$1" rel="noopener noreferrer">$2</a>', $bbcode);
    $bbcode = preg_replace('/\[img\](.*?)\[\/img\]/s', '<img src="$1" alt="User Image">', $bbcode);
    // Otros tags pueden ser añadidos aquí

    return $bbcode;
  }

  public function validateLength($bbcode, $max_length = 10000)
  {
    return strlen($bbcode) <= $max_length;
  }

  public function validateImageURLs($bbcode)
  {
    if (preg_match_all('/\[img\](.*?)\[\/img\]/s', $bbcode, $matches))
    {
      foreach ($matches[1] as $url)
      {
        if (!filter_var($url, FILTER_VALIDATE_URL) || !@getimagesize($url))
        {
          return false; // URL no válida o no es una imagen
        }
      }
    }
    return true;
  }

  public function detectOffensiveContent($bbcode)
  {
    // Implementar filtro básico de contenido ofensivo (puedes usar listas de palabras prohibidas)
    $offensive_words = ['badword1', 'badword2', 'badword3'];
    foreach ($offensive_words as $word)
    {
      if (stripos($bbcode, $word) !== false)
      {
        return true; // Contenido ofensivo encontrado
      }
    }
    return false;
  }
}
