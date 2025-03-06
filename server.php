<?php
header("Content-Type: application/json"); // La respuesta será en formato JSON
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
    $email = isset($_POST["email"]) ? trim($_POST["email"]) : "";
    $phone = isset($_POST["phone"]) ? trim($_POST["phone"]) : "";

    // Validaciones
    if (empty($nombre) || empty($email) || empty($phone)) {
        echo json_encode(["success" => false, "message" => "Todos los campos son obligatorios."]);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["success" => false, "message" => "El email no es válido."]);
        exit;
    }

    // Datos del correo
    $para = "destinatario@example.com"; // Cambia por el correo destino
    $asunto = "Nuevo mensaje de $nombre";
    $mensaje = "Nombre: $nombre\nEmail: $email\nTeléfono: $phone";
    
    $cabeceras = "From: jolmangonzalez5@gmail.com" . "\r\n" . // Cambia por tu email
                 "Reply-To: $email" . "\r\n" .
                 "X-Mailer: PHP/" . phpversion();

    // Enviar correo
    if (mail($para, $asunto, $mensaje, $cabeceras)) {
        echo json_encode(["success" => true, "message" => "Correo enviado correctamente."]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al enviar el correo."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Método no permitido."]);
}
?>
