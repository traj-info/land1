<?php
require_once('include/TSystemComponent.php');
require_once('include/TDbConnector.php');

function FilterData($variable)
{
	return strip_tags($variable);
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


// ###########################################################################################

// current datetime
$datetime = NowDatetime();

// get geolocation
$ip = getRealIpAddr();
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
$ip = mysql_real_escape_string($ip, $link);
$from_code = mysql_real_escape_string(FilterData($_GET['f']), $link); // from code query string
$browser = mysql_real_escape_string($browser, $link);
$os = mysql_real_escape_string($os, $link);
$screen = mysql_real_escape_string('', $link); // currently not supported
$lang = mysql_real_escape_string($lang, $link);
$browser_version = mysql_real_escape_string($browser_version, $link);
$country_code = mysql_real_escape_string($country_code, $link);
$country_name = mysql_real_escape_string($country_name, $link);
$city = mysql_real_escape_string($city, $link);
$local_time = mysql_real_escape_string($local_time, $link);
$latitude = mysql_real_escape_string($latitude, $link);
$longitude = mysql_real_escape_string($longitude, $link);
$local_timezone = mysql_real_escape_string($local_timezone, $link);

$query = "INSERT INTO traj_rfp.visits (datetime, ip, from_code, browser, os, screen, lang, browser_version, country_code, country_name, city, local_time, latitude, longitude, local_timezone, visit_key) VALUES ('$datetime', '$ip', '$from_code', '$browser', '$os', '$screen', '$lang', '$browser_version', '$country_code', '$country_name', '$city', '$local_time', '$latitude', '$longitude', '$local_timezone', '$visit_key')";
$db->Query($query);
//echo $query;
?>