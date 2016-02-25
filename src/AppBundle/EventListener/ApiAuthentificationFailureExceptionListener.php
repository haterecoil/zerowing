<?php
namespace AppBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiAuthentificationFailureExceptionListener
{
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        if (!($exception instanceof ApiAuthentificationFailureException)) {
            return;
        }

        $response = new JsonResponse(array(
            'success' => false,
            'message' => $exception->getMessage()
        ));

        $event->setResponse($response);
    }
}