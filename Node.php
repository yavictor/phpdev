<?php
    /**
     * Не хватило времени реализовать в ООП стиле, подвела виртуалка.
     */
use \NodeInterface

class Node implements NodeInterface
{
    public function __construct($value = null)
    {
        $this->setValue($value);

        if (!empty($children)) {
            $this->setChildren($children);
        }
    }

    public function __toString()
    {
        echo $this->value;
    }

    public function getName()
    {
        return $this->value;
    }

    public function getChildren()
    {
        return $this->value;
    }

    public function addChild(NodeInterface $child)
    {
        $child->setParent($this);
        $this->children[] = $child;

        return $this;
    }

    private function setChildren(array $children)
    {
        $this->removeParentFromChildren();
        $this->children = [];

        foreach ($children as $child) {
            $this->addChild($child);
        }

        return $this;
    }

    private function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    private function setParent(?NodeInterface $parent = null)
    {
        $this->parent = $parent;
    }
}
