<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8455c4b4275a9e4ba72254c2dfa651bf
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'CON\\CheckoutProfiler\\Views\\Public\\' => 34,
            'CON\\CheckoutProfiler\\Views\\Admin\\' => 33,
            'CON\\CheckoutProfiler\\Views\\' => 27,
            'CON\\CheckoutProfiler\\Models\\' => 28,
            'CON\\CheckoutProfiler\\Controllers\\App\\' => 37,
            'CON\\CheckoutProfiler\\Controllers\\' => 33,
            'CON\\CheckoutProfiler\\' => 21,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'CON\\CheckoutProfiler\\Views\\Public\\' => 
        array (
            0 => __DIR__ . '/../..' . '/views/public',
        ),
        'CON\\CheckoutProfiler\\Views\\Admin\\' => 
        array (
            0 => __DIR__ . '/../..' . '/views/admin',
        ),
        'CON\\CheckoutProfiler\\Views\\' => 
        array (
            0 => __DIR__ . '/../..' . '/views',
        ),
        'CON\\CheckoutProfiler\\Models\\' => 
        array (
            0 => __DIR__ . '/../..' . '/models',
        ),
        'CON\\CheckoutProfiler\\Controllers\\App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/controllers/app',
        ),
        'CON\\CheckoutProfiler\\Controllers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/controllers',
        ),
        'CON\\CheckoutProfiler\\' => 
        array (
            0 => '/',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8455c4b4275a9e4ba72254c2dfa651bf::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8455c4b4275a9e4ba72254c2dfa651bf::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit8455c4b4275a9e4ba72254c2dfa651bf::$classMap;

        }, null, ClassLoader::class);
    }
}
