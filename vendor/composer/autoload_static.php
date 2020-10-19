<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit075453ee76f4f682395bac69a392bb5c
{
    public static $prefixLengthsPsr4 = array (
        'J' => 
        array (
            'JbSanctum\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'JbSanctum\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit075453ee76f4f682395bac69a392bb5c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit075453ee76f4f682395bac69a392bb5c::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
