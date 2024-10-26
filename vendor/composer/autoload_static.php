<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd8e2a9de9712915696702e75e1db37c0
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Antoinecorbin\\Nova2FA\\' => 22,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Antoinecorbin\\Nova2FA\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitd8e2a9de9712915696702e75e1db37c0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd8e2a9de9712915696702e75e1db37c0::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd8e2a9de9712915696702e75e1db37c0::$classMap;

        }, null, ClassLoader::class);
    }
}