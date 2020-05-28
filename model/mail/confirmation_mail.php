<?php

function envoyer_mail($adresse, $sujet, $message){
    require_once "PHPMailer/PHPMailerAutoload.php";

    $mail = new PHPMailer();

    $mail->Host = 'smtp.gmail.com';
    $mail->Port = '587';
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Username = 'insea.inscription@gmail.com';
    $mail->Password = 'insea2020';

    $mail->SetFrom('insea.inscription@gmail.com', 'INSEA - Inscription en ligne');
    $mail->AddAddress($adresse);
    $mail->addReplyTo('insea.inscription@gmail.com');
    $mail->isHTML(true);
    $mail->Subject = utf8_decode($sujet);
    $mail->Body = $message;

    return $mail->send(); 
}