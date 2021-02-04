<?php


session_start();
//var_dump($_SESSION); // vue sur d'éventuels messages d'erreurs tel qu'un mail identique voir insertClient() dans controllers

require_once "conf/fonctions.php";
require_once "controllers.php";
require_once "conf/global.php";

//var_dump($_GET);

$route = (isset($_GET["route"]))? $_GET["route"] : "showhome";



?>