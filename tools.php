<?php

define('DATA_ID', 0);
define('DATA_USER', 1);
define('DATA_TITLE', 2);
define('DATA_ARTICLE', 3);
define('DATA_DATE', 4);

define('GAS_DB_ID', 'AKfycbz0bs2jOGsg4rPs2Wh0F1mDs97DlRUeqFnXljW5h09yOqKgv5OJ47kK3SrDQs95CNT8_w');

function documentRoot(){
    if(!isset($_SERVER["SCRIPT_NAME"]) || !isset($_SERVER["SCRIPT_FILENAME"])){
      return false;
    }
    $name = $_SERVER["SCRIPT_NAME"];
    $filename = $_SERVER["SCRIPT_FILENAME"];
    $arr1 = array_reverse(str_split($name));
    $arr2 = array_reverse(str_split($filename));
    
    $len = 0;
    
    for($i = 0; $i < min(count($arr1), count($arr2)); $i++){
        if($arr1[$i] !== $arr2[$i]) break;
        $len++;
    }

    $dr = substr($filename, 0, count($arr2) - $len);
    return str_replace("/",DIRECTORY_SEPARATOR,$dr);
}

function insertHeader()
{
    include(sprintf("%s/comlit14/template/header.template.php", documentRoot()));
}

function insertFooter()
{
    include(sprintf("%s/comlit14/template/footer.template.php", documentRoot()));
}
