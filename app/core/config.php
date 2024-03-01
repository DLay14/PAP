<?php

define("WEBSITE_TITLE", 'My shop' );

define('DB_NAME', "pap");
define('DB_USER', "root");
define('DB_PASS', "1234");

define('DEBUG' , TRUE);

if(DEBUG){
    ini_set('display_errors', 1);
}
else
{
    ini_set('display_errors', 0);
}
