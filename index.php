<?php

header('Content-Type: text/html; charset=utf-8');
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);

include_once './config/config.php';

$verificador = true;
 
function __autoload($c){
    $diretorios = array(
        './',
        './to/',
        './model/',
        './libs/',
        './gui/',
        './dao/'
    );
    
    
   
    foreach ($diretorios as $dir) {
        if(file_exists($dir . $c . '.php')){
            require_once $dir . $c  . '.php';
            $verificador = false;
        }
    }
}

if ($verificador) {
    echo "<hr>";
    echo "<p>---  Tela Principal - Index.php!</p> ";
    echo "<hr>";
}

$app = new TApp();
$app->executar();
?>