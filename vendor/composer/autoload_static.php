<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0d853360d72c5eeb8fc0d9cf7fe48fd3
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0d853360d72c5eeb8fc0d9cf7fe48fd3::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0d853360d72c5eeb8fc0d9cf7fe48fd3::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}