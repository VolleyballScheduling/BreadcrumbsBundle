<?php
namespace Volleyball\Bundle\BreadcrumbsBundle\Model;

class Breadcrumb
{
    /**
     * Url
     * @var string
     */
    public $url;

    /**
     * Text
     * @var string5
     */
    public $text;

    /**
     * Translation parameters
     * @var array
     */
    public $translationParams;

    /**
     * Constructor
     * @param string $text                  [description]
     * @param string $url                   [description]
     * @param array  $translationParams [description]
     */
    public function __construct($text = "", $url = "", array $translationParams = array())
    {
        $this->url = $url;
        $this->text = $text;
        $this->translationParams = $translationParams;
    }
}