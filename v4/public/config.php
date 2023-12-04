<?php

$db_user = "uzi";
$db_pass = "7867";
$db_name = "login";

$db = new PDO('mysql:host=localhost;dbname=login;charset=utf8', $db_user, $db_pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
