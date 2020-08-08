<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7e0e1381d9eb310777add60d10ab7703
{
    public static $prefixLengthsPsr4 = array (
        'K' => 
        array (
            'Kodoti\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Kodoti\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Kodoti',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7e0e1381d9eb310777add60d10ab7703::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7e0e1381d9eb310777add60d10ab7703::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}