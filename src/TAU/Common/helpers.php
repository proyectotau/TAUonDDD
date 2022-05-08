<?php


if( ! function_exists("app") ){
    function app($alias = null){
        static $app = null;

        if( $app == null ){
            $app = new \League\Container\Container();
        }

        if( $alias != null )
            return $app->get($alias);

        return $app;
    }

    if( ! function_exists("getConcrete") ) {
        function getConcrete($entityManager): \ProyectoTAU\TAU\Common\Repository
        {
            $em_class = strstr($entityManager, '::', true);
            if ($em_class === false) {
                return new $entityManager;
            } else {
                return call_user_func(array($em_class, 'getInstance'));
            }
        }
    }
}
