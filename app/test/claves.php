<?php

$clave1 = "Ruben22062003";
$clave2 = "Luis123";
$clave3 = "Maria123";

var_dump(password_hash($clave1, PASSWORD_BCRYPT)) ;
var_dump(password_hash($clave2, PASSWORD_BCRYPT)) ;
var_dump(password_hash($clave3, PASSWORD_BCRYPT)) ;