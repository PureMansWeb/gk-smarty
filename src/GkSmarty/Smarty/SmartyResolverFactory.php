<?php
/**
 * Created by grkr
 * Filename: SmartyResolverFactory.php
 * Date: 3/7/14
 * Time: 11:22 AM
 */

namespace GkSmarty\Smarty;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Resolver\AggregateResolver;

class SmartyResolverFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $arOptions = null)
    {
        $resolver = new AggregateResolver();
        $resolver->attach($container->get('GkSmartyTemplateMapResolver'));
        $resolver->attach($container->get('GkSmartyTemplatePathStack'));

        return $resolver;
    }
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, AggregateResolver::class);
    }
}