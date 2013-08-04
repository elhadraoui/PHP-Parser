<?php

/*
 * Set error reporting to the level to which Zend Framework code must comply.
 */
error_reporting( E_ALL | E_STRICT );

if (class_exists('PHPUnit_Runner_Version', true)) {
	echo 'Class PHPUnit_Runner_Version exists' . PHP_EOL;
    $phpUnitVersion = PHPUnit_Runner_Version::id();
    if ('@package_version@' !== $phpUnitVersion && version_compare($phpUnitVersion, '3.7.0', '<')) {
        echo 'This version of PHPUnit (' . PHPUnit_Runner_Version::id() . ') is not supported'
           . ' in \PHPParser unit tests. Supported is version 3.7.0  or higher.'
           . ' See also: https://github.com/anezi/PHP-Parser/blob/master/CONTRIBUTING.md#running-tests' . PHP_EOL;
        exit(1);
    }
    unset($phpUnitVersion);
} else {
	echo 'Class PHPUnit_Runner_Version not found' . PHP_EOL;
}

$vRoot        = realpath(dirname(__DIR__));
$vCoreLibrary = "$vRoot/lib";
$vCoreTests   = "$vRoot/tests";

$path = array(
    $vCoreLibrary,
    $vCoreTests,
    get_include_path(),
);
set_include_path(implode(PATH_SEPARATOR, $path));

function __autoload($className)
{
	global $vCoreLibrary;
	
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';
    if ($lastNsPos = strripos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

    require $vCoreLibrary . DIRECTORY_SEPARATOR . $fileName;
}

/*
 * Unset global variables that are no longer needed.
 */
unset($vRoot, $vCoreLibrary, $vCoreTests, $path);
