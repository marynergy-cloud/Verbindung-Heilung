<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. ZIEL-ADRESSE
    $to = "marynergy@gmail.com";
    $subject = "Marynergy: Neue Momentaufnahme erhalten";

    // 2. DATEN STRUKTURIEREN
    $message = "Eine neue Momentaufnahme wurde eingereicht:\n";
    $message .= "------------------------------------------\n\n";
    
    // Geht alle Formularfelder (q1 bis q12) automatisch durch
    foreach ($_POST as $key => $value) {
        // Macht den Schlüssel lesbarer (z.B. q1 zu Frage 1)
        $cleanKey = str_replace("q", "Frage ", $key);
        $message .= ucfirst($cleanKey) . ": " . $value . "\n";
    }

    $message .= "\n------------------------------------------\n";
    $message .= "Ende der Übermittlung.";

    // 3. E-MAIL HEADER
    $headers = "From: no-reply@marynergy.com\r\n";
    $headers .= "Reply-To: " . $to . "\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

    // 4. VERSAND & RÜCKMELDUNG
    if (mail($to, $subject, $message, $headers)) {
        // Erfolg: Der Nutzer sieht eine Bestätigung
        echo "<html><body style='background:#000; color:#fff; font-family:sans-serif; text-align:center; padding-top:100px;'>";
        echo "<h2>Danke. Deine Momentaufnahme wurde übertragen.</h2>";
        echo "<p><a href='/' style='color:#2d5a27; text-decoration:none;'>Zurück zur Startseite</a></p>";
        echo "</body></html>";
    } else {
        // Fehlerfall
        echo "Fehler beim Senden. Bitte kontaktiere mich direkt unter marynergy@gmail.com";
    }
} else {
    // Falls jemand die Datei direkt aufruft, ohne das Formular zu nutzen
    header("Location: /");
    exit;
}
?>
