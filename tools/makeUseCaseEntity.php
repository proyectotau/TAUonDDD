<?php
require "functions.php";

const INDENT = "    "; // 4 spaces
const DEBUG = false;

$resource_dir = 'resource/';
$resource_file = 'UseCaseEntityBus.tpl';

if( $argc != 4){
    echo "Usage:\n";
    echo "php tools/makeUseCaseEntity.php UseCase Entity fields,...\n";
    exit(1);
}

$usecase = strtolower($argv[1]);
$UseCase = ucwords(strtolower($argv[1]));

$entity = strtolower($argv[2]);
$Entity = ucwords(strtolower($argv[2]));

$public_field_attributes = explode(',', $argv[3]);

$template = file_get_contents($resource_dir . $resource_file);

if( DEBUG ){echo "Template:\n";echo $template;}

if( $usecase === 'read' ){
    $use_entity_if_read = 'use ProyectoTAU\TAU\Module\Administration\%Entity%\Domain\%Entity%;'; // TODO vendor & fcns must be in template only
    $next = str_replace('%use_entity_if_read%', $use_entity_if_read, $template);
    $return_entity_if_read = ': %Entity%';
    $next = str_replace('%return_entity_if_read%', $return_entity_if_read, $next);
    $next = str_replace('%return_if_read%', 'return', $next);
} else {
    $use_entity_if_read = '';
    $next = str_replace('%use_entity_if_read%', '', $template);
    $next = str_replace('%return_entity_if_read%', '', $next);
    $next = str_replace('%return_if_read%'.' ', '', $next);
}

if( DEBUG ){echo "next: %use_entity_if_read% => $use_entity_if_read\n";echo $next;}

$next = str_replace('%usecase%', $usecase, $next);
$next = str_replace('%Usecase%', $UseCase, $next);

if( DEBUG ){echo "next: %usecase%/%Usecase% => $usecase/$UseCase\n";echo $next;}

$next = str_replace('%entity%', $entity,$next);
$next = str_replace('%Entity%', $Entity, $next);

if( DEBUG ){echo "next: %entity%/%Entity% => $entity/$Entity\n";echo $next;}

$next = str_replace('%fields%', $argv[3], $next);

if( DEBUG ){echo "next: %fields% => $argv[3]\n";echo $next;}

$fcns = getNamespace($next);
$next = str_replace('%fcns%', $fcns, $next);

$fcer = getEntityRepository($next);
$next = str_replace('%fcer%', $fcer, $next);

if( DEBUG ){echo "next:\n%fcns% => $fcns\n%fcer% => $fcer\n";echo $next;}

$pa = "";
$aa = "";
foreach ($public_field_attributes as $field){
    $pa .= '$' . $field . ', ';
    $aa .=  INDENT . INDENT . INDENT . INDENT .
            "'" . $field . "' => \$" . $field . ",\n";
}
$pa = substr($pa, 0, strlen($pa)-2); // strip trailing , and space
$aa = substr($aa, 0, strlen($aa)-2); // strip trailing , and \n

$next = str_replace('%param_attributes%', $pa, $next);
$next = str_replace('%array_attributes%', $aa, $next);

if( DEBUG ){echo "result:\n";}
echo $next;

$destination = 'src' . namespace2dir($fcns) . '/' . $UseCase . $Entity . '.php';

if( ($count = file_force_contents($destination, $next)) === false ){
    echo 'file_put_contents returned false';
} else {
    echo $destination . ': ' . $count . ' bytes written';
}
