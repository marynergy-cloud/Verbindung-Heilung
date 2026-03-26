<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "marynergy@gmail.com";
    $subject = "Marynergy: New Snapshot Received (EN)";

    $message = "A new snapshot has been submitted:\n";
    $message .= "------------------------------------------\n\n";
    
    foreach ($_POST as $key => $value) {
        $cleanKey = str_replace("q", "Question ", $key);
        $message .= ucfirst($cleanKey) . ": " . $value . "\n";
    }

    $message .= "\n------------------------------------------\n";
    $message .= "End of transmission.";

    $headers = "From: no-reply@marynergy.com\r\n";
    $headers .= "Reply-To: " . $to . "\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

    if (mail($to, $subject, $message, $headers)) {
        echo "<html><body style='background:#000; color:#fff; font-family:sans-serif; text-align:center; padding-top:100px;'>";
        echo "<h2>Thank you. Your snapshot has been transmitted.</h2>";
        echo "<p><a href='/en/' style='color:#2d5a27; text-decoration:none;'>Back to Home</a></p>";
        echo "</body></html>";
    } else {
        echo "Error sending. Please contact me directly at marynergy@gmail.com";
    }
} else {
    header("Location: /en/");
    exit;
}
?>
