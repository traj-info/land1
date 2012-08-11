<?php
require_once('include/TSystemComponent.php');
require_once('include/TDbConnector.php');
require_once('include/class.phpmailer.php');
require_once('include/class.smtp.php');

function FilterData($variable)
{
	return strip_tags($variable);
}

function NowDatetime()
{
	return date("Y-m-d H:i:s");
}

function mysqlToBR( $mysqlTime ) {
	$dateTime = explode( ' ', $mysqlTime );
	$dateTime[0] = explode( '-', $dateTime[0] );
	$dateTime = $dateTime[0][2].'/'.$dateTime[0][1].'/'.$dateTime[0][0].' '.$dateTime[1];
	
	return $dateTime;
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

function SendMail($from, $to, $subject, $content)
{
	// Create PHPMailer object
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail = new PHPMailer();

	// Define server connection info
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->IsSMTP(); 												# Will be SMTP
	$mail->Host 		= 'smtp.gmail.com'; 						# SMTP server add
	$mail->SMTPAuth 	= 'true';	 								# Does it use SMTP auth? (optional)
	$mail->SMTPSecure 	= 'ssl'; 									# Sets the prefix to the server
	$mail->Port			= '465';									# Set the SMTP port for the server
	$mail->Username		= 'trajettoria.ti@gmail.com';				# SMTP server user
	$mail->Password 	= base64_decode('MTBwY3NQWkFT'); 			# SMTP server password

	// Define sender
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->From = 'trajettoria.ti@gmail.com';											# Your e-mail
	$mail->FromName = 'RFP-Trajettoria';							# Your name

	// Define receiver(s)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->AddAddress($to, 'Trajettoria');

	// Define msg type
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->IsHTML(true); 											# Will be HTML
	$mail->CharSet = 'utf-8'; // Charset (optional)

	// And finally the MESSAGE (Subject and Body)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->Subject  = $subject;		 								# Subject
	$mail->Body = $content;											# Body
	$mail->AltBody = "";											# Alternative Body for non-HTML content

	// Send e-mail
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$sent = $mail->Send();											# Pa!

	// Cleaners
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->ClearAllRecipients();
	$mail->ClearAttachments();
	
	return $sent;
}

// ###########################################################################################

$nome = FilterData($_POST['name']);
$email = FilterData($_POST['email']);
$telefone = FilterData($_POST['telefone']);
$msg = nl2br(FilterData($_POST['message']));
$from_code = FilterData($_POST['f']);
$screen = FilterData($_POST['r']);
$visit_key = FilterData($_POST['k']);

if(!empty($nome) && !empty($email) && !empty($msg))
{
	// current datetime
	$datetime = NowDatetime();
	
	// get geolocation
	$ip = getRealIpAddr();
	//$ip = "201.6.224.28";
	
	$g = file_get_contents("http://api.easyjquery.com/ips/?ip=".$ip."&full=true");
	$g = json_decode($g);
	$country_code = $g->COUNTRY;
	$country_name = $g->countryName;
	$city = $g->regionName;
	if(trim($g->cityName) != "") $city .= "|" . $g->cityName;
	$local_time = $g->localTime;
	$latitude = $g->cityLatitude;
	$longitude = $g->cityLongitude;
	$local_timezone = $g->localTimeZone;
	
	// get remote agent data
	$ua = urlencode($_SERVER["HTTP_USER_AGENT"]);
	$r = file_get_contents("http://www.useragentstring.com/?uas=" . $ua . "&getJSON=all");
	$r = json_decode($r);
	$browser = $r->agent_name;
	$browser_version = $r->agent_version;
	$os = $r->os_name;
	$lang = $r->agent_language;
	
	// record database register
	$db = new TDbConnector();
	$link = $db->GetDbLink();
	$nome = mysql_real_escape_string($nome, $link);
	$email = mysql_real_escape_string($email, $link);
	$telefone = mysql_real_escape_string($telefone, $link);
	$msg = mysql_real_escape_string($msg, $link);
	$ip = mysql_real_escape_string($ip, $link);
	$from_code = mysql_real_escape_string($from_code, $link);
	$browser = mysql_real_escape_string($browser, $link);
	$os = mysql_real_escape_string($os, $link);
	$screen = mysql_real_escape_string($screen, $link);
	$lang = mysql_real_escape_string($lang, $link);
	$browser_version = mysql_real_escape_string($browser_version, $link);
	$country_code = mysql_real_escape_string($country_code, $link);
	$country_name = mysql_real_escape_string($country_name, $link);
	$city = mysql_real_escape_string($city, $link);
	$local_time = mysql_real_escape_string($local_time, $link);
	$latitude = mysql_real_escape_string($latitude, $link);
	$longitude = mysql_real_escape_string($longitude, $link);
	$local_timezone = mysql_real_escape_string($local_timezone, $link);
	$visit_key = mysql_real_escape_string($visit_key, $link);
	
	$query = "INSERT INTO traj_rfp.rfp (datetime, name, email, telefone, message, ip, from_code, browser, os, screen, lang, browser_version, country_code, country_name, city, local_time, latitude, longitude, local_timezone, visit_key) VALUES ('$datetime', '$nome', '$email', '$telefone', '$msg', '$ip', '$from_code', '$browser', '$os', '$screen', '$lang', '$browser_version', '$country_code', '$country_name', '$city', '$local_time', '$latitude', '$longitude', '$local_timezone', '$visit_key')";
	$db->Query($query);

	//echo $query;

	// send email
	$content = "[RFP enviada em " . mysqlToBR($datetime) . "]<br>";
	$content .= "FROM_CODE=$from_code<hr>";
	$content .= "Nome: <strong>$nome</strong><br>";
	$content .= "E-mail: <strong><a href='mailto:$email'>$email</a></strong><br>";
	$content .= "Telefone: <strong>$telefone</strong><br>";
	$content .= "Mensagem: <br><pre>$msg</pre><hr>";
	$content .= "[Dados coletados]<br>";
	$content .= "IP: $ip<br>";
	$content .= "País: $country_name ($country_code)<br>";
	$content .= "Cidade: $city (Latitude: $latitude | Longitude: $longitude)<br>";
	$content .= "Hora local: $local_time<br>";
	$content .= "Sistema operacional: $os<br>";
	$content .= "Browser: $browser<br>";
	$content .= "Browser version: $browser_version<br>";
	$content .= "Local timezone: $local_timezone<br>";
	$content .= "Resolução do monitor: $screen<br>";
	$content .= "Chave de acesso: $visit_key<br>";
	
	SendMail('sites@trajettoria.com', 'sites@trajettoria.com', '[RFP] code=' . $from_code . ' | de=' . $nome, $content);
	
	echo 'ok';
?>	

<!-- Google Code for RFP webdesign médico Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1019582273;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "tEIRCPea1gMQwa6W5gM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1019582273/?value=0&amp;label=tEIRCPea1gMQwa6W5gM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

<?php
}
else
{
	//echo 'Erro';
}
?>