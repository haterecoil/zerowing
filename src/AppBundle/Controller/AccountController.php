<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Account;

class AccountController extends Controller
{
    /**
     * @Route("/zerowing/account")
     * @Method({"POST"})
     */
    public function AccountCreationAction(Request $request)
    {
        $content = $request->getContent();
        $input = json_decode($content, true);

        $username = $input['username'];
        $password = sha1($input['password']);

        $account = new Account();
        $account->setUsername($username);
        $account->setPassword($password);

        $em = $this->getDoctrine()->getManager();
        try {
            $em->persist($account);
            $em->flush();
        } catch (\Exception $e) {
            return new JsonResponse(array(
                'success' => false,
                'message' => "Ce compte utilisateur existe déjà."
            ));
        }

        return new JsonResponse(array(
            'success' => true,
            'id' => $account->getId()
        ));
    }
}
