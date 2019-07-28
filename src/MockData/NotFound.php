<?php
namespace App\MockData;

use App\JSONModels\JSONModelComposite;
use App\JSONModels\JSONModelLeaf;

/**
 * Class Employee
 * @package App\MockData
 */
class NotFound extends AbstractMockData
{
    protected function isDefault(): string
    {
        return '';
    }
}
