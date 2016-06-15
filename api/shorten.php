<?php
/**
 * Created by PhpStorm.
 * User: OranL
 * Date: 2016/6/13
 * Time: 11:13
 */

require("database.php");

$sourceLink = reviseURL($_GET['su']);
$status = urlCheck($sourceLink);
$addTime = date('Y-m-d H:i:s');
$addIP = getIP();
$shortenedLink = "https://nya.pm/" . shortenUrl($sourceLink);

if ($status == "233"){
    addFunc($sourceLink, shortenUrl($sourceLink), $addTime, $addIP);
}

$test = array(
    "status" => $status,
    "sourceLink" => $sourceLink,
    "shortenedLink" => $shortenedLink,
    "addTime" => $addTime,
    "addIP" => $addIP,
    "test" => "OK"
);
echo json_encode($test);

/*
 * Check URL's legality
 */
function urlCheck($url){
    global $database;
    if (
        $database->count("URLInfo", [
            "url" => $url
        ]) >= 1){
        return "203";}

    if(substr_count($url, ".") > 0){
        if (
            preg_match('/http:\/\/[\w.]+[\w\/]*[\w.]*\??[\w=&\+\%]*/is', $url)
            or
            preg_match('/https:\/\/[\w.]+[\w\/]*[\w.]*\??[\w=&\+\%]*/is', $url)
        ){
            return "233";
        }
        else {
            return "201";
        }
    }
    else {
        return "202";
    }
}

/*
 * reviseUrl
 */
function reviseURL($url)
{
    $url = trim($url);
    if(
        preg_match('/http:\/\/[\w.]+[\w\/]*[\w.]*\??[\w=&\+\%]*/is', $url)
        or
        preg_match('/https:\/\/[\w.]+[\w\/]*[\w.]*\??[\w=&\+\%]*/is', $url)
    ){}
    else
    {
        $url = "http://" . $url;
    }
    return $url;
}


/*
 * Shorten URL
 */
function code62($x){
    $show = '';
    while ($x>0){
        $s = $x % 62;
        if ($s>35){
            $s = chr($s + 61);
        }
        elseif($s > 9 && $s <= 35){
            $s = chr($s + 55);
        }
        $show .= $s;
        $x = floor($x / 62);
    }
    return $show;
}
function shortenUrl($url){
    $url = crc32($url);
    $result = sprintf("%u", $url);
    return code62($result);
}

/*
 * Get IP address
 */
function getIP() {
    if (getenv('HTTP_CLIENT_IP')) {
        $ip = getenv('HTTP_CLIENT_IP');
    }
    elseif (getenv('HTTP_X_FORWARDED_FOR')) {
        $ip = getenv('HTTP_X_FORWARDED_FOR');
    }
    elseif (getenv('HTTP_X_FORWARDED')) {
        $ip = getenv('HTTP_X_FORWARDED');
    }
    elseif (getenv('HTTP_FORWARDED_FOR')) {
        $ip = getenv('HTTP_FORWARDED_FOR');

    }
    elseif (getenv('HTTP_FORWARDED')) {
        $ip = getenv('HTTP_FORWARDED');
    }
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
