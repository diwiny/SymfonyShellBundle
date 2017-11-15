<?php

namespace Diwiny\SymfonyShellBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('symfony_shell');

        $rootNode
        ->children()
        ->arrayNode('variables')
        ->useAttributeAsKey('variable_name')
        ->prototype('variable')->end()
        ->end()
        ->end();

        return $treeBuilder;
    }
}
