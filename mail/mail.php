<?php

error_reporting(E_ALL);

// Genera un boundary
$mail_boundary = "=_NextPart_" . md5(uniqid(time()));

$to = "ediltecnicaparrino@alice.it";
$subject = "Nuova email da dariomichelasposi.it";
$sender = "postmaster@dariomichelasposi.it";

$name = $_POST{'name'};
$user_subject = $_POST{'subject'};
$email = $_POST{'email'};
$message = $_POST['message'];

$headers = "From: $sender\n";
$headers .= "MIME-Version: 1.0\n";
$headers .= "Content-Type: multipart/alternative;\n\tboundary=\"$mail_boundary\"\n";
$headers .= "X-Mailer: PHP " . phpversion();

// Corpi del messaggio nei due formati testo e HTML
$text_msg = "messaggio in formato testo";
$html_msg = "<b>messaggio</b> in formato <p><a href='http://www.aruba.it'>html</a><br><img src=\"http://hosting.aruba.it/image_top/top_01.gif\" border=\"0\"></p>";

// Costruisci il corpo del messaggio da inviare
$msg = "This is a multi-part message in MIME format.\n\n";
$msg .= "--$mail_boundary\n";
$msg .= "Content-Type: text/plain; charset=\"iso-8859-1\"\n";
$msg .= "Content-Transfer-Encoding: 8bit\n\n";
$msg .= "Questa è una e-Mail di test inviata dal servizio Hosting di Aruba.it per la verifica del corretto funzionamento di PHP mail()function.

Aruba.it";  // aggiungi il messaggio in formato text

$msg .= "\n--$mail_boundary\n";
$msg .= "Content-Type: text/html; charset=\"iso-8859-1\"\n";
$msg .= "Content-Transfer-Encoding: 8bit\n\n";
$msg .="Nome: ".$name."<br>";
$msg .= "Oggetto: ".$user_subject."<br>";
$msg .= "Email: ".$email."<br><br>";
$msg .= "Messaggio: ".$message."";
// Boundary di terminazione multipart/alternative
$msg .= "\n--$mail_boundary--\n";

// Imposta il Return-Path (funziona solo su hosting Windows)
ini_set("sendmail_from", $sender);

// Invia il messaggio, il quinto parametro "-f$sender" imposta il Return-Path su hosting Linux
if (mail($to, $subject, $msg, $headers, "-f$sender")) {
    header("location: ./mail-success.html");
} else {
    echo "<br><br>Recapito e-Mail fallito!";
}

?>


