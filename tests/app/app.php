<?php


if( ! function_exists("app") ){
    function app($alias = null){
        static $app = null;

        if( $app == null ){
            $app = new League\Container\container();
        }

        if( $alias != null )
            return $app->get($alias);

        return $app;
    }

}
