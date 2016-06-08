<?php
/**
 * Created by grkr
 * Filename: SmartyStrategyFactory.php
 * Date: 3/7/14
 * Time: 9:33 AM
 */

namespace GkSmarty\View;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class SmartyStrategyFactory implements FactoryInterface
{   
    
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new SmartyStrategy($container->get('GkSmartyRenderer'));
    }
    
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, SmartyStrategy::class);
    }
}