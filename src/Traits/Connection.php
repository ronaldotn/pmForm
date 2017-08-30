<?php

namespace Dynaform\Traits;

use Illuminate\Support\Facades\DB;

/**
 * This of class is more for Fields
 * Class Connection
 * @package Dynaform\Traits
 */
trait Connection
{
    /** @var string name of table */
    public $table = '';

    /** @var array name column select */
    public $fields = ['*'];

    /** @var string name database connection */
    public $database = 'mysql';

    /** @var string Query find field in table */
    public $query = '';

    /** @var int offset return */
    public $offset = 20;

    /** @var int limit group */
    public $limit = 0;

    /** @var array order by fields */
    public $orderBy = [];

    /** @var string return value */
    public $fieldReturn = '';

    /**
     */
    public function preExecuteConnection()
    {
    }

    public function executeConnection()
    {
        //select * from users where id = :id', ['id' => 1]
        $this->params = [];
        if (($this->database && $this->table) || $this->query) {
            $this->buildQuery();
            $cnn = DB::connection($this->database)->table($this->table);
            if ($this->orderBy) {
                foreach ($this->orderBy as $item) {
                    $cnn->orderBy($item);
                }
            }
            $this->params = array_map(function ($item) {
                return (array)$item;
            }, $cnn->take($this->offset)->skip($this->limit)->get($this->fields)->toArray());
        }
        return $this->params;
    }

    public function postExecuteConnection()
    {
        if ($this->fieldReturn) {
            $this->{$this->fieldReturn} = $this->params;
        }
    }

    public function buildQuery()
    {
        if ($this->query && preg_match('/\bfrom\b\s*(\w+)/i', $this->query, $matches)) {
            $this->table = $matches[1];
        }
        if ($this->query && preg_match('/\bselect (.*?) \bfrom /i', $this->query, $matches)) {
            $this->fields = explode(",", str_replace(", ", ",", $matches[1]));
        }
    }
}
