<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Account;

class AccountController extends Controller
{
    /**
     * @Route("/zerowing/account/new")
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
        $em->persist($account);
        $em->flush();

        return new JsonResponse(array(
            'success' => true,
            'îd' => $account->getId()
        ));
    }


}
