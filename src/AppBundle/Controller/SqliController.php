<?php
/**
 * Created by PhpStorm.
 * User: Milena
 * Date: 12/02/2016
 * Time: 11:14
 */

namespace AppBundle\Controller;

use AppBundle\Entity\SqlError;
use AppBundle\Form\SqlErrorType;
use AppBundle\Utils\Pentester;
use AppBundle\Utils\Reporter;
use AppBundle\Utils\Target;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SqliController extends FOSRestController
{

    /**
     * @param SqlError $sql_error
     * @return SqlError|null|object
     */
    public function getSqliAction(SqlError $sql_error)
    {
        return $sql_error;
    }

    /**
     * Lists all SqlError entities.
     */
    public function indexSqliAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sql_errors = $em->getRepository('AppBundle:SqlError')->findAll();

        $view = $this->view($sql_errors, 200);

        return $this->handleView($view);
    }


    /**
     * @param Request $request
     * @return View
     */
    public function postSqliAction(Request $request)
    {
        // a placeholder for the form
        $sql_error = new SqlError();
        // createForm is provided by the parent class
        $form = $this->createForm(
            new SqlErrorType(),
            $sql_error
        );

        $form->handleRequest($request);

        $errors = $this->get('validator')->validate($sql_error);
        if (count($errors) > 0) {
            return new View(
                $errors,
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($sql_error);
        $manager->flush();

        // created => 201
        return new View(array('fuzzing' => $sql_error), Response::HTTP_CREATED);
    }


    /**
     * @param SqlError $sql_error
     * @return SqlError
     */
    public function editSqliAction(SqlError $sql_error)
    {
        return $sql_error;
    }

    /**
     * Displays a form to edit an existing SqlError entity.  Uses the FuziingUriType
     * @param SqlError $sql_error
     * @return View
     */
    public function putSqliAction(SqlError $sql_error)
    {

        $errors = $this->get('validator')->validate($sql_error);
        if (count($errors) > 0) {
            return new View(
                $errors,
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($sql_error);
        $manager->flush();

        // created => 201
        return new View(array('fuzzing' => $sql_error), Response::HTTP_CREATED);
    }

    /**
     * Deletes a SqlError entity.
     * @param SqlError $sql_error
     * @return View
     */
    public function deleteSqliAction(SqlError $sql_error)
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($sql_error);
        $em->flush();

        return $this->routeRedirectView('index', array(), Response::HTTP_NO_CONTENT);
    }
}

