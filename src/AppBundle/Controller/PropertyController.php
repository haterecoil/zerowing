<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Account;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Property;

class PropertyController extends Controller
{
    static $verificationFile = "code_zerowing_dfgsdgdfgdfgsfgdfgdg.html";
    static $verificationCode = "dsfqsdfsqfdsf";

    private function verifierCode($site) {

        $codeUrl = strtolower($site) . "/" . self::$verificationFile;
        if (substr($codeUrl, 0, 7) !== "http://" || substr($codeUrl, 0, 8) !== "https://") {
            $codeUrl = "http://" . $codeUrl;
        }

        $code = "";
        try {
            $code = file_get_contents($codeUrl);
        } catch (\Exception $e) {
            // ignorer, la vérification va échouer
        }


        return $code == self::$verificationCode;
    }

    /**
     * @Route("/zerowing/property")
     * @Method({"POST"})
     */
    public function PropertyCreationAction(Request $request)
    {
        $input = $request->decodedBody;
        $account = $request->apiAccount;

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
     * @Route("/zerowing/download")
     * @Method({"GET"})
     */
    public function DownloadAction()
    {
        $response = new Response(self::$verificationCode);

        $response->headers->set('Content-Disposition', 'attachment; filename="' . self::$verificationFile . '"');

        return $response;
    }


    /**
     * @Route("/zerowing/property/verification")
     * @Method({"POST"})
     */
    public function PropertyVerificationAction(Request $request)
    {
        $input = $request->decodedBody;
        $account = $request->apiAccount;

        $propertyId = $input ['id'];
        $property = $this->getDoctrine()
            ->getRepository('AppBundle:Property')
            ->find($propertyId);
        $url = $property->getValidationUrl();

        $result = $this->verifierCode($url);

        return new JsonResponse(array(
            'success' => true,
            'id' => $result
        ));
    }
}
