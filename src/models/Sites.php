<?php

/**
 * Created by PhpStorm.
 * User: Dany_Hernandez
 * Date: 15/7/2021
 * Time: 16:01
 */
namespace Api\models;
class Sites
{
    private $descripcion;
    private $latitud;
    private $longitud;
    private $foto;
  public  function __construct($descrip,$latitud,$longitud,$foto)
  {
      $this->descripcion=$descrip;
      $this->latitud=$latitud;
      $this->longitud=$longitud;
      $this->foto=$foto;
  }
}