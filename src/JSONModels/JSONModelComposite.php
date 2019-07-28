<?php
namespace App\JSONModels;

use SplObjectStorage;

class JSONModelComposite extends AbstractJSONModel
{
    /** @var SplObjectStorage */
    private $nodes;

    /**
     * JSONModelComposite constructor.
     * @param string|null $name
     * @param array|null $data
     */
    public function __construct(?string $name, ?array $data = [])
    {
        $this->nodes = new SplObjectStorage();
        parent::__construct($name, $data);
    }

    /**
     * @return SplObjectStorage
     */
    public function getNodes(): SplObjectStorage
    {
        return $this->nodes;
    }

    /**
     * @param SplObjectStorage $nodes
     */
    public function setNodes(SplObjectStorage $nodes): void
    {
        $this->nodes = $nodes;
    }

    /** Add a model to the nodes list
     * @param AbstractJSONModel $model
     */
    public function addNode(AbstractJSONModel $model)
    {
        $this->nodes->attach($model);
        $this->setData($this->getData() + $model->render());
    }

    /**
     * Remove a model from the node list
     * @param AbstractJSONModel $model
     */
    public function removeNode(AbstractJSONModel $model)
    {
        $this->nodes->detach($model);
    }
}
