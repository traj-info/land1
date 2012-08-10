<?php

require_once('include/TSystemComponent.php');
require_once('include/TDbConnector.php');

function FilterData($variable)
{
	#gera warning se a conexao com o banco nao estiver estabelecida
	return mysql_real_escape_string(strip_tags($variable));
}

function NowDatetime()
{
	return date("Y-m-d H:i:s");
}

function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function geolocate($ip){
   $raw_html = file_get_contents("http://www.geody.com/geoip.php?ip=$ip");
   if(preg_match('/Location:(.*)/',$raw_html,$matches)){
     $location_raw = $matches[1];

     //Get rid of pesky HTML tags
     $location = preg_replace("/<[^>]*>/","",$location_raw);
     return $location;
   }else{
     return "ERROR";
   }
 }
 

$nome = FilterData($_POST['name']);
$email = FilterData($_POST['email']);
$telefone = FilterData($_POST['telefone']);
$msg = FilterData($_POST['message']);
$msg = FilterData($_GET['f']);

if($nome && $email && $telefone && $msg)
{
	// get data
	$datetime = NowDatetime();
	$ip = getRealIpAddr();
	$location = geolocate($ip);
	$ua = $_SERVER["HTTP_USER_AGENT"];
	// get browser
	// get os
	
	
	// record database register
	$db = new TDbConnector();
	$query = "INSERT INTO traj_rfp.rfp ('datetime', 'name', 'email', 'telefone', 'message', 'ip', 'location', 'from_code', 'browser', 'os', 'screen') VALUES ('$datetime', '$nome', '$email', '$telefone', '$message', '$ip', '$location', '$from_code', '$browser', '$os', '$screen')";
	$db->Query($query);
	
	
	
	
	// send email
}


?>