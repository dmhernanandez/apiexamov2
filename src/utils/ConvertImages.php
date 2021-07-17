<?php

/**
 * Created by PhpStorm.
 * User: Dany_Hernandez
 * Date: 16/7/2021
 * Time: 19:10
 */
namespace Api\utils;
class ConvertImages
{
    private $ruta_base=__DIR__."/../img/";

    public function convertImage($imagen)
    {
        if (!empty($imagen))
        {

            $suffix =$this->createRandomID() ;
            $image_name = "img_" . $suffix . "_" . date("Y-m-d-H-m-s") . ".jpg";

// base64 encoded utf-8 string
            $binary = base64_decode($imagen);
// binary, utf-8 by
            header("Content-Type: bitmap; charset=utf-8");

            $file = fopen( $this->ruta_base. $image_name, "wb");

            fwrite($file, $binary);

            fclose($file);
            return $image_name;
        }
        else
        {

           return "default.jpg";
        }
    }
    public function createRandomID()
        {
            $chars = "abcdefghijkmnopqrstuvwxyz0123456789?";
            $i = 0;

            $pass = "";

            while ($i <= 5) {

                $num = rand() % 33;

                $tmp = substr($chars, $num, 1);

                $pass = $pass . $tmp;

                $i++;
            }
            return $pass;
        }


}