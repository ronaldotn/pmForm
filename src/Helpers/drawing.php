<?php

if (!function_exists('dynaform')) {
    /**
     * Get the evaluated view contents for the given view.
     *
     * @param  string $idForm
     * @param  array $data
     * @param  array $mergeData
     * @return \Dynaform\Drawing
     */
    function dynaform($idForm = null, $data = [], $mergeData = [])
    {
        $factory = app('dynaform');

        if (func_num_args() === 0) {
            return $factory;
        }

        return $factory->make($idForm, $data, $mergeData);
    }
}
