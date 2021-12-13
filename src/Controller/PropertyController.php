<?php 
namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class PropertyController extends AbstractController
{

  /**
   * @var PropertyRepository
   */
  private $repository;

  public function __construct(PropertyRepository $repository)
  {
    $this->repository = $repository;
  }

  /**
   * @Route("/features", name="property.index")
   * @return Reponse
   */

  public function index(): Response
  {
    // $property = $this->repository->findOneBy(['floor' => 4]);
    // dump($property);
    return $this->render('property/index.html.twig' ,[
      'current_menu' => 'properties'
    ]);
  }
}
?>