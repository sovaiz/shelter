<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Form\AnimalType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class AnimalController
 * @package App\Controller
 *
 * @Route("/animal")
 */
class AnimalController extends Controller
{
  /**
   * @Route("/", name="animal_index")
   * @Method("GET")
   */
  public function index(Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    $qb = $this->getDoctrine()
      ->getRepository(Animal::class)->createQueryBuilder('a');

    $qb
      ->orderBy('a.id', 'ASC');

    $query = $qb->getQuery();

    $paginator = $this->get('knp_paginator');
    $list = $paginator->paginate(
      $query,
      $request->query->getInt('page', 1) /* page number */,
      5 /* limit per page */
    );

    return $this->render('animal/index.html.twig', [
      'data' => $list
    ]);
  }

  /**
   * Creates a new animal entity
   *
   * @param Request $request
   * @return RedirectResponse|Response
   *
   * @Route("/new", name="animal_new")
   * @Method({"GET", "POST"})
   */
  public function new(Request $request)
  {
    $animal = new Animal();
    $form = $this->createForm(AnimalType::class, $animal);
//    var_dump($form->get('dateOfPlacement')->getData());
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

      $em = $this->getDoctrine()->getManager();
      $em->persist($animal);
      $em->flush();

      return $this->redirectToRoute('animal_index');
    }

    return $this->render('animal/new.html.twig', [
      'animal'  => $animal,
      'form'    => $form->createView(),
    ]);
  }

  /**
   * Displays a form to edit an existing animal entity
   *
   * @param Request $request
   * @param Animal $animal
   * @return RedirectResponse|Response
   *
   * @Route("/{id}/edit", name="animal_edit")
   * @Method({"GET", "POST"})
   */
  public function edit(Request $request, Animal $animal)
  {
    $form = $this->createForm(AnimalType::class, $animal);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();

      /**
       * Set date of change
       */
      $animal->setDateOfChange(new \DateTime('NOW'));

      $em->persist($animal);
      $em->flush();

      return $this->redirectToRoute('animal_index');
    }

    return $this->render('animal/edit.html.twig', [
      'landProperty'  => $animal,
      'form'          => $form->createView()
    ]);
  }

  /**
   * Deletes an animal entity
   *
   * @param Request $request
   * @param Animal $animal
   * @return RedirectResponse
   *
   * @Route("/{id}", requirements={"id" = "\d+"}, name="animal_delete")
   * @Method("GET")
   */
  public function delete(Request $request, Animal $animal)
  {
    $em = $this->getDoctrine()->getManager();

    $em->remove($animal);
    $em->flush();

    return $this->redirectToRoute('animal_index');
  }
}
