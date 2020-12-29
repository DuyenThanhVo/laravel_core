<?php

namespace Scoris\Contact\Http\Controllers\Api;

use Illuminate\Http\Request;
use Scoris\Base\Http\Controllers\BaseController;
use Scoris\Contact\Repositories\Interfaces\ContactCategoryInterface;

class ContactCategoryController extends BaseController
{
    protected $contactCategoryRepository;

    public function __construct(ContactCategoryInterface $contactCategoryRepository)
    {
        $this->contactCategoryRepository = $contactCategoryRepository;
    }

    public function index()
    {
        return $this->contactCategoryRepository->index();
    }

    public function store(Request $request)
    {
        return $this->contactCategoryRepository->store($request);
    }

    public function destroy($id)
    {
        return $this->contactCategoryRepository->delete($id);
    }
}
