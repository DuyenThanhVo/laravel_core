<?php

namespace Scoris\Contact\Imports;

use Scoris\Contact\Models\UserContact;
use Maatwebsite\Excel\Concerns\ToModel;

class UserContactImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $row = request()->all();
        $array = request()->except('file', '_token');
        dd();
        // dd($this->get_index('contact_id'));

        return new UserContact([
            'login_id'     => auth()->id(),
            'contact_id'     => request()->get('contact_id'),
            'first_name'     => $row[0],
            'last_name'    => $row[1],
            'phone' => $row[2],
            'find_raw' => $row[3],
        ]);
    }

    public function get_same_data($array)
    {
        $tmp = request()->get($String) == -1 ? 0 : 1;
        return $tmp;
        // return (int) $String;
    }

    public function get_index($String)
    {
        $tmp = request()->get($String) == -1 ? 0 : 1;
        return $tmp;
        // return (int) $String;
    }
}
