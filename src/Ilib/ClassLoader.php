<?php
/**
 * Provides functionality for including files.
 *
 * PHP Version 5
 *
 * @category Database
 * @package  Ilib_Position
 * @author   Sune Jensen <sj@sunet.dk>
 * @author   Lars Olesen <lars@legestue.net>
 *
 */

/**
 * Provides functionality for including files.
 *
 * Refinemend of Konstrukts classloader (www.konstrukt.dk)
 * Thanks for the great MVC framework
 *
 * @category ClassLoader
 * @package  Ilib_ClassLoader
 * @author   Sune Jensen <sj@sunet.dk>
 * @author   Lars Olesen <lars@legestue.net>
 */
class Ilib_ClassLoader
{
    /**
    * Default autoloader for Konstrukt naming scheme.
    */
    static function autoload($classname)
    {
        $filename = str_replace('_', '/', $classname).'.php';
        if (self::SearchIncludePath($filename)) {
            require_once($filename);
        }
    }

    /**
    * Searches the include-path for a filename.
    * Returns the absolute path (realpath) if found or FALSE
    * @return mixed
    */
    static function SearchIncludePath($filename)
    {
        if (is_file($filename)) {
            return $filename;
        }
        foreach (explode(PATH_SEPARATOR, ini_get("include_path")) as $path) {
            if (strlen($path) > 0 && $path{strlen($path)-1} != DIRECTORY_SEPARATOR) {
                $path .= DIRECTORY_SEPARATOR;
            }
            $f = realpath($path . $filename);
            if ($f && is_file($f)) {
                return $f;
            }
        }
        return false;
    }
}
spl_autoload_register(array('Ilib_ClassLoader', 'autoload'));
