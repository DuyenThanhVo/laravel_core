<?php
namespace Scoris\Contact\Repositories\Eloquent;

use Scoris\Contact\Repositories\Interfaces\ContactCategoryInterface;
use Scoris\Support\Repositories\Eloquent\RepositoriesAbstract;
use Scoris\Contact\Models\ContactCategoryParent;
use Scoris\Contact\Models\ContactCategory;

class ContactCategoryRepository extends RepositoriesAbstract implements ContactCategoryInterface
{
    public function index()
    {
        $contact_category_parent = ContactCategoryParent::get();
        $tmp = [];
        foreach($contact_category_parent as $k => $v)
        {
            $tmp[] = ContactCategory::where('id', $v->child_id)->get();
        }

        return response()->json([
            'status' => true,
            'code' => 0,
            'data' => $contact_category_parent,
                    $tmp,
            'message' => "success"
        ]);
    }

    public function store($request)
    {
        $validator = \Validator::make($request->all(), [
            'name_vi' => 'required|min:6|max:100',
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
        $input['users_id'] = auth()->id();

        $name_en = isset($input['name_en']) ? $input['name_en'] : '';
        $description = isset($input['description']) ? $input['description'] : '';

        $find_raw = $input['name_vi'].' '.$name_en.' '.$description;
        $input['find_raw'] = strtolower($this->stripUnicode($find_raw));

        # return var_dump(explode(' ', $input['description']));
        $input['name_vi'] =  xss_cleaner($request->name_vi);

        $contact_category = ContactCategory::create($input);
        $contact_category_parent = [];
        $count = isset($request->parent_id) ? count($request->parent_id) : 0;

        if($count == 0)
        {
            $contact_category_parent['child_id'] = $contact_category->id;
            $contact_category_parent['parent_id'] = 0;
            ContactCategoryParent::create($contact_category_parent);
        }else{
            foreach($request->parent_id as $k => $v)
            {
                $contact_category_parent['child_id'] = $contact_category->id;
                $contact_category_parent['parent_id'] = $v;
                ContactCategoryParent::create($contact_category_parent);
            }
        }

        return response()->json([
            'status' => true,
            'code' => 0,
            'data' => $contact_category,
            'message' => "success"
        ], 200);
    }

    function stripUnicode($str)
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
        $contact_category_parent = ContactCategoryParent::where('parent_id', $id)->get();
        ContactCategoryParent::where('parent_id', $id)->delete();

        foreach($contact_category_parent as $k => $v)
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

