<?php
require "functions.php";

const INDENT = "    "; // 4 spaces
const DEBUG = false;

$resource_dir = 'resource/';
$resource_file = 'UseCaseEntityCommand.tpl';

if( $argc != 4){
    echo "Usage:\n";
    echo "php tools/makeUseCaseEntityCommand.php UseCase Entity fields,...\n";
    exit(1);
}

$usecase = strtolower($argv[1]);
$UseCase = ucwords(strtolower($argv[1]));

$Entity = ucwords(strtolower($argv[2]));

$public_field_attributes = explode(',', $argv[3]);

$template = file_get_contents($resource_dir . $resource_file);

if( DEBUG ){echo 'Template';echo $template;}

$next = str_replace('%usecase%', $usecase, $template);
$next = str_replace('%Usecase%', $UseCase, $next);

if( DEBUG ){echo 'next';echo $next;}

$next = str_replace('%Entity%', $Entity, $next);

if( DEBUG ){echo 'next';echo $next;}

$pfa = "";
foreach ($public_field_attributes as $field){
    $pfa .= INDENT . 'public $' . $field . ";\n";
}
$pfa = substr($pfa, 0, strlen($pfa)-1); // strip trailing \n

$next = str_replace('%public_field_attributes%', $pfa, $next);

if( DEBUG ){echo 'next';echo $next;}

$pa = "";
foreach ($public_field_attributes as $field){
    $pa .= '$' . $field . ', ';
}
$pa = substr($pa, 0, strlen($pa)-2); // strip trailing , and space

$next = str_replace('%param_attributes%', $pa, $next);

if( DEBUG ){echo 'next';echo $next;}

$tfa = "";
foreach ($public_field_attributes as $field){
    $tfa .= INDENT . INDENT . '$this->' . $field . ' = $' . $field . ";\n";
}
$tfa = substr($tfa, 0, strlen($tfa)-1); // strip trailing \n

$next = str_replace('%this_field_attributes%', $tfa, $next);

/*if( DEBUG ){echo 'next';*/echo $next;//}

$destination = 'src' . namespace2dir($next) . '/' . $UseCase . $Entity . 'Command.php';

if( ($count = file_force_contents($destination, $next)) === false ){
    echo 'file_put_contents returned false';
} else {
    echo $destination . ': ' . $count . ' bytes written';
}
