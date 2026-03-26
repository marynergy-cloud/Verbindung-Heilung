<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "marynergy@gmail.com";
    $subject = "Marynergy: Nueva Captura del Momento (ES)";

    $message = "Se ha recibido una nueva captura del momento:\n";
    $message .= "------------------------------------------\n\n";
    
    foreach ($_POST as $key => $value) {
        $cleanKey = str_replace("q", "Pregunta ", $key);
        $message .= ucfirst($cleanKey) . ": " . $value . "\n";
    }

    $message .= "\n------------------------------------------\n";
    $message .= "Fin de la transmisión.";

    $headers = "From: no-reply@marynergy.com\r\n";
    $headers .= "Reply-To: " . $to . "\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

    if (mail($to, $subject, $message, $headers)) {
        echo "<html><body style='background:#000; color:#fff; font-family:sans-serif; text-align:center; padding-top:100px;'>";
        echo "<h2>Gracias. Tu captura del momento ha sido transmitida.</h2>";
        echo "<p><a href='/es/' style='color:#2d5a27; text-decoration:none;'>Volver al inicio</a></p>";
        echo "</body></html>";
    } else {
        echo "Error al enviar. Por favor, contáctame directamente en marynergy@gmail.com";
    }
} else {
    header("Location: /es/");
    exit;
}
?>
