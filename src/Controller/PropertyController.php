<?php 
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController
{
  /**
   * @Route("/features", name="property.index")
   * @return Reponse
   */

  public function index(): Response
  {
    return new Response(content: "Features");
  }
}
?>