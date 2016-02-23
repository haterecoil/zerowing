<?php

namespace AppBundle\Controller;

use AppBundle\Utils\Pentester\XssPentester;
use AppBundle\Utils\Target\SqlTarget;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\XSSAttack;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Form\XSSAttackType;
use Misd\GuzzleBundle\MisdGuzzleBundle;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Utils\Pentester;
use AppBundle\Utils\Reporter;
use AppBundle\Utils\Target;

/**
 * @Route("/XSSAttack")
 */
class XSSAttackController extends Controller
{
    /**
     * Lists all XSSAttack entities.
     *@Route("/all", name="xssattack_index")
     */
    public function indexAction()
    {
       $em = $this->getDoctrine()->getManager();

        $xSSAttacks = $em->getRepository('AppBundle:XSSAttack')->findAll();
        return $this->render('AppBundle::index.html.twig', array(
            'xSSAttacks' => $xSSAttacks,
        ));
    }

    /**
     * Creates a new XSSAttack entity.
     *@Route("/new", name="xssattack_new")
     */
    public function newAction(Request $request)
    {
        $xSSAttack = new XSSAttack();
        $form = $this->createForm('AppBundle\Form\XSSAttackType', $xSSAttack);
        $form->handleRequest($request);
        dump($form->isSubmitted());
        dump($form->isValid());

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($xSSAttack);
            $em->flush();

            return $this->redirectToRoute('xssattack_show', array('id' => $xSSAttack->getId()));
        }

        return $this->render('AppBundle::new.html.twig', array(
            'xSSAttack' => $xSSAttack,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a XSSAttack entity.
     *@Route("/show/{id}", name="xssattack_show")
     *
     */
    public function showAction(XSSAttack $xSSAttack)
    {
        $deleteForm = $this->createDeleteForm($xSSAttack);

        return $this->render('AppBundle::show.html.twig', array(
            'xSSAttack' => $xSSAttack,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing XSSAttack entity.
     *@Route("/edit/{id}", name="xssattack_edit")
     */
    public function editAction(Request $request, XSSAttack $xSSAttack)
    {
        $deleteForm = $this->createDeleteForm($xSSAttack);
        $editForm = $this->createForm('AppBundle\Form\XSSAttackType', $xSSAttack);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($xSSAttack);
            $em->flush();

            return $this->redirectToRoute('xssattack_edit', array('id' => $xSSAttack->getId()));
        }

        return $this->render('AppBundle::edit.html.twig', array(
            'xSSAttack' => $xSSAttack,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a XSSAttack entity.
     *@Route("/delete/{id}", name="xssattack_delete")
     */
    public function deleteAction(Request $request, XSSAttack $xSSAttack)
    {
        $form = $this->createDeleteForm($xSSAttack);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($xSSAttack);
            $em->flush();
        }

        return $this->redirectToRoute('xssattack_index');
    }

    /**
     * Launch a XSSAttack entity.
     *@Route("/attack", name="xssattack_attack")
     */
    public function launchAttack(Request $request)
    {

        $form = $this->createFormBuilder()
            ->add('url', TextType::class)
            ->add('method', TextType::class) //TODO DROPDOWN
            ->add('key', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Launch Attack'))
            ->getForm();

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            $target = new SqlTarget();
            $target->setUrl($data['url']);
            $target->setMethod($data['method']);
            $target->setParameters(array('key'=>$data['key']));

            /**
             * SQL pentesting service
             * todo put in priv var ?
             * @var $sqlPentester Pentester\SqlPentester
             */
            $xssPentester = $this->get('app.pentester.xss');
            $xssPentester->test($target);


            return $this->redirectToRoute('xssattack_index');
        }

        return $this->render('AppBundle::attack.html.twig', array(
            'form' => $form->createView()
        ));
    }



    /**
     * Creates a form to delete a XSSAttack entity.
     *
     * @param XSSAttack $xSSAttack The XSSAttack entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(XSSAttack $xSSAttack)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('xssattack_delete', array('id' => $xSSAttack->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}
