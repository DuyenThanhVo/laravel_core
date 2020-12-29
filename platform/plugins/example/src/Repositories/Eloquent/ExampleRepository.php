<?php
namespace Scoris\Example\Repositories\Eloquent;

use Scoris\Example\Repositories\Interfaces\ExampleInterface;
use Scoris\Support\Repositories\Eloquent\RepositoriesAbstract;

class ExampleRepository extends RepositoriesAbstract implements ExampleInterface {

    public function createExample(string $example)
    {
        return $this->create([
            'example' => $example
        ]);
    }
}
