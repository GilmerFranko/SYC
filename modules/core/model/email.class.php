<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Este modelo incluye funciones variadas con utilización frecuente
 *
 * NOTA: ESTA CLASE NO ES UNICA; SE PARTICIONARÁ
 */

class Email extends Model
{

    public function __construct()
    {
        parent::__construct();
        $this->session = Core::model('session', 'core');
    }

    function __destruct()
    {
    }

    /**
     * Envía un correo electrónico
     *
     * @param string $template
     * @param string $email
     * @param array  $params
     * @return boolean
     */
    function sendEmail($template = 'normal', $email = NULL, $params = array(), $subject = null, $content = null)
    {
        // INCLUIR PLANTILLA
        require BG_INC . 'templates' . DS . 'mail' . DS . $template . '.mail.php';
        // CABECERAS
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: no-reply@correo.com' . "\r\n";
        // ENVIAR EMAIL
        $mail = mail($email, $subject, $content, $headers);

        return $mail;
    }
}
