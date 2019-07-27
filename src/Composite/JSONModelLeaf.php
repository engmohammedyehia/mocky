<?php
namespace App\Composite;

class JSONModelLeaf extends AbstractJSONModel
{
    /**
     * The leaf should have a different implementation of the Abstract model render operation
     * but in our case its the same rendering process
     * The purpose of the leaf is that it cannot have any child nodes
    */
}
