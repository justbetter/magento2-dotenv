<?php

namespace JustBetter\DotEnv\Plugin;

use JustBetter\DotEnv\App\MagentoDotEnv;
use Magento\Config\Model\Config\Processor\EnvironmentPlaceholder;

class EnvironmentPlaceholderPlugin
{
    public function beforeProcess(
        EnvironmentPlaceholder $subject,
        array $result
    ) {
        new MagentoDotEnv;
    }
}
