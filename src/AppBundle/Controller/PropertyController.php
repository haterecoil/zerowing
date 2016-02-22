<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Account;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Property;

class PropertyController extends Controller
{
    static $verificationFile = "code_zerowing_dfgsdgdfgdfgsfgdfgdg.html";
    static $verificationCode = "dsfqsdfsqfdsf";

    /**
     * @Route("/zerowing/property/new")
     */
    public function PropertyCreationAction(Request $request)
    {
        $content = $request->getContent();
        $input = json_decode($content, true);

        $em = $this->getDoctrine()->getManager();

        // check authentification
        $account = $em->getRepository('AppBundle:Account')->getAccount(
            $input['username'],
            $input['password']);

        if ($account == null) {
            return new JsonResponse(array(
                'success' => false,
                'message' => 'Account not found'
            ));
        }

        $validation_url = $input['base_url'] . '/' . self::$verificationFile . '.html';

        $property = new Property();
        $property->setBaseUrl($input['base_url']);
        $property->setValidationUrl($validation_url);
        $property->setAccount($account);

        $em = $this->getDoctrine()->getManager();
        $em->persist($property);
        $em->flush();

        return new JsonResponse(array(
            'success' => true,
            'id' => $property->getId()
        ));
    }

    /**
     * @Route("/zerowing/property/download")
     */
    public function DownloadAction()
    {

        $response = new Response(self::$verficationCode);

        $response->headers->set('Content-Disposition', 'attachment; filename="' . self::$verificationFile . '"');

        return $response;

    }

    public function PropertyVerificationAction()
    {

        $response = new Response();

        if ($this->verifierCode($url)) {
            return $response->getStatus(true);
        } else {
            return $response->getStatus(false);
        }

    }



}
