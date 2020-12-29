<?php

namespace Scoris\Contact\Exports;

use Scoris\Contact\Models\UserContact;
use Maatwebsite\Excel\Concerns\FromCollection;

class UserContactExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return UserContact::all();
    }
}
