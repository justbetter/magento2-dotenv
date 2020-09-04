<?php

namespace JustBetter\DotEnv\Plugin\DeploymentConfig;

use Magento\Framework\App\DeploymentConfig\Writer;

class WriterPlugin
{
    /**
     * Remove APP_ENV from data array.
     *
     * @param  Writer  $subject
     * @param  array   $data
     * @return array
     */
    public function aroundSaveConfig(
        Writer $subject,
        callable $proceed,
        array $data,
        $override = false,
        $pool = null,
        array $comments = []
    ) {
        unset($data['app_env']);
        $proceed($data, $override, $pool, $comments);
    }
}
