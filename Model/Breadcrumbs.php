<?php
namespace Volleyball\Bundle\BreadcrumbsBundle\Model;

class Breadcrumbs implements \Iterator, \ArrayAccess, \Countable
{
    /**
     * Breadcrumbs
     * @var array
     */
    protected $breadcrumbs = array();

    /**
     * Position
     * @var integer
     */
    protected $position = 0;

    /**
     * Add a crumb
     * @param string $text
     * @param string $url
     * @param array  $translationParams
     */
    public function addItem($text, $url = "", array $translationParams = array())
    {
        $crumb = new Breadcrumb($text, $url, $translationParams);
        $this->breadcrumbs[] = $crumb;

        return $this;
    }

    /**
     * Add an array of object
     * @param array  $objects
     * @param string $text
     * @param string $url
     * @param array  $translationParams [description]
     */
    public function addObjectArray(array $objects, $text, $url = "", array $translationParams = array()) {
        foreach($objects as $object) {
            $crumbText = $this->validateArgument($object, $text);
            if ($url != "") {
                $crumbUrl = $this->validateArgument($object, $url);
            } else {
                $crumbUrl = "";
            }
            $this->addCrumb($crumbText, $crumbUrl, $translationParams);
        }

        return $this;
    }

    /**
     * Clear breadcrumbs
     * @return \Volleyball\Bundle\BreadcrumbsBundle\Model\Breadcrumbs
     */
    public function clear()
    {
        $this->breadcrumbs = array();

        return $this;
    }

    /**
     * Add a tree of objects
     * @param [type]  $object
     * @param [type]  $text
     * @param string  $url
     * @param string  $parent
     * @param array   $translationParams
     * @param integer $firstPosition
     */
    public function addObjectTree($object, $text, $url = "", $parent = 'parent', array $translationParams = array(), $firstPosition = -1) {
        $crumbText = $this->validateArgument($object, $text);
        if ($url != "") {
            $crumbUrl = $this->validateArgument($object, $url);
        } else {
            $crumbUrl = "";
        }
        $crumbParent = $this->validateArgument($object, $parent);
        if ($firstPosition == -1) {
            $firstPosition = sizeof($this->breadcrumbs);
        }
        $crumb = new Breadcrumb($crumbText, $crumbUrl, $translationParams);
        array_splice($this->breadcrumbs, $firstPosition, 0, array($crumb));
        if ($itemParent) {
            $this->addObjectTree($crumbParent, $text, $url, $parent, $translationParams, $firstPosition);
        }
        return $this;
    }

    /**
     * Rewind
     * @return array
     */
    public function rewind()
    {
        return reset($this->breadcrumbs);
    }

    /**
     * Current
     * @return \Volleyball\Bundle\BreadcrumbsBundle\Model\Breadcrumb
     */
    public function current()
    {
        return current($this->breadcrumbs);
    }

    /**
     * Key
     * @return string
     */
    public function key()
    {
        return key($this->breadcrumbs);
    }

    /**
     * Next
     * @return \Volleyball\Bundle\BreadcrumbsBundle\Model\Breadcrumbs
     */
    public function next()
    {
        return next($this->breadcrumbs);
    }

    /**
     * Valiud
     * @return boolean
     */
    public function valid()
    {
        return key($this->breadcrumbs) !== null;
    }

    /**
     * Offset exists
     * @param  mixed $offset
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->breadcrumbs[$offset]);
    }

    /**
     * Set offset
     * @param  mixed $offset
     * @param  mixed$value
     */
    public function offsetSet($offset, $value)
    {
        $this->breadcrumbs[$offset] = $value;
    }

    /**
     * Get offset
     * @param  mixed $offset
     * @return null|\Volleyball\Bundle\BreacrumbsBundle\Model\Breadcrumb
     */
    public function offsetGet($offset)
    {
        return isset($this->breadcrumbs[$offset]) ? $this->breadcrumbs[$offset] : null;
    }

    /**
     * Unset offset
     * @param  mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->breadcrumbs[$offset]);
    }

    /**
     * Count
     * @return integer
     */
    public function count()
    {
        return count($this->breadcrumbs);
    }

    /**
     * Validate argument
     * @param  mixed $object
     * @param  mixed $argument
     * @return mixed
     * @throws \InvalidArgumentException
     */
    private function validateArgument($object, $argument) {
        if (is_callable($argument)) {
            return $argument($object);
        } else {
            if (method_exists($object,'get' . $argument)) {
                return call_user_func(array(&$object,  'get' . $argument), 'get' . $argument);
            } else {
                throw new \InvalidArgumentException("A method with the name get$argument() does not exist.");
            }
        }
    }
}
