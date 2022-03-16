<?php


if( ! function_exists("app") ){
    function app($alias = null){
        static $app = null;

        if( $app == null ){
            $app = new ProyectoTAU\Tests\Integration\App\PseudoApp();
        }

        if( $alias != null )
            return $app->get($alias);

        return $app;
    }

}
