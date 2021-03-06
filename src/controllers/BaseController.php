<?php
/**
 * Created by PhpStorm.
 * User: Dany_Hernandez
 * Date: 14/7/2021
 * Time: 15:50
 */

namespace Api\controllers;

use Psr\Container\ContainerInterface;

class BaseController
{
    protected $conteiner;
    protected $url;
    public function  __construct(ContainerInterface $container)
    {
        $this->conteiner=$container;
        $this->url="http://173.249.21.6/exam/img/";
    }
    //Sirve para dar formato a los arreglos y retornarlos en las apis
    public static function format_array($array){
        $respuesta=[];
        foreach ($array as $valor){
            array_push($respuesta,$valor);
        }
        return json_encode($respuesta,JSON_NUMERIC_CHECK);
     }

}