<?php

namespace Scoris\Contact\Http\Controllers\Api;

use Illuminate\Http\Request;
use Scoris\Base\Http\Controllers\BaseController;
use Scoris\Contact\Repositories\Interfaces\ContactInterface;

class ContactController extends BaseController
{
    protected $contactRepository;

    public function __construct(ContactInterface $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function list_user_contact($id)
    {
        return $this->contactRepository->list_user_contact($id);
    }

    public function index()
    {
        return $this->contactRepository->index();
    }

    public function store(Request $request)
    {
        return $this->contactRepository->store($request);
    }

    public function destroy($id)
    {
        return $this->contactRepository->delete($id);
    }
}
