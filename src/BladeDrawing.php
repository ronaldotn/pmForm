<?php

namespace Dynaform;

class BladeDrawing
{
    const DS = DIRECTORY_SEPARATOR;
    private $resources = ['Layouts'];

    public static function register()
    {
        $that = new self();
        foreach ($that->resources as $index => $resource) {
            $that->findBlade($resource, __DIR__ .  self::DS . 'Base');
        }
    }

    /**
     * Find the given view in the list of paths.
     *
     * @param $name
     * @param $paths
     */
    private function findBlade($name, $paths)
    {
        if ($registers = $this->fileExist($paths . self::DS . $name . self::DS . 'register.php')) {
            foreach ($registers as $index => $register) {
                $reflectionClass = new \ReflectionClass($register);
                if ($reflectionClass->hasMethod('blade')) {
                    (new $register)->blade();
                }
            }
        }
    }

    /**
     * @param string $path
     * @return bool|array
     */
    private function fileExist($path)
    {
        if (file_exists($path)) {
            return require_once $path;
        }
        return false;
    }
}
