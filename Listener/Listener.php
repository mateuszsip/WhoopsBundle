<?php

namespace Kejwmen\WhoopsBundle\Listener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Kejwmen\WhoopsBundle\Handler\WhoopsHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
        $code = $exception instanceof HttpException ? $exception->getCode() : null;

        $whoops = $this->handler->handle(
            $event->getRequest(),
            $code
        );

        $whoopsResponse = $whoops->handleException($exception);
        $event->setResponse(new Response($whoopsResponse));
    }
}
