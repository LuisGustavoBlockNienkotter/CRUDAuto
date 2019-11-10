<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit31ef15358a998d6480f1f6cde07ada20
{
    public static $prefixLengthsPsr4 = array (
        'h' => 
        array (
            'helpers\\' => 8,
        ),
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'helpers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/helpers',
        ),
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'app\\AuxBuilders\\File\\FileBuilder' => __DIR__ . '/../..' . '/app/AuxBuilders/File/FileBuilder.php',
        'app\\AuxBuilders\\Script\\Method' => __DIR__ . '/../..' . '/app/AuxBuilders/Script/Method.php',
        'app\\AuxBuilders\\Script\\Parameter' => __DIR__ . '/../..' . '/app/AuxBuilders/Script/Parameter.php',
        'app\\AuxBuilders\\Script\\Printer' => __DIR__ . '/../..' . '/app/AuxBuilders/Script/Printer.php',
        'app\\AuxBuilders\\Script\\Property' => __DIR__ . '/../..' . '/app/AuxBuilders/Script/Property.php',
        'app\\AuxBuilders\\Script\\ScriptClass' => __DIR__ . '/../..' . '/app/AuxBuilders/Script/ScriptClass.php',
        'app\\AuxBuilders\\Strings\\StringBuilder' => __DIR__ . '/../..' . '/app/AuxBuilders/Strings/StringBuilder.php',
        'app\\BuilderJson\\BuildJson' => __DIR__ . '/../..' . '/app/BuilderJson/buildJson.php',
        'app\\BuilderJson\\model\\Objects' => __DIR__ . '/../..' . '/app/BuilderJson/model/objects.php',
        'app\\CreateControllers\\ControllerBuilder' => __DIR__ . '/../..' . '/app/CreateControllers/ControllerBuilder.php',
        'app\\CreateModel\\CreateBo\\BuildBo' => __DIR__ . '/../..' . '/app/CreateModel/CreateBo/buildBo.php',
        'app\\CreateModel\\CreateDao\\BuildDao' => __DIR__ . '/../..' . '/app/CreateModel/CreateDao/buildDao.php',
        'app\\CreateModel\\CreateDto\\BuildDto' => __DIR__ . '/../..' . '/app/CreateModel/CreateDto/buildDto.php',
        'helpers\\Helpers' => __DIR__ . '/../..' . '/helpers/Helpers.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit31ef15358a998d6480f1f6cde07ada20::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit31ef15358a998d6480f1f6cde07ada20::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit31ef15358a998d6480f1f6cde07ada20::$classMap;

        }, null, ClassLoader::class);
    }
}
