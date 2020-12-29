<?php

namespace Scoris\Contact\Http\Controllers\Api;

use Illuminate\Http\Request;
use Scoris\Base\Http\Controllers\BaseController;
use Scoris\Contact\Repositories\Interfaces\UserContactInterface;

use Scoris\Contact\Imports\UserContactImport;
use Scoris\Contact\Exports\UserContactExport;
use Maatwebsite\Excel\Facades\Excel;
use Scoris\Contact\Models\UserContact;

class UserContactController extends BaseController
{
    protected $userContactRepository;

    public function __construct(UserContactInterface $userContactRepository)
    {
        $this->userContactRepository = $userContactRepository;
    }

    public function index()
    {
    }

    public function destroy($id){
        return $this->userContactRepository->delete($id);
    }

    public function store(Request $request)
    {
        return $this->userContactRepository->store($request);
    }

    public function add_user_contact()
    {
        return $this->userContactRepository->add_user_contact();
    }

    public function export_csv()
    {
        return Excel::download(new UserContactExport, 'users.csv');
    }

    public function import_csv(Request $request)
    {
        return $this->userContactRepository->import_csv($request);
    }
}
