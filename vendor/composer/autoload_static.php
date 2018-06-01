<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5ddb182847d87c958e428ec6e9a1501f
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Models\\' => 7,
        ),
        'C' => 
        array (
            'Controllers\\' => 12,
            'Config\\' => 7,
            'Common\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Models\\' => 
        array (
            0 => __DIR__ . '/../..' . '/models',
        ),
        'Controllers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/controllers',
        ),
        'Config\\' => 
        array (
            0 => __DIR__ . '/../..' . '/config',
        ),
        'Common\\' => 
        array (
            0 => __DIR__ . '/../..' . '/common',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5ddb182847d87c958e428ec6e9a1501f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5ddb182847d87c958e428ec6e9a1501f::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
