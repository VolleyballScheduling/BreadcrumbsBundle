<?php
namespace Volleyball\Bundle\BreadcrumbsBundle\DependencyInjection;

use \Symfony\Component\Config\Definition\Builder\TreeBuilder;

class Configuration implements \Symfony\Component\Config\Definition\ConfigurationInterface
{
    /**
     * Get config TreeBuilder
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root("volleyball_breadcrumbs");

        $rootNode->
            children()->
                scalarNode("separator")->defaultValue("/")->end()->
                scalarNode("separatorClass")->defaultValue("separator")->end()->
                scalarNode("listId")->defaultValue("breadcrumbs")->end()->
                scalarNode("listClass")->defaultValue("breadcrumb")->end()->
                scalarNode("itemClass")->defaultValue("")->end()->
                scalarNode("linkRel")->defaultValue("")->end()->
                scalarNode("locale")->defaultNull()->end()->
                scalarNode("translation_domain")->defaultNull()->end()->
                scalarNode("viewTemplate")->defaultValue("VolleyballBreadcrumbsBundle::breadcrumbs.html.twig")->end()->
            end()
        ;

        return $treeBuilder;
    }
}
