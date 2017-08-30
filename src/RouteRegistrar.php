<?php

namespace Dynaform;

use Illuminate\Contracts\Routing\Registrar as Router;

/**
 * Class RouteRegistrar
 * @package Dynaform
 */
class RouteRegistrar
{
    /**
     * The router implementation.
     *
     * @var Router
     */
    protected $router;

    /**
     * Create a new route registrar instance.
     *
     * @param  Router $router
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * Register routes for transient tokens, clients, and personal access tokens.
     *
     * @return void
     */
    public function all()
    {
        $this->forFields();
    }

    /**
     * Register the routes for retrieving and issuing fields.
     *
     * @return void
     */
    public function forFields()
    {
        $this->router->group(['middleware' => ['web', 'api']], function ($router) {
            /** @var Router $router */
            $router->get('/api/fields/{name}/{id}/{limit}/{offset}/up', [
                'uses' => 'FieldsController@pullUp',
            ]);
            $router->get('/api/fields/{name}/{id}/{limit}/{offset}/down', [
                'uses' => 'FieldsController@pullDown',
            ]);
        });
    }

}
