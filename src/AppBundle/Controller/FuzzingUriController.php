<?php

namespace AppBundle\Controller;

use AppBundle\Entity\FuzzingUri;
use AppBundle\Form\FuzzingUriType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * FuzzingUri controller.
 *
 * @Route("/fuzzinguri")
 */
class FuzzingUriController extends Controller
{
    /**
     * Lists all FuzzingUri entities.
     *
     * @Route("/", name="fuzzinguri_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $fuzzingUris = $em->getRepository('AppBundle:FuzzingUri')->findAll();

        return $this->render('fuzzinguri/index.html.twig', array(
            'fuzzingUris' => $fuzzingUris,
        ));
    }

    /**
     * Creates a new FuzzingUri entity. Uses the FuziingUriType
     *
     * @Route("/new", name="fuzzinguri_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $fuzzingUri = new FuzzingUri();
        $form = $this->createForm('AppBundle\Form\FuzzingUriType', $fuzzingUri);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fuzzingUri);
            $em->flush();

            return $this->redirectToRoute('fuzzinguri_show', array('id' => $fuzzingUri->getId()));
        }

        return $this->render('@App/Forms/fuzzinguri/new.html.twig', array(
            'fuzzingUri' => $fuzzingUri,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a FuzzingUri entity.
     *
     * @Route("/{id}", name="fuzzinguri_show")
     * @Method("GET")
     */
    public function showAction(FuzzingUri $fuzzingUri)
    {
        $deleteForm = $this->createDeleteForm($fuzzingUri);

        return $this->render('fuzzinguri/show.html.twig', array(
            'fuzzingUri' => $fuzzingUri,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to delete a FuzzingUri entity.
     *
     * @param FuzzingUri $fuzzingUri The FuzzingUri entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FuzzingUri $fuzzingUri)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('fuzzinguri_delete', array('id' => $fuzzingUri->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    /**
     * Displays a form to edit an existing FuzzingUri entity.  Uses the FuziingUriType
     *
     * @Route("/{id}/edit", name="fuzzinguri_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, FuzzingUri $fuzzingUri)
    {
        $deleteForm = $this->createDeleteForm($fuzzingUri);
        $editForm = $this->createForm('AppBundle\Form\FuzzingUriType', $fuzzingUri);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fuzzingUri);
            $em->flush();

            return $this->redirectToRoute('fuzzinguri_edit', array('id' => $fuzzingUri->getId()));
        }

        return $this->render('@App/Forms/fuzzinguri/edit.html.twig', array(
            'fuzzingUri' => $fuzzingUri,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a FuzzingUri entity.
     *
     * @Route("/{id}", name="fuzzinguri_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, FuzzingUri $fuzzingUri)
    {
        $form = $this->createDeleteForm($fuzzingUri);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($fuzzingUri);
            $em->flush();
        }

        return $this->redirectToRoute('fuzzinguri_index');
    }
}
