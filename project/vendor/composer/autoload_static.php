<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf8e3a9a67baff6b9c89a344e27541cdc
{
    public static $prefixLengthsPsr4 = array (
        'c' => 
        array (
            'core\\' => 5,
        ),
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core',
        ),
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'app\\conexao\\Conexao' => __DIR__ . '/../..' . '/app/conexao/Conexao.php',
        'app\\controllers\\FornecedorController' => __DIR__ . '/../..' . '/app/controllers/FornecedorController.php',
        'app\\controllers\\HomeController' => __DIR__ . '/../..' . '/app/controllers/HomeController.php',
        'app\\controllers\\ProdutoController' => __DIR__ . '/../..' . '/app/controllers/ProdutoController.php',
        'app\\controllers\\RocketController' => __DIR__ . '/../..' . '/app/controllers/RocketController.php',
        'app\\controllers\\UsuarioController' => __DIR__ . '/../..' . '/app/controllers/UsuarioController.php',
        'app\\interfaces\\IDAO' => __DIR__ . '/../..' . '/app/interfaces/IDAO.php',
        'app\\model\\bo\\FornecedorBO' => __DIR__ . '/../..' . '/app/model/bo/FornecedorBO.php',
        'app\\model\\bo\\ProdutoBO' => __DIR__ . '/../..' . '/app/model/bo/ProdutoBO.php',
        'app\\model\\bo\\RocketBO' => __DIR__ . '/../..' . '/app/model/bo/RocketBO.php',
        'app\\model\\bo\\UsuarioBO' => __DIR__ . '/../..' . '/app/model/bo/UsuarioBO.php',
        'app\\model\\dao\\FornecedorDao' => __DIR__ . '/../..' . '/app/model/dao/fornecedorDao.php',
        'app\\model\\dao\\ProdutoDao' => __DIR__ . '/../..' . '/app/model/dao/produtoDao.php',
        'app\\model\\dao\\RocketDao' => __DIR__ . '/../..' . '/app/model/dao/rocketDao.php',
        'app\\model\\dao\\UsuarioDao' => __DIR__ . '/../..' . '/app/model/dao/usuarioDao.php',
        'core\\AbsController' => __DIR__ . '/../..' . '/core/AbsController.class.php',
        'core\\ControllerUtil' => __DIR__ . '/../..' . '/core/ControllerUtil.class.php',
        'core\\Redirecionador' => __DIR__ . '/../..' . '/core/Redirecionador.class.php',
        'core\\Rota' => __DIR__ . '/../..' . '/core/Rota.class.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf8e3a9a67baff6b9c89a344e27541cdc::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf8e3a9a67baff6b9c89a344e27541cdc::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf8e3a9a67baff6b9c89a344e27541cdc::$classMap;

        }, null, ClassLoader::class);
    }
}
