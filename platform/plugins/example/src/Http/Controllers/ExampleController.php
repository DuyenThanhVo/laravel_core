<?php

namespace Scoris\Example\Http\Controllers;

use Scoris\Base\Http\Controllers\BaseController;
use Assets;
use Scoris\Example\Repositories\Interfaces\ExampleInterface;

class ExampleController extends BaseController
{
    protected $exampleRepository;

    public function __construct(ExampleInterface $exampleRepository)
    {
        $this->exampleRepository = $exampleRepository;
    }

    public function index()
    {
        page_title()->setTitle(__('plugins/example::example.text'));
        Assets::addStylesDirectly('vendor/core/plugins/example/css/example.css');
        return view('plugins/example::index');
    }

    public function store($example)
    {
        $this->exampleRepository->createExample($example);
        return redirect()->route('example');
    }
}
