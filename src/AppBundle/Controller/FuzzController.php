<?php

namespace AppBundle\Controller;

use AppBundle\Entity\FuzzingUri;
use AppBundle\Form\FuzzingUriType;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Rest controller for FuzzingUris.
 */
class FuzzController extends FOSRestController
{

    /**
     * @param FuzzingUri $fuzzing_uri
     * @return FuzzingUri|null|object
     */
    public function getFuzzAction(FuzzingUri $fuzzing_uri)
    {
        return $fuzzing_uri;
    }

    /**
     * Lists all FuzzingUri entities.
     */
    public function indexFuzzAction()
    {
        $em = $this->getDoctrine()->getManager();

        $fuzzingUris = $em->getRepository('AppBundle:FuzzingUri')->findAll();

        $view = $this->view($fuzzingUris, 200);

        return $this->handleView($view);
    }


    public function postFuzzAction(Request $request)
    {
        // a placeholder for the form
        $fuzzing_uri = new FuzzingUri();
        // createForm is provided by the parent class
        $form = $this->createForm(
            new FuzzingUriType(),
            $fuzzing_uri
        );

        $form->handleRequest($request);

        $errors = $this->get('validator')->validate($fuzzing_uri);
        if (count($errors) > 0) {
            return new View(
                $errors,
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($fuzzing_uri);
        $manager->flush();

        // created => 201
        return new View(array('fuzzing' => $fuzzing_uri), Response::HTTP_CREATED);
    }


    /**
     * @param FuzzingUri $fuzzing_uri
     * @return FuzzingUri
     */
    public function editFuzzAction(FuzzingUri $fuzzing_uri)
    {
        return $fuzzing_uri;
    }

    /**
     * Displays a form to edit an existing FuzzingUri entity.  Uses the FuziingUriType
     * @param FuzzingUri $fuzzing_uri
     * @return View
     */
    public function putFuzzAction(FuzzingUri $fuzzing_uri)
    {

        $errors = $this->get('validator')->validate($fuzzing_uri);
        if (count($errors) > 0) {
            return new View(
                $errors,
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($fuzzing_uri);
        $manager->flush();

        // created => 201
        return new View(array('fuzzing' => $fuzzing_uri), Response::HTTP_CREATED);
    }

    /**
     * Deletes a FuzzingUri entity.
     * @param FuzzingUri $fuzzingUri
     * @return View
     */
    public function deleteFuzzAction(FuzzingUri $fuzzingUri)
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($fuzzingUri);
        $em->flush();

        return $this->routeRedirectView('index', array(), Response::HTTP_NO_CONTENT);
    }
}
