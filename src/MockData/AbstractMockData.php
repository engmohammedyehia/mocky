<?php
namespace App\MockData;

/**
 * Class AbstractMockData
 * @package App\MockData
 */
class AbstractMockData implements IMockData
{
    public function buildResponse(string $responseType): string
    {
        $methodToCallOnChild = 'is'.$responseType;
        return $this->$methodToCallOnChild();
    }
}
