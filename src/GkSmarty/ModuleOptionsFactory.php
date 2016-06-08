<?php
/**
 * Created by grkr
 * Filename: ModuleOptionsFactory.php
 * Date: 3/7/14
 * Time: 9:27 AM
 */

namespace GkSmarty;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ModuleOptionsFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $arOptions = null)
    {
        $config = $container->get('Configuration');

        return new ModuleOptions(isset($config['gk_smarty']) ? $config['gk_smarty'] : array());
    }
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, ModuleOptions::class);
    }
}