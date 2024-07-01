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
            if (is_dir($rootDirectory.'/app/etc') && (file_exists($rootDirectory.'/app/etc/.env') || file_exists($rootDirectory.'/.env'))) {
                $dotenv = Dotenv::createMutable([$rootDirectory, $rootDirectory.'/app/etc/']);
                $dotenv->load();
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

        $dotenv = Dotenv::createMutable([$rootDirectory, $rootDirectory.'/app/etc/'], array_filter([...$this->envToArray($_ENV['LOAD_BEFORE'] ?? ''), '.env.'.$_ENV['APP_ENV'], '.env', ...$this->envToArray($_ENV['LOAD_AFTER'] ?? '')]), false);
        $dotenv->load();

        $this->setEnvironment('MAGE_MODE', $_ENV['APP_ENV'] !== 'production' ? 'developer' : 'production');
    }

    /**
     * Turn space seperated paths into array, ignoring escape sequences.
     */
    protected function envToArray(string $envValue = ''): array
    {
        $array = preg_split('/(?<!\\\) /', $envValue);
        return preg_replace('/(?<!\\\) /', ' ', $array);
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
