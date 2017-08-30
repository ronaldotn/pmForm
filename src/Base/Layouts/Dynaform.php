<?php

namespace Dynaform\Base\Layouts;

use Dynaform\Compiled;
use Illuminate\Support\Facades\Blade;

class Dynaform
{
    private $name = 'dynaform';

    private $template = 'Layouts.views.dynaform';

    /**
     * @param array $data params override attributes this class
     * @return string return html
     */
    public function view($data = [])
    {
        $data = array_merge((array)$this, $data);
        return (string)view($this->template)->with((array)$data);
    }

    /**
     * Return template of in string
     * @return string return html
     */
    public function template()
    {
        return (string)Compiled::view()->make($this->template);
    }

    /**
     * Register template how directive
     */
    public function blade()
    {
        Blade::directive($this->name, function ($expression) {
            if (!$expression) {
                $expression = "{}";
            }
            return Compiled::view()->make($this->template)->with($expression);
        });
    }
}
