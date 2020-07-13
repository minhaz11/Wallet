<?php

function sendMail($sitename,$sender,$reciever, $subject,$msg)
{
    $headers = "From: $sitename <$sender> \r\n";
    $headers .= "Reply-To:  <,$reciever> \r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=utf-8\r\n";
    return mail($reciever, $subject, $msg, $headers);
}
