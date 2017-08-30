<?php

namespace Dynaform\Traits;

/**
 * This of class is more for Fields
 * Class Api
 * @package Dynaform\Traits
 */
trait Api
{
    /** @var string is url for embed in de template blade */
    public $apiUrl = '';

    /** @var string can do a html for parse with data */
    public $formatRender = '';

    /** @var string can do string or array */
    public $returnType = '';

    public function preExecuteApi()
    {
    }

    /**
     * @return array
     */
    public function executeApi()
    {
        if ($this->params) {
            $this->return['data'] = array_map(function ($item) {
                $string = '';
                if ($this->formatRender) {
                    $string = $this->formatRender;
                    foreach ($this->fields as $field) {
                        $string = str_replace($field, $item[$field], $string);
                    }
                }
                return $string;
            }, $this->params);
            $newLimit = $this->limit + $this->offset;
            $this->return['url'] = 'api/fields/' . strtolower($this->name) . '/' . $this->id . '/' . $newLimit . '/' . $this->offset . '/up';
        }
        return $this->return;
    }

    public function postExecuteApi()
    {
    }
}
