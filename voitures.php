<?php
/*
 * On indique que les chemins des fichiers qu'on inclut
 * seront relatifs au répertoire src.
 */
set_include_path("./src");
//require_once('/users/21814195/private/mySql_config.php');


/* Inclusion des classes utilisées dans ce fichier */
require_once("Router.php");

/*try
{
    $bd = new PDO("mysql:host=".MYSQL_HOST.";port=".MYSQL_PORT.";dbname=".MYSQL_DB.";charset=utf8",MYSQL_USER,MYSQL_PASSWORD);
}
catch(erreur $e)
{
    die('error'.$e->getMessage());
}*/
try
{
    //$bd = new PDO("mysql:host=".MYSQL_HOST.";port=".MYSQL_PORT.";dbname=".MYSQL_DB.";charset=utf8",MYSQL_USER,MYSQL_PASSWORD);
    $dsn = 'mysql:host=localhost;port=3306;dbname=dm;charset=utf8';
    $user = 'root';
    $pass = '';
    $bd = new PDO($dsn, $user, $pass);
    //$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(erreur $e)
{
    die('error'.$e->getMessage());
}


$router = new Router();
$router->main($bd);
?>
