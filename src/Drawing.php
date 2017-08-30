<?php

namespace Dynaform;

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Facades\Route;

/**
 * Class Drawing
 * @package Dynaform
 */
class Drawing
{
    /**
     * The IoC container instance.
     *
     * @var \Illuminate\Contracts\Container\Container
     */
    private $container;

    /**
     * Data that should be available to all templates.
     *
     * @var array
     */
    private $shared = [];

    private $compiled;

    /**
     * @param string $idForm
     * @param array $data
     * @param array $mergeData
     * @return \Illuminate\Contracts\View\View
     */
    public function make($idForm, $data = [], $mergeData = [])
    {
        $this->compiled = new Compiled($idForm, $data, $mergeData);
        return $this->compiled->render();
    }

    /**
     * Set the IoC container instance.
     *
     * @param  \Illuminate\Contracts\Container\Container $container
     * @return void
     */
    public function setContainer(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Add a piece of shared data to the environment.
     *
     * @param  array|string $key
     * @param  mixed $value
     * @return mixed
     */
    public function share($key, $value = null)
    {
        $keys = is_array($key) ? $key : [$key => $value];

        foreach ($keys as $key => $value) {
            $this->shared[$key] = $value;
        }

        return $value;
    }

    /**
     * Get a Passport route registrar.
     *
     * @param $callback
     * @param array $options
     */
    public static function routes($callback = null, array $options = [])
    {
        $callback = $callback ?: function ($router) {
            $router->all();
        };

        $options = array_merge($options, [
            'namespace' => '',
        ]);

        Route::group($options, function ($router) use ($callback) {
            $callback(new RouteRegistrar($router));
        });
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->compiled;
    }
}
