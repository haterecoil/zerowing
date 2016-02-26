<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Account;
use AppBundle\Entity\Property;
use AppBundle\Form\PropertyType;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PropertyController extends Controller
{
    static $verificationFile = "code_zerowing_dfgsdgdfgdfgsfgdfgdg.html";
    static $verificationCode = "dsfqsdfsqfdsf";

    public function postPropertyAction(Request $request, Account $account)
    {
//        $input = $request->decodedBody;
//        $account = $request->apiAccount;
        $property = new Property();

        $form = $this->createForm(
            new PropertyType(),
            $property
        );

        $form->handleRequest($request);

        $errors = $this->get('validator')->validate($property);
        if (count($errors) > 0) {
            return new View(
                $errors,
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $validation_url = $property->getBaseUrl().'/'.self::$verificationFile.'.html';

        $property->setValidationUrl($validation_url);
        $property->setAccount($account);

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($property);
        $manager->flush();

        // created => 201
        return new View(array('fuzzing' => $account), Response::HTTP_CREATED);
    }

    public function getPropertyAction()
    {
        $response = new Response(self::$verificationCode);

        $response->headers->set('Content-Disposition', 'attachment; filename="'.self::$verificationFile.'"');

        return $response;
    }

    public function putPropertyVerifyAction(Property $property)
    {
        /*$input = $request->decodedBody;
        $account = $request->apiAccount;*/


        $url = $property->getValidationUrl();

        $result = $this->verifierCode($url);

        if ($result) {
            // created => 201
            return new View(array('property' => $property), Response::HTTP_OK);
        } else {
            return new View("Sorry but code or url is wrong", Response::HTTP_NOT_IMPLEMENTED);
        }
    }

    private function verifierCode($site)
    {

        $codeUrl = strtolower($site)."/".self::$verificationFile;
        if (substr($codeUrl, 0, 7) !== "http://" || substr($codeUrl, 0, 8) !== "https://") {
            $codeUrl = "http://".$codeUrl;
        }

        $code = "";
        try {
            $code = file_get_contents($codeUrl);
        } catch (\Exception $e) {
            // ignorer, la vérification va échouer
        }


        return $code == self::$verificationCode;
    }
}
