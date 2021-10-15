<?php

function IsInjected($str)
{
    $injections = array('(\n+)',
           '(\r+)',
           '(\t+)',
           '(%0A+)',
           '(%0D+)',
           '(%08+)',
           '(%09+)'
           );
               
    $inject = join('|', $injections);
    $inject = "/$inject/i";
    
    if(preg_match($inject,$str))
    {
      return true;
    }
    else
    {
      return false;
    }
}


  $name = $_POST['name'];
  $visitor_email = $_POST['email'];
  $email_subject = $_POST['subject'];
  $email_body = $_POST['message'];


  if(IsInjected($visitor_email))
  {
      echo "Bad email value!";
      exit;
  } else {

	$to = "info@minimumviabledata.com";

	$headers = "From: $visitor_email \r\n";

	$headers .= "Reply-To: $visitor_email \r\n";

	mail($to, $email_subject, $email_body, $headers);

	header('Location: https://minimumviabledata.com/thankyou');
  }
?>