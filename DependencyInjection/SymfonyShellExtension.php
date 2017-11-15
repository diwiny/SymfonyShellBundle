<?php

namespace Diwiny\SymfonyShellBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

final class SymfonyShellExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        foreach ($config['variables'] as $name => &$value) {
            if (is_string($value) && $value[0] === '@') {
                $value = new Reference(substr($value, 1));
            }
        }
        $container
            ->findDefinition('psysh.shell')
            ->addMethodCall(
                'setScopeVariables',
                [
                    $config['variables']
                    +
                    [
                        'container' => new Reference('service_container'),
                        'kernel' => new Reference('kernel'),
                        'self' => new Reference('psysh.shell'),
                        'parameters' => new Expression("service('service_container').getParameterBag().all()")
                    ]
                ]
            );
    }
}
