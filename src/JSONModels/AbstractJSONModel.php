<?php
namespace App\JSONModels;

/**
 * Class AbstractJSONModel
 * This class plays the role of the Composite in which that you can compose
 * a tree structure of different JSON Models.
 * a tree structure of different JSON Models. If you want to
 * @package App\Models
 */
abstract class AbstractJSONModel
{
    /** @var string|null */
    protected $name;

    /** @var array */
    protected $data;

    /**
     * AbstractJSONModel constructor.
     * @param string|null $name
     * @param array $data
     */
    public function __construct(?string $name = null, array $data = [])
    {
        $this->data = $data;
        $this->name = $name;
    }

    /**
     * Cloning an object with only the name set to null
     */
    public function __clone()
    {
        $this->setName(null);
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }

    /** Renders the data array */
    public function render(): array
    {
        return $this->getName() ? [$this->getName() => $this->getData()] : $this->getData();
    }
}
