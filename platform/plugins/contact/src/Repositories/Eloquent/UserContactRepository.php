<?php
namespace Scoris\Contact\Repositories\Eloquent;

use Scoris\Contact\Models\UserContact;
use Scoris\Contact\Repositories\Interfaces\UserContactInterface;
use Scoris\Support\Repositories\Eloquent\RepositoriesAbstract;

use Scoris\Contact\Imports\UserContactImport;
use Scoris\Contact\Exports\UserContactExport;
use Maatwebsite\Excel\Facades\Excel;

class UserContactRepository extends RepositoriesAbstract implements UserContactInterface
{
    public function delete($id){
        UserContact::where('id', $id)->update(['status' => 0]);

        return response()->json([
            'status' => true,
            'code' => 0,
            'data' => [],
            'message' => "success"
        ], 200);
    }

    public function store($request)
    {
        $input = $request->except('token', 'first_name', 'last_name', 'phone');

        $input['user_id'] = auth()->id();

        $tmp = 0;
        for($i= 0; $i< count($request->first_name); $i++ )
        {
            $input['first_name'] = $request->first_name[$i] =='' ? "null" : $request->first_name[$i];
            $input['last_name'] = $request->last_name[$i] =='' ? "null" : $request->last_name[$i];
            $input['phone'] = $request->phone[$i] =='' ? "null" : $request->phone[$i];
            if($input['first_name'] != "null" && $input['last_name'] != "null" && $input['phone'] != "null")
            {
                $find_raw = $input['first_name'].' '.$input['last_name'].' '.$input['phone'];
                $input['find_raw'] = strtolower($this->stripUnicode($find_raw));
                $tmp = $tmp + 1;
                UserContact::create($input);
            }
        }

        return response()->json([
            'status' => true,
            'code' => 0,
            'data' => [
                "success" => $tmp,
                "total" => count($request->first_name)
            ],
            'message' => "success"
        ], 200);
    }

    public function stripUnicode($str)
    {
        if(!$str) return false;
        $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'd'=>'đ|Đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );
        foreach($unicode as $nonUnicode=>$uni) $str = preg_replace("/($uni)/i",$nonUnicode,$str);
        return $str;
    }

    public function export_csv()
    {

    }

    public function import_csv( $request )
    {
        if(empty($request->file))
        // if(empty($request->file) || auth()->id() == "")
        {
            return response()->json([
                'status' => false,
                'code' => 300,
                'data' => [],
                'message' => 'error'
            ]);
        }

        Excel::import(new UserContactImport, request()->file('file'));

        return back();
    }
}

