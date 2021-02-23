<?php

function convertSubject($subject){
  return "=?UTF-8?B?".base64_encode($subject)."?=";
}

$toEmail = 'mateusz.polak@kronnig.com';
$subject = convertSubject('Formularz kontaktowy LP');

$headers = "From: " . strip_tags($toEmail) . "\r\n";
$headers .= "Reply-To: ". strip_tags($toEmail) . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=utf-8\r\n";

$WartoscSamochodu = $_POST['WartoscSamochodu'];
$WplataWlasna = $_POST['WplataWlasna'];
$Wykup = $_POST['Wykup'];
$OkresLeasingu = $_POST['OkresLeasingu'];
$Nip = $_POST['Nip'];
$Email = $_POST['Email'];
$Tel = $_POST['Tel'];
$Accept = $_POST['Accept'];

$message = '<html><body>';
$message .= '<table>';
$message .= '<tr>';
$message .= '<td>Wartość Samochodu</td><td>'.$WartoscSamochodu.'</td>';
$message .= '</tr>';
$message .= '<tr>';
$message .= '<td>Wpłata Własna</td><td>'.$WplataWlasna.'</td>';
$message .= '</tr>';
$message .= '<tr>';
$message .= '<td>Wykup</td><td>'.$Wykup.'</td>';
$message .= '</tr>';
$message .= '<tr>';
$message .= '<td>Okres Leasingu</td><td>'.$OkresLeasingu.'</td>';
$message .= '</tr>';
$message .= '<tr>';
$message .= '<td>NIP</td><td>'.$Nip.'</td>';
$message .= '</tr>';
$message .= '<tr>';
$message .= '<td>Email</td><td>'.$Email.'</td>';
$message .= '</tr>';
$message .= '<tr>';
$message .= '<td>Telefon</td><td>'.$Tel.'</td>';
$message .= '</tr>';
$message .= '<tr>';
$message .= '<td>Akceptacja</td><td>'.$Accept.'</td>';
$message .= '</tr>';
$message .= '</table>';
$message .= "</body></html>";

$clientSubject = convertSubject("Porównywarka leasingowa Floteo");
$clientEmail = $Email;

$clientMessage = '<html><body>';
$clientMessage .= 'Gratulujemy wyboru!<br><br>';
$clientMessage .= 'Niebawem skontaktuje się z Tobą nasz Doradca, celem przedstawienia najkorzystniejszych w Polsce ofert leasingowych.<br><br>';
$clientMessage .= 'Pracujemy od poniedziałku do piątku w godzinach 9:00-17:00.<br><br>';
$clientMessage .= 'Do usłyszenia,<br>';
$clientMessage .= 'Zespół Floteo<br>';
$clientMessage .= '+48 880 556 566<br>';
$clientMessage .= '<a href="mailto:kontakt@floteocars.pl">kontakt@floteocars.pl</a>';
$clientMessage .= "</body></html>";

if(mail('kontakt@floteocars.pl', $subject, $message, $headers) && mail($clientEmail, $clientSubject, $clientMessage, $headers)){
  echo '1';
}else{ 
  echo '0';
}

?>