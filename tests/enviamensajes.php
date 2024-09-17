<?php
// Conexión a la base de datos
$host = '127.0.0.1';
$dbname = 'sexoycontacto';
$username = 'root';
$password = '';


$mysqli = new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_error)
{
  echo "Error en la conexión: " . $mysqli->connect_error;
  exit();
}

// Obtener todos los miembros
$members = $mysqli->query("SELECT member_id FROM members")->fetch_all(MYSQLI_ASSOC);

// Cantidad de mensajes a generar
$cantidadMensajes = 50; // Puedes cambiar esta cantidad

// Array de frases aleatorias para los mensajes
$mensajesAleatorios = [
  "¡Hola! ¿Cómo estás?",
  "¿Qué tal tu día?",
  "Tengo una pregunta para ti.",
  "¿Quieres salir este fin de semana?",
  "¡Me encanta este lugar!",
  "Nos vemos pronto.",
  "Te enviaré más detalles después.",
  "¡Felicidades por tu logro!",
  "¿Te gustaría participar en este evento?",
  "Estoy trabajando en un nuevo proyecto."
];

// Imagenes de ejemplo para mensajes
$imagenesEjemplo = [
  'https://via.placeholder.com/150',
  'https://via.placeholder.com/200',
  'https://via.placeholder.com/300',
  null  // Algunos mensajes sin imagen
];

// Insertar mensajes aleatorios
for ($i = 0; $i < $cantidadMensajes; $i++)
{
  // Seleccionar aleatoriamente miembros
  $from_member_id = $members[array_rand($members)]['member_id'];
  do
  {
    $to_member_id = $members[array_rand($members)]['member_id'];
  } while ($from_member_id == $to_member_id); // Asegurarse de que el remitente y el destinatario no sean la misma persona

  // Generar contenido de mensaje y imagen
  $content = $mensajesAleatorios[array_rand($mensajesAleatorios)];
  $image_url = $imagenesEjemplo[array_rand($imagenesEjemplo)];
  $sent_at = time(); // Tiempo actual en formato UNIX

  // Insertar el mensaje en la base de datos
  $stmt = $mysqli->prepare("INSERT INTO members_messages (from_member_id, to_member_id, content, image_url, sent_at, is_read) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("iissss", $from_member_id, $to_member_id, $content, $image_url, $sent_at, $is_read);
  $stmt->execute();
}

echo "Mensajes generados exitosamente.";
