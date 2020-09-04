<?php

namespace JustBetter\DotEnv\Setup;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Component\ComponentRegistrar;
use Magento\Framework\Component\ComponentRegistrarInterface;
use Magento\Framework\Filesystem;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    /**
     * @var InstallBlocks
     */
    protected $installBlocks;

    /**
     * InstallData constructor.
     *
     * @param InstallBlocks $installBlocks
     */
    public function __construct(
        Filesystem $filesystem,
        ComponentRegistrarInterface $componentRegistrarInterface
    ) {
        $this->filesystem = $filesystem;
        $this->componentRegistrar = $componentRegistrarInterface;
    }

    /**
     * {@inheritdoc}
     */
    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $root = $this->filesystem->getDirectoryRead(DirectoryList::ROOT);
        $dirPath = $root->getAbsolutePath();
        $relativeModulePath = str_replace(
            $dirPath,
            '',
            $this->componentRegistrar->getPath(ComponentRegistrar::MODULE, 'JustBetter_DotEnv')
        );

        $composerJson = file_get_contents($dirPath.'/composer.json');
        $composerPhp = json_decode($composerJson, true);

        if (! array_search($relativeModulePath.'/app/MagentoDotEnv.php', $composerPhp['autoload']['files'])) {
            $composerPhp['autoload']['files'][] = $relativeModulePath.'/app/MagentoDotEnv.php';
            file_put_contents($dirPath.'/composer.json', json_encode($composerPhp, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES));
        }
    }
}
