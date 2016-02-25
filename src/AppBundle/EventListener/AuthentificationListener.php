<?php
namespace AppBundle\EventListener;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Doctrine\ORM\EntityManager;

class AuthentificationListener
{
    /**
     *
     * @var EntityManager
     */
    protected $em;

    private static $skipAuthentification = array(
        "/zerowing/account",
        "/zerowing/download"
    );

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function onKernelController(FilterControllerEvent $event)
    {
        $controller = $event->getController();

        /*
         * $controller passed can be either a class or a Closure.
         * This is not usual in Symfony but it may happen.
         * If it is a class, it comes in array format
         */
        if (!is_array($controller)) {
            return;
        }

        $request = $event->getRequest();
        $url = $request->getBaseUrl();
        if (in_array($url, self::$skipAuthentification)) {
            return;
        }

        $content = $request->getContent();
        $input = json_decode($content, true);

        // check authentification
        $account = $this->em->getRepository('AppBundle:Account')->getAccount(
            $input['username'],
            $input['password']);

        if ($account == null) {
            throw new ApiAuthentificationFailureException("Ce compte n'existe pas");
        } else {
            // mettre ces variables déjà calculées à disposition de tous les controlleurs
            $request->apiAccount = $account;
            $request->decodedBody = $input;
        }
    }
}