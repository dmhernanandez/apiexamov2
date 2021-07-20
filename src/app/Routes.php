
<?php
/**
 * Created by PhpStorm.
 * User: Dany_Hernandez
 * Date: 14/7/2021
 * Time: 14:03
 */
// use Psr\Http\Message\ResponseInterface as Response;
// use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteCollectorProxy;
use Api\controllers\SitesController;


// $app->get('/img', function (Request $request, Response $response) {
   
//     return $response->withHeader("Location","/src/img/img_3mk7fs_2021-07-17-04-07-22.jpg")
//            ->withStatus(302);
// });
$app -> group("/exam",function (RouteCollectorProxy $group)
{
    $group->get("/sites",SitesController::class.':getAllSites');

    $group->get("/img/{photo_name}",SitesController::class.':getImage');

    $group->get("/sites/{id}" ,SitesController::class.':getSiteById');

    $group->post("/add",SitesController::class.':addSite');

    $group->put("/update/{id}",SitesController::class.':updateSite');

    $group->delete("/delete/{id}",SitesController::class.':deleteSite');

});