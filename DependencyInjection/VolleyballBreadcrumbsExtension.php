<?php
namespace WhiteOctober\Bundle\BreadcrumbsBundle\DependencyInjection;

use \Symfony\Component\DependencyInjection\ContainerBuilder;
use \Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use \Symfony\Component\Config\FileLocator;

class WhiteOctoberBreadcrumbsExtension extends \Symfony\Component\HttpKernel\DependencyInjection\Extension
{
    /**
     * Load
     * @param  array $configs
     * @param  ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $this->loadConfiguration($configs, $container);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('breadcrumbs.yml');
    }
   
    /**
     * Load configuration
     * @param  array $configs
     * @param  ContainerBuilder $container
     * @return \Symfony\Component\DependencyInjection\ContainerBuilder
     */
    protected function loadConfiguration(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter("volleyball_breadcrumbs.options", $config);
    }
}
