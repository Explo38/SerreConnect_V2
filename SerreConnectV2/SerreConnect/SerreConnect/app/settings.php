<?php

declare(strict_types=1);

use App\Application\Settings\Settings;
use App\Application\Settings\SettingsInterface;
use DI\ContainerBuilder;
use Monolog\Logger;

return function (ContainerBuilder $containerBuilder) {

    // Global Settings Object
    $containerBuilder->addDefinitions([
        SettingsInterface::class => function () {
            return new Settings([
                'displayErrorDetails' => true, // Should be set to false in production
                'logError'            => false,
                'logErrorDetails'     => false,
                'logger' => [
                    'name' => 'slim-app',
                    'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
                    'level' => Logger::DEBUG,
                ],
                "db"=> [
                    'driver'=> 'mysql',
                    'host'=> 'mysql-serreconnect.alwaysdata.net',
                    'username'=>'329962_connect',
                    'database'=>'serreconnect_bdd',
                    'password'=>'chouxvert',
                    'charset'=>'utf8mb4',
                    'collation'=>'utf8mb4_unicode_ci',
                    'flags'=>[
                        //Turn off persistent connections
                        PDO::ATTR_PERSISTENT=>false,
                        //Enable exceptions
                        PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION,
                        //Emulate prepared statements
                        PDO::ATTR_EMULATE_PREPARES=>true,
                        //Set default fetch mode to array
                        PDO::ATTR_DEFAULT_FETCH_MODE=> PDO::FETCH_ASSOC,
                    ],
                ],
            ]);
        },

        // Configuration de PDO avec les paramètres de la base de données
        PDO::class => function (SettingsInterface $settings) {
            $dbSettings = $settings->get('db');
            $dsn = "{$dbSettings['driver']}:host={$dbSettings['host']};dbname={$dbSettings['database']};charset={$dbSettings['charset']}";
            return new PDO($dsn, $dbSettings['username'], $dbSettings['password'], $dbSettings['flags']);
        }
    ]);
};
