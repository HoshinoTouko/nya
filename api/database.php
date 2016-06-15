<?php
/**
 * Created by PhpStorm.
 * User: OranL
 * Date: 2016/6/14
 * Time: 22:08
 */
require("medoo.php");
require("config.php");


$database = new medoo([
    'database_type' => 'mysql',
    'database_name' => $__DATABASE_NAME__,
    'server' => $__DATABASE_ADDRESS__,
    'username' => $__DATABASE_USER__,
    'password' => $__DATABASE_PASS__,
    'charset' => 'utf8'
]);


/**
 *Add items to database
 */
function addFunc($url, $shortName, $addTime, $addIP){
    global $database;
    $database->insert("URLInfo", [
        "url" => $url,
        "shortName" => $shortName,
        "addTime" => $addTime,
        "addIP" => $addIP
    ]);
}

function getFunc($shortName){
    global $database;
    $originalUrl = $database->get("URLInfo", "url", [
        "shortName" => $shortName
    ]);
    return $originalUrl;
}