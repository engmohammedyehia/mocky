<?php
namespace App\MockData;

use App\JSONModels\JSONModelComposite;
use App\JSONModels\JSONModelLeaf;

/**
 * Class Employee
 * @package App\MockData
 */
class Employee extends AbstractMockData
{
    protected function isDefault(): string
    {
        $employees = new JSONModelComposite('employees');
        $mohammed = new JSONModelLeaf('mohammed', [
            'name' => 'Mohammed Abdoh',
            'age' => 37,
            'address' => 'Salouter 18, 13905 Berlin',
            'Company' => 'Check24'
        ]);
        $ahmed = new JSONModelLeaf('ahmed', [
            'name' => 'Ahmed Abdoh',
            'age' => 33,
        ]);
        $employees->addNode($mohammed);
        $employees->addNode($ahmed);
        return json_encode($employees->render(), JSON_PRETTY_PRINT);
    }

    protected function isNewResource(): string
    {
        return json_encode([], JSON_PRETTY_PRINT);
    }

    protected function isUnAuthorized(): string
    {
        return json_encode([], JSON_PRETTY_PRINT);
    }
}
