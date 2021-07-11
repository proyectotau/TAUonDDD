<?php
require "functions.php";

// Usage:
// php tools/makeEntityUseCaseCommandHandler.php UseCase Entity fields,...

const INDENT = "    "; // 4 spaces
const DEBUG = false;

$resource_dir = 'resource/';
$resource_file = 'UseCaseEntityCommandHandler.tpl';

if( $argc != 4){
    echo "Usage:\n";
    echo "php tools/makeUseCaseEntityCommandHandler.php UseCase Entity fields,...\n";
    exit(1);
}

$usecase = strtolower($argv[1]);
$UseCase = ucwords(strtolower($argv[1]));

$entity = strtolower($argv[2]);
$Entity = ucwords(strtolower($argv[2]));

$public_field_attributes = explode(',', $argv[3]);

$template = file_get_contents($resource_dir . $resource_file);

if( DEBUG ){echo 'Template';echo $template;}

$next = str_replace('%usecase%', $usecase, $template);
$next = str_replace('%Usecase%', $UseCase, $next);

if( DEBUG ){echo 'next';echo $next;}

$next = str_replace('%entity%', $entity, $next);
$next = str_replace('%Entity%', $Entity, $next);

if( DEBUG ){echo 'next';echo $next;}

$cfa = "";
foreach ($public_field_attributes as $field){
    $field = strtolower($field);
    $cfa .= '$command->' . $field . ', ';
}
$cfa = substr($cfa, 0, strlen($cfa)-2); // strip trailing , and space

$next = str_replace('%command_field_attributes%', $cfa, $next);

/*if( DEBUG ){*/echo 'next';echo $next;//}

$destination = 'src' . namespace2dir($next) . '/' . $UseCase . $Entity . 'CommandHandler.php';

if( ($count = file_force_contents($destination, $next)) === false ){
    echo 'file_put_contents returned false';
} else {
    echo $destination . ': ' .$count . ' bytes written';
}
