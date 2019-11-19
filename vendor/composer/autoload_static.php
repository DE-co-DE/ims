<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit06199264b0e7cd8e81d2f250071a50bc
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Sarav\\Multiauth\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Sarav\\Multiauth\\' => 
        array (
            0 => __DIR__ . '/..' . '/sarav/laravel-multiauth/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit06199264b0e7cd8e81d2f250071a50bc::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit06199264b0e7cd8e81d2f250071a50bc::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}