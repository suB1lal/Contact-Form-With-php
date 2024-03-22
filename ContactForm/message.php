<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Formdan gelen verileri al
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$establishment = $_POST['establishment'];
$message = $_POST['message'];

require 'vendor/autoload.php'; // PHPMailer kütüphanesini dahil edin

// E-posta gönderme işlemini başlat
$mail = new PHPMailer(true);

try {
    // Sunucu ayarları
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // SMTP sunucu adresi
    $mail->SMTPAuth = true;
    $mail->Username = 'example@gmail.com'; // SMTP kullanıcı adı
    $mail->Password = 'stmp_key'; // SMTP parola
    $mail->SMTPSecure = 'tls'; // TLS, SSL veya boş olabilir
    $mail->Port = 587; // SMTP bağlantı noktası

    // Gönderen bilgileri
    $mail->setFrom($email, $name);
    // Alıcı e-posta adresi
    $mail->addAddress('alanexample@gmail.com', 'Recipient');

    // E-posta içeriği
    $mail->isHTML(true);
    $mail->Subject = 'FeedBack';
    $mail->Body    = "İsim: $name<br>Email: $email<br>Telefon: $phone<br>Kurum: $establishment<br>Mesaj: $message";

    // E-posta gönderme işlemi
    $mail->send();
    echo '
        <div class="container">
            <h1>Geri Bildirim İçin Teşekkürler!</h1>
            <p class="back">Forma <a href="index.html">git</a></p>
        </div>
    ';
} catch (Exception $e) {
    echo "E-posta gönderilirken bir hata oluştu: {$mail->ErrorInfo}";
}
?>

</body>
</html>