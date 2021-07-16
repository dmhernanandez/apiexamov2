
<?php
/**
 * Created by PhpStorm.
 * User: Dany_Hernandez
 * Date: 14/7/2021
 * Time: 14:03
 */

use Slim\Routing\RouteCollectorProxy;
use Api\controllers\SitesController;
$app -> group("/exam",function (RouteCollectorProxy $group){
    $group->get("/sites",SitesController::class.":getAllSites");
    
    $group->get("/sites/{id}" ,SitesController::class.":getSiteById");

    $group->post("/add",SitesController::class.":addSite");

    $group->put("/update/{id}",SitesController::class.":updateSite");

    $group->delete("/delete/{id}",SitesController::class.":deleteSite");

});