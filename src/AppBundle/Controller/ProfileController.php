<?php

namespace AppBundle\Controller;

use FOS\UserBundle\Controller\ProfileController as BaseController;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ProfileController extends BaseController
{
    /**
     * Show the user
     */
    public function showAction()
    {
        $user = $this->getUser();

        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

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

        $urls = array_map($dataMapper, $urls->toArray());

        return $this->render('FOSUserBundle:Profile:show.html.twig', array(
            'user' => $user,
            'urls' => $urls
        ));
    }
}