<?php
require "functions.php";

const INDENT = "    "; // 4 spaces
const DEBUG = false;

$resource_dir = 'resource/';
$resource_file = 'UseCaseXsFromYBus.tpl';

if( $argc != 4){
    echo "Usage:\n";
    echo "php tools/makeUseCaseXsFromY.php UseCase EntityX EntityY\n";
    exit(1);
}

$usecase = strtolower($argv[1]);
$UseCase = ucwords(strtolower($argv[1]));

$entityX = strtolower($argv[2]);
$EntityX = ucwords(strtolower($argv[2]));
$entityY = strtolower($argv[3]);
$EntityY = ucwords(strtolower($argv[3]));

$template = file_get_contents($resource_dir . $resource_file);

if( DEBUG ){echo "Template:\n";echo $template;}

$next = str_replace('%usecase%', $usecase, $template);
$next = str_replace('%Usecase%', $UseCase, $next);

if( DEBUG ){echo "next: %usecase%/%Usecase% => $usecase/$UseCase\n";echo $next;}

$next = str_replace('%entityX%', $entityX, $next);
$next = str_replace('%EntityX%', $EntityX, $next);

if( DEBUG ){echo "next: %entityX%/%EntityX% => $entityX/$EntityX\n";echo $next;}

$next = str_replace('%entityY%', $entityY, $next);
$next = str_replace('%EntityY%', $EntityY, $next);

if( DEBUG ){echo "next: %entityY%/%EntityY% => $entityY/$EntityY\n";echo $next;}

$fcns = getNamespace($next);
$next = str_replace('%fcns%', $fcns, $next);

$fcer = getEntityRepository($next);
$next = str_replace('%fcer%', $fcer, $next);

if( DEBUG ){echo "result:\n";}
echo $next;

$destination = 'src' . namespace2dir($fcns) . '/' . $UseCase . $EntityX . 'sFrom' . $EntityY . '.php';

if( ($count = file_force_contents($destination, $next)) === false ){
    echo 'file_put_contents returned false';
} else {
    echo $destination . ': ' . $count . ' bytes written';
}
