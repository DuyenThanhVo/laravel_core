<?php
namespace Scoris\Contact\Repositories\Eloquent;

use Scoris\Contact\Repositories\Interfaces\ContactInterface;
use Scoris\Support\Repositories\Eloquent\RepositoriesAbstract;
use Scoris\Contact\Models\ContactParent;
use Scoris\Contact\Models\Contact;

class ContactRepository extends RepositoriesAbstract implements ContactInterface
{
    public function list_user_contact($id)
    {
        $list_user_contact = Contact::where('id',$id)->with('user_contact')->get();
        return response()->json([
            'status' => true,
            'code' => 0,
            'data' => $list_user_contact,
            'message' => "success"
        ]);
    }

    public function index()
    {
        $contact_parent = ContactParent::get();
        $tmp = [];
        foreach($contact_parent as $k => $v)
        {
            $tmp[] = Contact::where('id', $v->child_id)->get();
        }

        return response()->json([
            'status' => true,
            'code' => 0,
            'data' => $contact_parent,
                        $tmp,
            'message' => "success"
        ]);
    }

    public function store($request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'code' => 707,
                'data' => [],
                'message' => $validator->errors()
            ]);
        }

        $input = $request->except('token', 'parent_id');
        $input['user_id'] = auth()->id();

        $description = isset($input['description']) ? $input['description'] : '';

        $find_raw = $input['name'].' '.$description;
        $input['find_raw'] = strtolower($this->stripUnicode($find_raw));

        $input['name'] = xss_cleaner($request->name);

        $contact = Contact::create($input);

        $contact_parent = [];
        $count = isset($request->parent_id) ? $request->parent_id : 0;

        $contact_parent['parent_id'] = $count;
        $contact_parent['child_id'] = $contact->id;
        ContactParent::create($contact_parent);

        return response()->json([
            'status' => true,
            'code' => 0,
            'data' => $contact,
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

    public function delete($id)
    {
        $contact_parent = ContactParent::where('parent_id', $id)->get();
        ContactParent::where('parent_id', $id)->delete();

        foreach($contact_parent as $k => $v)
        {
            $this->delete($v->child_id);
        }

        return response()->json([
            'status' => true,
            'code' => 0,
            'data' => [],
            'message' => "success"
        ], 200);
    }
}

