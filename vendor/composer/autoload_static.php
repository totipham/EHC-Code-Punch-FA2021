<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4a3e12558f41848ec4950236e2b22897
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Team2\\CodePunch\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Team2\\CodePunch\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4a3e12558f41848ec4950236e2b22897::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4a3e12558f41848ec4950236e2b22897::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit4a3e12558f41848ec4950236e2b22897::$classMap;

        }, null, ClassLoader::class);
    }
}
