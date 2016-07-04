<?php
/**
 * Created by grkr
 * Filename: HelperPluginManagerFactory.php
 * Date: 3/7/14
 * Time: 1:28 PM
 */

namespace GkSmarty\View;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Config;
use Zend\ServiceManager\ConfigInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Exception;

class HelperPluginManagerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $arOptions = null)
    {
        /** @var \GkSmarty\ModuleOptions $options */
        $options = $container->get('GkSmarty\ModuleOptions');
        $smartyManagerOptions = $options->getHelperManager();
        $smartyManagerConfigs = isset($smartyManagerOptions['configs']) ? $smartyManagerOptions['configs'] : array();

        $zfManager = $container->get('ViewHelperManager');
//        $smartyManager = new HelperPluginManager(new Config($smartyManagerOptions));
//        $smartyManager->setServiceLocator($container);
//        $smartyManager->addPeeringServiceManager($zfManager);
//$smartyManager = new HelperPluginManager($container);
        $smartyManager = $zfManager;
        
        foreach ($smartyManagerConfigs as $configClass) {
            if (is_string($configClass) && class_exists($configClass)) {
                $config = new $configClass;

                if (!$config instanceof ConfigInterface) {
                    throw new Exception\RuntimeException(
                        sprintf(
                            'Service manager configuration classes must implement %s; received %s',
                            'Zend\ServiceManager\ConfigInterface',
                            is_object($configClass) ? get_class($configClass) : gettype($configClass)
                        )
                    );
                }

                $config->configureServiceManager($smartyManager);
            }
        }

        return $smartyManager;
    }
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, HelperPluginManager::class);
    }
}