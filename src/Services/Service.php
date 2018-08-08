<?php

namespace Optimy\OnlineBakery\Services;

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

    protected function setup()
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
        $app->get('/welcome', "Optimy\\OnlineBakery\\Controller\\WelcomeController::welcome");
        $app->get('/', "Optimy\\OnlineBakery\\Controller\\IndexController::index");
        $app->get('/api/cakes', "Optimy\\OnlineBakery\\Controller\\OrderController::proposeTenCakes");

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
