<?php
require "functions.php";

const INDENT = "    "; // 4 spaces
const DEBUG = false;

$resource_dir = 'resource/';
$resource_file = 'Entity.tpl';

if( $argc != 3){
    echo "Usage:\n";
    echo "php tools/makeEntity.php Entity fields,...\n";
    exit(1);
}

$entity = strtolower($argv[1]);
$Entity = ucwords(strtolower($argv[1]));

$public_field_attributes = explode(',', $argv[2]);

$template = file_get_contents($resource_dir . $resource_file);

if( DEBUG ){echo 'Template';echo $template;}

$next = str_replace('%entity%', $entity, $template);
$next = str_replace('%Entity%', $Entity, $next);

$pdb = "/**\n";
foreach ($public_field_attributes as $field){
    $field = strtolower($field);
    $Field = ucwords($field);
    if( $field === 'id' ) {
        $pdb .= ' * @method void set' . $Field . '(int $' . $field . ")\n";
        $pdb .= ' * @method int get' . $Field . "()\n";
    } else {
        $pdb .= ' * @method void set' . $Field . '(string $' . $field . ")\n";
        $pdb .= ' * @method string get' . $Field . "()\n";
    }
}
$pdb .= " */\n";
$pdb = substr($pdb, 0, strlen($pdb)-1); // strip trailing \n

$next = str_replace('%phpdoc_block%', $pdb, $next);

if( DEBUG ){echo 'next';echo $next;}

$pa = "";
$pfa = "";
$sfa = "";
foreach ($public_field_attributes as $field){
    $field = strtolower($field);
    $Field = ucwords($field);
    $pa .= '$' . $field . ', ';
    $pfa .= "'" . $field . "', ";
    $sfa .=  INDENT . INDENT . '$this->set' . $Field . '($' . $field . ");\n";
}
$pa = substr($pa, 0, strlen($pa)-2); // strip trailing , and space
$pfa = substr($pfa, 0, strlen($pfa)-2); // strip trailing , and space
$sfa = substr($sfa, 0, strlen($sfa)-1); // strip trailing \n

$next = str_replace('%param_attributes%', $pa, $next);
$next = str_replace('%$public_field_attributes%', $pfa, $next);
$next = str_replace('%this_setter_field%', $sfa, $next);

/*if( DEBUG ){echo 'next';*/echo $next;//}

$destination = 'src' . namespace2dir($next) . '/' . $Entity . '.php';

if( ($count = file_force_contents($destination, $next)) === false ){
    echo 'file_put_contents returned false';
} else {
    echo $destination . ': ' . $count . ' bytes written';
}
