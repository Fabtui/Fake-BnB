<?php 
namespace App\Controller\Admin;

use App\Entity\Option;
use App\Entity\Property;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\PropertyType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminPropertyController extends AbstractController {

  public function __construct(PropertyRepository $repository, EntityManagerInterface $em)
  {
    $this->repository = $repository;
    $this->em = $em;
  }

  /**
   * @Route("/admin", name="admin.property.index")
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function index() 
  {
    $properties = $this->repository ->findAll();
    return $this->render('admin/property/index.html.twig', [
      'current_menu' => 'admin',
      'properties' => $properties
    ]);
  }

  /**
   * @Route("/admin/property/create", name="admin.property.new")
   */
  public function new(Request $request) 
  {
    $property = new Property();
    $form = $this->createForm(PropertyType::class, $property);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $this->em->persist($property);
      $this->em->flush();
      $this->addFlash('success', 'Successfully added');
      return $this->redirectToRoute('admin.property.index');
    }
    return $this->render('admin/property/new.html.twig', [
      'property' => $property,
      'form' => $form->createView()
    ]);
  }

    /**
   * @Route("/admin/property/{id}", name="admin.property.edit", methods="GET|POST")
   * @param Property $property
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function edit(Property $property, Request $request) 
  {
    // $option = new Option();
    // $property->addOption($option);

    $form = $this->createForm(PropertyType::class, $property);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $this->em->flush();
      $this->addFlash('success', 'Successfully edited');
      return $this->redirectToRoute('admin.property.index');
    }

    return $this->render('admin/property/edit.html.twig', [
      'property' => $property,
      'form' => $form->createView() 
    ]);
  }

  /**
  * @Route("/admin/delete/{id}", name="admin.property.delete")
  * @param Property $property
  * @return \Symfony\Component\HttpFoundation\RedirectResponse
  */
  public function delete(Property $property)
  {
    $this->em->remove($property);
    $this->em->flush();
    $this->addFlash('success', 'Successfully deleted');
    return $this->redirectToRoute('admin.property.index');
  }

  // public function delete(Property $property, Request $request)
  // {
  //   if ($this->isCsrfTokenValid('delete' . $property->getId(), $request->get('_token'))) {
  //     $this->em->remove($property);
  //     $this->em->flush();
  //     $this->addFlash('success', 'Successfully deleted');
  //   }
  //   return $this->redirectToRoute('admin.property.index');
  // }
}

?>