<?php
/**
 * @Author: katherine
 */

namespace View\Block;

use Controller\Core\Router;
use Model\Request;

abstract class AbstractBlock
{
    protected $template;
    protected $children;

    public function __construct($children)
    {
        $this->children = $children;
        $this->router = new Router();
    }

    public function render()
    {
        require $this->template;
    }

    public function getChildHtml($forcedBlock = null)
    {
        if (array_key_exists($forcedBlock, $this->children)) {
            $blockClass = '\\View\\Block\\'.$forcedBlock;
            $block = new $blockClass($this->children[$forcedBlock]);
            $block->render();
            $this->removeChild($forcedBlock);
        } elseif (is_null($forcedBlock)) {
            foreach ($this->children as $blockName => $children) {
                $blockClass = '\\View\\Block\\' . $blockName;
                $block = new $blockClass($children);
                $block->render();
            }
        }
    }

    protected function removeChild($childName)
    {
        unset($this->children[$childName]);
    }
}
