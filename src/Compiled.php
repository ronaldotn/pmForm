<?php

namespace Dynaform;

use Criteria;
use DynaformPeer;
use ResultSet;

/**
 * Class Compiled
 * @package Dynaform
 */
class Compiled
{
    private $data = [];
    private $idForm;
    /** @var \Illuminate\Contracts\View\Factory $drawing */
    private $drawing = null;

    /**
     * Compiled constructor.
     * @param $idForm
     * @param array $data
     * @param array $mergeData
     */
    public function __construct($idForm, $data = [], $mergeData = [])
    {
        $this->idForm = $idForm;
        $this->data = $data;
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        $this->drawing = $this->view();
        $layout = 'Layouts::dynaform';
        return $this->drawing->make($layout, ['data' => $this->data, 'structure' => $this->getJsonStructure()]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function view()
    {
        $viewPath = __DIR__ . DIRECTORY_SEPARATOR . 'Base';
        view()->addLocation($viewPath);
        view()->addNamespace('Layouts', $viewPath . DIRECTORY_SEPARATOR . 'Layouts' . DIRECTORY_SEPARATOR . 'views');
        return view();
    }

    /**
     * @return string
     */
    private function getJsonStructure()
    {
        $a = new Criteria("workflow");
        $a->addSelectColumn(DynaformPeer::DYN_VERSION);
        $a->addSelectColumn(DynaformPeer::DYN_LABEL);
        $a->addSelectColumn(DynaformPeer::DYN_CONTENT);
        $a->addSelectColumn(DynaformPeer::PRO_UID);
        $a->addSelectColumn(DynaformPeer::DYN_UID);
        $a->add(DynaformPeer::DYN_UID, $this->idForm, Criteria::EQUAL);
        $ds = DynaformPeer::doSelectRS($a);
        $ds->setFetchmode(ResultSet::FETCHMODE_ASSOC);
        $ds->next();
        $row = $ds->getRow();
        return isset($row) ? $row['DYN_CONTENT'] : '';
    }
}
