<?php

namespace JustBetter\DotEnv\App;

use Dotenv\Dotenv;

class MagentoDotEnv
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->loadEnv();
    }

    /**
     * Load dot env file from app/etc/.env
     *
     * @return void
     */
    protected function loadEnv(): void
    {
        $rootDirectory = __DIR__;

        while ($rootDirectory != '/') {
            if (is_dir($rootDirectory.'/app/etc') && file_exists($rootDirectory.'/app/etc/.env')) {
                $dotenv = new Dotenv($rootDirectory.'/app/etc/');
                $dotenv->overLoad();
                $dotenv->required(['APP_ENV', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD', 'CRYPT_KEY']);
                $this->loadEnvironments($rootDirectory);
                break;
            }

            $rootDirectory = dirname($rootDirectory);
        }
    }

    /**
     * Load environments depending on APP_ENV.
     *
     * @return void
     */
    protected function loadEnvironments($rootDirectory): void
    {
        $this->setEnvironment('APP_ENV', $_ENV['APP_ENV'] ?: 'development');
        $this->setEnvironment('MAGE_MODE', $_ENV['APP_ENV'] !== 'production' ? 'developer' : 'production');

        // override .env values
        if (file_exists($rootDirectory.'/app/etc/.env.'.$_ENV['APP_ENV'])) {
            $dotenv = new Dotenv($rootDirectory.'/app/etc/', '.env.'.$_ENV['APP_ENV']);
            $dotenv->overload();
        }
    }

    /**
     * Set additional environment variables.
     *
     * @param string $key
     * @param mixed $value
     */
    public function setEnvironment(string $key, $value): void
    {
        $_ENV[$key] = $value;
    }
}

new MagentoDotEnv;
