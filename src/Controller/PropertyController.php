<?php 
namespace App\Controller;

use App\Entity\Property;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Repository\PropertyRepository;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class PropertyController extends AbstractController
{

  /**
   * @var PropertyRepository
   */
  private $repository;

  public function __construct(PropertyRepository $repository, EntityManagerInterface $em)
  {
    $this->repository = $repository;
    $this->em = $em;
  }

  /**
   * @Route("/features", name="property.index")
   * @return Reponse
   */

  public function index(PaginatorInterface $paginator, Request $request): Response
  {
    $search = new PropertySearch();
    $form = $this->createForm(PropertySearchType::class, $search);
    $form->handleRequest($request);

    // $properties = $this->repository->findAllVisible();
    $properties = $paginator->paginate(
      $this->repository->findAllVisibleQuery($search),
      $request->query->getInt('page', 1), /*page number*/
      12 /*limit per page*/
  );
    return $this->render('property/index.html.twig' ,[
      'current_menu' => 'properties',
      'properties' => $properties,
      'form' => $form->createView()
    ]);
  }
  
  /**
  * @Route("/features/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
  * @param Property $property
  * @return Reponse
  */
  public function show(Property $property, string $slug): Response
  {
    if ($property->getSlug() !== $slug) {
      return $this->redirectToRoute('property.show', [
        'id' => $property->getId(),
        'slug' => $property->getSlug()
      ], 301);
    }
    return $this->render('property/show.html.twig' ,[
      'property' => $property,
      'current_menu' => 'properties'
    ]);
  }
}
?>