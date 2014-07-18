<?php

function return_url($input) {

    
    $output = str_replace(
    array('á', 'č', 'ď', 'é', 'ě', 'í', 'ň', 'ó', 'ř', 'š', 'ť', 'ú', 'ů', 'ý', 'ž', ' ', '/', '.', '@'),
    array('a', 'c', 'd', 'e', 'e', 'i', 'n', 'o', 'r', 's', 't', 'u', 'u', 'y', 'z', '-', '', '', ''),
    $input);

    $output = strtolower($output);

    return $output;
}

//test
$_POST["dar"] = "1";
$_POST["email"] = "michalklapal@gmail.com";

//echo $_POST["dar"];
//echo $_POST["email"];

//update json

if ($_POST["dar"] && $_POST["email"]){

  if (file_exists('svatebnidary.json')){
    $data = json_decode(file_get_contents('svatebnidary.json'), true);
  }  else {
    $data = null;
  }


  //print_r( $data );

  $_POST['nazev'] = $data['data'][$_POST["dar"]]['nazev'];

  $data['data'][$_POST["dar"]]['status'] = "zamluveno";

  json_encode($data);

  $file = 'svatebnidary.json';
  file_put_contents($file, json_encode($data));

  //exit;


//odešle email zákazníkovi a nám
    $message = ('
      Dobrý den,
      <br><br>
      Děkujeme za rezervaci daru!
      <br><br>
      Název daru: '.$_POST["nazev"].'
      <br><br>
      Email: '.$_POST["email"].'      
      <br><br>
      Těšíme se 18.10.2014!
      <br><br>
      Hanka a Michal
    ');
    
    //echo $message;
    //echo "true";
    //exit;
    
    //uložení do souboru html
    $html_order = '../emails/'.return_url($_POST['email']).'_'.date("ymdhis").'.html';
    //echo $html_order;
    $file = fopen($html_order, "w+");
    fwrite($file, $message);
    fclose($file);
    
    //echo "true";
    //exit;
    
    //odeslání mailu - zákazník
    require_once('../ext/phpmailer/class.phpmailer.php'); //nalinkuješ soubor class.phpmailer.php
    $mail = new PHPMailer(); //vytvoříš objekt mail
    
    $mail->CharSet = "UTF-8";
    $mail->ContentType     = "text/html";
    
    $add[] = array($_POST['email'], $_POST['name']);
    $add[] = array('michalklapal@gmail.com', 'Michal Klapal');
    
    foreach ($add as $key => $val) {
    
      $mail->SetFrom('michalklapal@gmail.com', 'Michal Klapal');
      $mail->AddReplyTo('michalklapal@gmail.com', 'Michal Klapal');
      $mail->AddAddress($val[0], $val[1]);
      
      $mail->Subject    = "Hanka a Michal - rezervace daru"; //předmět mailu 
      $mail->AltBody    = strip_tags($message); // optional, comment out and test
      $mail->MsgHTML($message);
    
      if(!$mail->Send()) {
          echo "Mailer Error: " . $mail->ErrorInfo; //pokud se mail neodešle, ohlásí chybu
      } 
      $mail->ClearAddresses();
    }

    echo "true";

} else {

  echo "false";

}

?>
