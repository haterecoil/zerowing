<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Siteclient;

class DefaultController extends Controller
{
    static $verificationCode = "figsfmghsdmflgjsdhmglsdhgoeirtherngldjfnslfmgbdjlg";
    static $verificationFile = "code_zerowing_dfgsdgdfgdfgsfgdfgdg.html";

    // utilitaire pour vérifier qu'un site a bien installé le fichier de vérification
    private function verifierCode($site) {
        $codeUrl = strtolower($site) . "/" . self::$verificationFile;

        if (substr($codeUrl, 0, 7) !== "http://" || substr($codeUrl, 0, 8) !== "https://") {
            $codeUrl = "http://" . $codeUrl;
        }

        $code = "";
        try {
            $code = file_get_contents($codeUrl);
        } catch (\Exception $e) {
            // montrer un message à l'utilisateur pour dire que le site n'existe pas
            return false;


        }


        return $code == self::$verificationCode;
    }

    /**
     * @Route("/zerowing/")
     */
    public function zerowingAction(Request $request)
    {
        return $this->render('zerowing/index.html.twig', array());
    }

    /**
     * @Route("/zerowing/ajouter")
     */
    public function zerowingAjouterAction(Request $request)
    {
        $url = $request->get("url");
        return $this->render('zerowing/Process.html.twig', array(
            'url' => $url
        ));
    }

    /**
     * @Route("/zerowing/tests")
     */
    public function zerowingTestsAction(Request $request)
    {
        $url = $request->get("url");

        if ($this->verifierCode($url)) {
            return $this->render('zerowing/Process.html.twig', array(
                'url' => $url
            ));
        } else {
            return $this->redirect('/zerowing/procedure?url' . $url);
        }
    }


    /**
     * @Route("/zerowing/procedure")
     */
    public function zerowingProcedureAction(Request $request)
    {
        $url = $request->get("url");
        return $this->render('zerowing/procedure.html.twig', array(
            'url' => $url
        ));
    }

    /**
     * @Route("/zerowing/telecharger")
     */
    public function zerowingTelechargerAction(Request $request)
    {
        $response = new Response(self::$verificationCode);
        $response->headers->set('Content-Disposition', 'attachment; filename="' . self::$verificationFile . '"');

        return $response;
    }


    /**
     * @Route("/zerowing/verification")
     */
    public function zerowingVerificationAction(Request $request)
    {
        $url = $request->get("url");
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $siteclient = new SiteCLient();
        //Verification et Enregistrement de l'url dans la base

        if  ((!$this->verifierCode($url)))
        {
            $siteclient->setUrl($url);
            $siteclient->setValidation(0);
            $siteclient->setUser($user);
            $code = "";
            try {
                $em->persist($siteclient);
                $em->flush();
            } catch (\Exception $e) {
                // montrer un message à l'utilisateur pour dire que le site n'existe pas
                return $this->redirect('/zerowing/procedure?url='. $url);

            }
        } else {
            $siteclient->setUrl($url);
            $siteclient->setValidation(1);
            $siteclient->setUser($user);

            try {
                $em->persist($siteclient);
                $em->flush();
            } catch (\Exception $e) {
                return $this->redirect('/zerowing/tests?url='. $url);
            }
        }
    }
    /**
     * @Route("/zerowing/listetests")
     */
    public function zerowinglistetestsAction(Request $request)
    {
        $user = $this->getUser();
        $urls= $user->getUrls();

        $validationMapping = array(
            0 => "Non validé",
            1 => "Validé"
        );

        $dataMapper = function ($item) use ($validationMapping) {
            return array(
                "url" => $item->getUrl(),
                "validation" => $validationMapping[$item->getValidation()]
            );
        };

        $data = array_map($dataMapper, $urls->toArray());

        return new Response(json_encode($data));
    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => "/",
        ));
    }
}
