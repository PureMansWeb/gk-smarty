<?php
/**
 * Created by grkr
 * Filename: TemplatePathStackFactory.php
 * Date: 3/7/14
 * Time: 11:29 AM
 */

namespace GkSmarty\Smarty;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class TemplatePathStackFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $arOptions = null)
    {
        /** @var \GkSmarty\ModuleOptions $options */
        $options = $container->get('GkSmarty\ModuleOptions');

        /** @var \Zend\View\Resolver\TemplatePathStack */
        $templatePathStack = $container->build('ViewTemplatePathStack');
        $templatePathStack->setDefaultSuffix($options->getSuffix());

        return $templatePathStack;
    }
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, \Zend\View\Resolver\TemplatePathStack::class);
    }
}