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
        return call_user_func([$this, 'is'.$responseType]);
    }
}
