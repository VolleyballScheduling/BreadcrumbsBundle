<?php
namespace Volleyball\Bundle\BreadcrumbsBundle\Twig\Extension;

use \Symfony\Component\DependencyInjection\ContainerInterface;
use \Symfony\Component\Templating\Helper\Helper;
use \Volleyball\Bundle\BreadcrumbsBundle\Model\Breadcrumb;

class BreadcrumbsExtension extends \Twig_Extension
{
    /**
     * Container
     * @var \Symfony\Component\DependencyInjection\ContainerInterface;
     */
    protected $container;

    /**
     * Breadcrumbs
     * @var array
     */
    protected $breadcrumbs;

    /**
     * Construct
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->breadcrumbs = $container->get("volleyball_breadcrumbs");
    }

    /**
     * Get functions
     * @return array
     */
    public function getFunctions()
    {
        return array(
            "breadcrumbs"  => new \Twig_Function_Method($this, "getBreadcrumbs", array("is_safe" => array("html"))),
            "render_breadcrumbs" => new \Twig_Function_Method($this, "renderBreadcrumbs", array("is_safe" => array("html"))),
        );
    }

    /**
     * Get filters
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return array(
            "volleyball_is_final_breadcrumb" => new \Twig_Filter_Method($this, "isLastBreadcrumb"),
        );
    }

    /**
     * Get breadcrumbs
     * @return \Volleyball\Bundle\BreadcrumbsBundle\Model\Breadcrumbs
     */
    public function getBreadcrumbs()
    {
        return $this->breadcrumbs;
    }

    /**
     * Render breadcrumbs
     * @param  array  $options
     * @return array
     */
    public function renderBreadcrumbs(array $options = array())
    {
        return $this->container->get("volleyball_breadcrumbs.helper")->breadcrumbs($options);
    }

    /**
     * Is least breadcrumb
     * @param  Breadcrumb $crumb
     * @return boolean
     */
    public function isLastBreadcrumb(Breadcrumb $crumb)
    {
        return ($this->breadcrumbs[count($this->breadcrumbs)-1] === $crumb);
    }

    /**
     * Get name
     * @return string
     */
    public function getName()
    {
        return "breadcrumbs";
    }
}
