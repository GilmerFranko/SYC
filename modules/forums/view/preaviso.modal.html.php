<div id="antiSpam" class="" style="display: none;">
  <div class="card-content">
    <div style="text-align:center;display:block">
      <a href="#" class="text-secondary" onclick="onAcceptedAdultContent(event)"><strong>ENTRAR</strong></a>
      <br>
      <span style="color:var(--bs-gray-800);">(supone la aceptación de las siguientes condiciones)</span>
    </div>
    <div style="color: var(--bs-gray-800);padding: 0 160px;">
      <br>
      <br>
      Soy <strong>mayor de edad</strong> y soy consciente de que en esta sección se puede mostrar <strong>Contenido para adultos</strong>.
      <br>
      <br>
      1- Soy adulto entendiéndose como tal a mayor de 18 años (o la edad legal en mi país de residencia).
      <br>
      <br>
      2- Estoy de acuerdo en ver este tipo de material para adultos y no utilizarlo con fines comerciales.
      <br>
      <br>
      3- Declaro que la visualización de material e imágenes para adultos no está prohibido ni infringe ninguna ley en la comunidad donde resido, ni de mi proveedor de servicios o el local desde donde accedo.
      <br>
      <br>
      4- No exhibiré este material a menores o a cualquier otra persona que pueda resultar ofendida o que no cumpla con estas condiciones.
    </div>
  </div>
</div>

<?php if (!isset($_COOKIE['hasAcceptedAdultContent'])): ?>
  <script>
    // Cargar contenido de #antiSpam en .preAviso al cargar la pagina
    $(document).ready(function() {
      $('.preAviso').html($('#antiSpam').html());
    });
  </script>
<?php endif ?>

<script>
  // Función para crear una cookie
  function setCookie(name, value, days) {
    var date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000)); // Añadir días
    var expires = "expires=" + date.toUTCString();
    document.cookie = name + "=" + value + ";" + expires + ";path=/"; // cookie accesible en todas las páginas
  }

  // Función para obtener el valor de una cookie
  function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') c = c.substring(1, c.length);
      if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
  }

  // Verificar si la cookie ya existe
  document.addEventListener("DOMContentLoaded", function() {
    if (getCookie('hasAcceptedAdultContent')) {
      // Si la cookie existe, ocultamos el contenido del aviso
      document.querySelector('.preAviso').style.display = 'none';
    } else {
      // Si no existe, mostramos el contenido de antiSpam
      document.querySelector('.preAviso').style.display = 'block';
    }

  });

  // Evento al hacer clic en "ENTRAR"
  function onAcceptedAdultContent(e) {
    e.preventDefault(); // Prevenir la acción por defecto del enlace
    // Crear cookie que dura 31 días
    setCookie('hasAcceptedAdultContent', 'true', 31);
    // Ocultar el aviso de antiSpam
    document.querySelector('.preAviso0').style.display = 'block';
    document.querySelector('.preAviso').remove();
  }
</script>