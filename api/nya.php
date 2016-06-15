<?php
/**
 * Created by PhpStorm.
 * User: OranL
 * Date: 2016/6/15
 * Time: 13:07
 */

require("database.php");

$shortName = $_GET["nya"];
$url = getFunc($shortName);
$count = $database->count("URLInfo", [
    "shortName" => $shortName
]);

?>
<html>
<head>
    <title>Nya短链 - <?php echo $url; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<?php

if ($count == 0){
    echo "</head>";
    echo "<body>";
    echo "喵呜！出错啦~
    <br>可能是未添加该记录
    <br>nya.pm于近日重构，2016-06-15以前的数据可能被清除，带来的不便请谅解";
}
else {
    echo '<meta http-equiv="refresh" content="1; url=';
    echo $url;
    echo '">';
    echo '</head>';
    echo '<body>';
    echo '喵呜！正在跳转~';

    $database->update("URLInfo",[
        "stat[+]" => 1
    ],[
        "shortName" => $shortName
    ]);
}

echo "</body>";
echo "</html>";

