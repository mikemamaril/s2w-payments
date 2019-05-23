<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5603e24a1bd7da7716aa8c953f06a206
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'SquareConnect\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'SquareConnect\\' => 
        array (
            0 => __DIR__ . '/..' . '/square/connect/lib',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5603e24a1bd7da7716aa8c953f06a206::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5603e24a1bd7da7716aa8c953f06a206::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}