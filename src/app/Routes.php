
<?php
/**
 * Created by PhpStorm.
 * User: Dany_Hernandez
 * Date: 14/7/2021
 * Time: 14:03
 */

use Slim\Routing\RouteCollectorProxy;

$app -> group("/exam",function (RouteCollectorProxy $group){
    $group->get("/sites","Api\controllers\SitesController:getAllSites");
    $group->get("/sites/{id}","Api\controllers\SitesController:getSiteById");

    $group->post("/add","Api\controllers\SitesController:addSite");

    $group->put("/update/{id}","Api\controllers\SitesController:updateSite");

    $group->delete("/delete/{id}","Api\controllers\SitesController:deleteSite");

});