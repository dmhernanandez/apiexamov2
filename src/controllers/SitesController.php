<?php
/**
 * Created by PhpStorm.
 * User: Dany_Hernandez
 * Date: 14/7/2021
 * Time: 17:39
 */

namespace Api\controllers;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class SitesController extends BaseController
{

    public function  getSiteById(Request $request, Response $response,array $args)
    {
        $sql = "SELECT * FROM Sitios WHERE Id=".$args["id"];
        $respuesta=array();
        try {
            $db = $this->conteiner->get("db");
            $resultado = $db->query($sql);

            if ($resultado->rowCount() > 0)
            {
             $respuesta=  self::format_array($resultado->fetchAll());
            }
            else
            {
              $respuesta=["msg" => "No existen registros con este Id"];
            }
        } catch (Exception $e) {
            $respuesta=["msg" => $e->getMessage()];
        }
          $response->getBody()->write($respuesta);
         return $response->withHeader('Content-type', 'application/json')
             ->withStatus(201);


    }

    public function  getAllSites(Request $request, Response $response, $args)
    {
        $sql = "SELECT * FROM Sitios";
        $array=[];
        try
        {
            $db = $this->conteiner->get("db");
            $resultado = $db->query($sql);

            if ($resultado->rowCount() > 0)
            {
                $response->getBody()->write(json_encode($resultado->fetchAll(),JSON_NUMERIC_CHECK));
            }
            else
            {
                $array=["msg" =>"No hay registros en la base de datos"];
            }
        }

        catch(Exception $e)
        {
            $array=["error" => $e->getMessage()];
        }
        return $response->withHeader('Content-type', 'application/json')
            ->withStatus(201);


    }

    public  function  addSite(Request $request, Response $response)
    {


        $valor = json_decode($request->getBody(),true); //Convertimos el arrya de objetos y lo convertimos en una array asociativo

        $sql = "INSERT INTO  Sitios(Descripcion,Latitud, Longitud,Fotografia) 
                VALUES (:descripcion, :latitud, :longitud, :foto)";
         $respuesta=[];
         try
        {
            $db = $this->conteiner->get("db");
            $stament=$db->prepare($sql);
            $stament->bindParam(":descripcion",$valor["descripcion"]);
            $stament->bindParam(":latitud",$valor["latitud"]);
            $stament->bindParam(":longitud",$valor["longitud"]);
            $stament->bindParam(":foto",$valor["foto"]);
            $res = $stament->execute();

            if($res){
               $respuesta=["status" => "ok","msg"=>"Guardado con exito"];
            }
        }
        catch(\PDOException $e)
        {
            $respuesta=["status" =>"error", "msg"=>$e->getMessage()];
        }
        return $response->withHeader('Content-type', 'application/json')
            ->withJson($respuesta)
                        ->withStatus(201);



    }

    public  function  updateSite(Request $request, Response $response, array $arg)
    {
        $valor = json_decode($request->getBody(),true);

        $sql = "UPDATE Sitios  SET Descripcion=:descripcion,Latitud=:latitud, Longitud=:longitud,Fotografia=:foto
                WHERE Id=".$arg["id"];
         $respuesta=[];
        try
        {
            $db = $this->conteiner->get("db");
            $stament=$db->prepare($sql);
            $stament->bindParam(":descripcion",$valor["descripcion"]);
            $stament->bindParam(":latitud",$valor["latitud"]);
            $stament->bindParam(":longitud",$valor["longitud"]);
            $stament->bindParam(":foto",$valor["foto"]);
            $stament->execute();
            if($stament->rowCount() > 0)
            {
                $respuesta=["status" => "ok","msg"=>"Registro Actualizado"];
            }
            else
            {
                $respuesta=["msg"=>"No se econtro registro para este id"];
            }


        }
        catch(\PDOException $e)
        {
            $respuesta=["status" =>"error", "msg"=>$e->getMessage()];
        }
        return $response->withHeader('Content-type', 'application/json')
            ->withJson($respuesta)
            ->withStatus(201);

    }
    public  function  deleteSite(Request $request, Response $response, array $arg)
    {

        $sql = "DELETE FROM Sitios WHERE Id=".$arg["id"];
        $respuesta=[];
        try
        {
            $db = $this->conteiner->get("db");
            $stament=$db->prepare($sql);
            $stament->execute();
            if($stament->rowCount() > 0)
            {
                $respuesta=["status" => "ok","msg"=>"Registro Eliminado con exito"];
            }
            else
            {
                $respuesta=["msg"=>"No existe registro para este id"];
            }


        }
        catch(\PDOException $e)
        {
            $respuesta=["status" =>"error", "msg"=>$e->getMessage()];
        }
        return $response->withHeader('Content-type', 'application/json')
            ->withJson($respuesta)
            ->withStatus(201);

    }
}