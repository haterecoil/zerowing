<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Account;
use AppBundle\Entity\Property;
use AppBundle\Form\AccountType;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use FOS\UserBundle\Model\UserInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AccountController extends FOSRestController
{
    /**
     * todo open to everyone
     *
     * Create a new account
     *
     * @Route("/zerowing/account")
     * @Method({"POST"})
     * @param Request $request
     * @return JsonResponse
     * @internal param Account $account
     * @internal param Request $request
     */
    public function postAction(Request $request)
    {
        // a placeholder for the form
        $account = new Account();
        // createForm is provided by the parent class
        $form = $this->createForm(
            new AccountType(),
            $account
        );

        $form->handleRequest($request);

        $errors = $this->get('validator')->validate($account);
        if (count($errors) > 0) {
            return new View(
                $errors,
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($account);
        $manager->flush();

        // created => 201
        return new View(array('account' => $account), Response::HTTP_CREATED);
    }

    /**
     * Show the user
     * todo only show to given user
     */
    public function showAction(Account $account)
    {
        $user = $this->getUser();

        if (!is_object($user) || !$user instanceof UserInterface) {
            return new View('This user does not have access to this section.', Response::HTTP_UNAUTHORIZED);
        }

        $urls = $user->getUrls();

        $validationMapping = array(
            0 => "Non validé",
            1 => "Validé",
        );

        $dataMapper = function ($item) use ($validationMapping) {
            return array(
                "url" => $item->getUrl(),
                "validation" => $validationMapping[$item->getValidation()],
            );
        };

        $urls = array_map($dataMapper, $urls->toArray());

        return $this->render('FOSUserBundle:Profile:show.html.twig', array(
            'user' => $user,
            'urls' => $urls,
        ));
    }

    /**
     * todo check propertier is owner
     * @param Property $property
     * @return View
     */
    public function postPropertyAction(Property $property)
    {
        $request = null;
        $input = $request->decodedBody;
        $account = $request->apiAccount;

        $validation_url = $input['base_url'].'/'.self::$verificationFile.'.html';

        $property = new Property();
        $property->setBaseUrl($input['base_url']);
        $property->setValidationUrl($validation_url);
        $property->setAccount($account);


        // a placeholder for the form
        $account = new Account();
        // createForm is provided by the parent class
        $form = $this->createForm(
            new AccountType(),
            $account
        );

        $form->handleRequest($request);

        $errors = $this->get('validator')->validate($account);
        if (count($errors) > 0) {
            return new View(
                $errors,
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($account);
        $manager->flush();

        // created => 201
        return new View(array('fuzzing' => $account), Response::HTTP_CREATED);
    }

}
