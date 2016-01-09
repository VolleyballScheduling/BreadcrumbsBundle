<?php
namespace Volleyball\Bundle\\BreadcrumbsBundle\Templating\Helper;

use \Symfony\Component\Templating\Helper\Helper;
use \Symfony\Component\Templating\EngineInterface;
use \Volleyball\Bundle\BreadcrumbsBundle\Model\Breadcrumbs;

class BreadcrumbsHelper extends Helper
{
    /**
     * Templating service
     * @param \Symfony\Component\Templating\EngineInterface $templating
     */
    protected $templating;

    /**
     * Breadcrumbs
     * @var array
     */
    protected $breadcrumbs;

    /**
     * Options
     * @var array
     */
    protected $options = array();

    /**
     * Construct
     * @param \Symfony\Component\Templating\EngineInterface $templating
     * @param \Volleyball\Bundle\BreadcrumbsBundle\Model\Breadcrumbs $breadcrumbs
     * @param array $options
     */
    public function __construct(EngineInterface $templating, Breadcrumbs $breadcrumbs, array $options)
    {
        $this->templating  = $templating;
        $this->breadcrumbs = $breadcrumbs;
        $this->options = $options;
    }

    /**
     * Breadcrumbs
     * @param  array  $options
     * @return mixed
     */
    public function breadcrumbs(array $options = array())
    {
        $options = $this->resolveOptions($options);

        return $this->templating->render(
                $options["viewTemplate"],
                $options
        );
    }

    /**
     * Get name
     * @codeCoverageIgnore
     * @return string
     */
    public function getName()
    {
        return 'breadcrumbs';
    }

    /**
     * Resolve options
     * @param  array  $options
     * @return array
     */
    private function resolveOptions(array $options = array())
    {
        $this->options["breadcrumbs"] = $this->breadcrumbs;
        return array_merge($this->options, $options);
    }
}
