<?php
namespace Kejwmen\WhoopsBundle\Handler;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Whoops\Handler\JsonResponseHandler;
use Whoops\Handler\PlainTextHandler;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

class WhoopsHandler
{
    public function handle(Request $request, $statusCode)
    {
        $runner = new Run();

        $format = $request->getRequestFormat();
        if ('html' == $format) {
            $handler = new PrettyPageHandler();

            $handler->addDataTable(
                'App',
                [
                    'Controller'    => $request->get('_controller'),
                    'Route'         => $request->get('_route'),
                    'Session'       => $request->hasSession(),
                    'Status'        => $this->getCodeWithDescription($statusCode)
                ]
            );
        } else if ('json' == $format) {
            $handler = new JsonResponseHandler();
        } else {
            $handler = new PlainTextHandler();
        }

        $runner->pushHandler($handler);
        $runner->writeToOutput(false);
        $runner->allowQuit(false);
        $runner->register();

        return $runner;
    }

    private function getCodeWithDescription($statusCode)
    {
        if ($statusCode == null) $statusCode = 500;

        return $statusCode .' : ' . Response::$statusTexts[$statusCode];
    }
}
