<?php

function namespace2dir($namespace){
    if( ($pos = strpos($namespace, 'namespace ')) === false ) {
        echo 'namespace not found'."\n";
        exit(2);
    }

    if( ($pos = strpos($namespace, '\\', $pos)) === false ) {
        echo 'namespace has no backslash'."\n";
        exit(3);
    }

    if( ($end = strpos($namespace, ';', $pos)) === false ) {
        echo 'namespace does not end in ;'."\n";
        exit(4);
    }

    $n = substr($namespace, $pos, $end-$pos);
    return str_replace('\\', '/', $n); // DIRECTORY_SEPARATOR
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
