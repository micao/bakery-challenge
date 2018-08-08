<?php

namespace Optimy\OnlineBakery;

use Silex\Application;
use Silex\Provider\HttpFragmentServiceProvider;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class Service {

    public function run()
    {
        $app = $this->setup();
        $app->run();
    }

    protected function setup(): Application
    {
        $app = new Application();
        $app->register(new HttpFragmentServiceProvider());

        //TODO: remove this for production
        $app['debug'] = true;

        $this->setupRouting($app);
        $this->setupErrorHandling($app);

        return $app;
    }

    protected function setupRouting(Application $app)
    {
        //Request::setTrustedProxies(array('127.0.0.1'));

        $app->get('/', [WelcomeController::class , 'welcome']);

    }

    private function setupErrorHandling(Application $app)
    {
        $app->error(function (\Exception $e, Request $request, $code) use ($app) {
            if ($app['debug']) {
                return;
            }

            return new JsonResponse(['message' => $e->getMessage()], $e->getCode());
        });
    }
}
