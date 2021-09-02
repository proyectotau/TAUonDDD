<?php

function getEntityRepository($content){
    return getArgumentOfKeyword($content, 'use');
}

function getNamespace($content)
{
    return getArgumentOfKeyword($content, 'namespace');
}

function getEntityXYRepository($content){
    $fcerX = getEntityRepository($content, 'use');
    $pos = strpos($content, $fcerX);
    $fcerY = getEntityRepository(substr($content, $pos+strlen($fcerX)), 'use');
    return [$fcerX, $fcerY];
}

function getArgumentOfKeyword($content, $keyword){
    if( ($pos = strpos($content, $keyword.' ')) === false ) {
        echo $keyword.' not found'."\n";
        exit(2);
    }
    $vendor = $pos+strlen($keyword)+1;

    if( ($pos = strpos($content, '\\', $pos)) === false ) {
        echo $keyword.' has no backslash'."\n";
        exit(3);
    }

    if( ($end = strpos($content, ';', $pos)) === false ) {
        echo $keyword.' does not end in ;'."\n";
        exit(4);
    }

    return substr($content, $vendor, $end-$vendor);
}

// TODO rename namespace2pathVendorStripped
function namespace2dir($namespace){
    $pos = strpos($namespace, '\\');
    $vs = substr($namespace, $pos);
    return str_replace('\\', '/', $vs); // DIRECTORY_SEPARATOR
}

// https://www.php.net/manual/en/function.file-put-contents.php#84180
function file_force_contents($destination, $contents)
{
    $parts = explode('/', $destination);
    $file = array_pop($parts);
    $dir = '';
    foreach ($parts as $part) {
        if (!is_dir($dir .= "$part/")) mkdir($dir);
    }
    if( is_file($destination) ){
        rename($destination, $destination . '.bak');
    }
    return file_put_contents($destination, $contents);
}
