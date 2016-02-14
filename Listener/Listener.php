<?php

namespace Kejwmen\WhoopsBundle\Listener;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Kejwmen\WhoopsBundle\Handler\WhoopsHandler;

class Listener
{
    protected $handler;

    public function __construct(WhoopsHandler $handler)
    {
        $this->handler = $handler;
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        $whoops = $this->handler->handle(
            $event->getRequest(),
            $exception->getCode()
        );

        $whoopsResponse = $whoops->handleException($exception);
        $event->setResponse(new Response($whoopsResponse));
    }
}
