<?php
namespace Scoris\Auth\Repositories\Eloquent;

use Scoris\Auth\Repositories\Interfaces\AuthInterface;
use Scoris\Support\Repositories\Eloquent\RepositoriesAbstract;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Scoris\Auth\Models\User;
use Illuminate\Database\Eloquent\Model;

use Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class AuthRepository extends RepositoriesAbstract implements AuthInterface {


    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

    public function login($request)
    {
        $input = request(['email', 'password']);
        $input['email'] =  xss_cleaner($request->email);
        if (!$token = JWTAuth::attempt($input)) {
            return response()->json([
                'status' => false,
                'code' => 300,
                'data' => [],
                'message' => 'error'
            ]);
        }

        // return $this->user->updateToken(auth()->user()->id, $token);
        if(auth()->user()->status != 1)
        {
            return response()->json([
                'status' => false,
                'code' => 100,
                'data' => [],
                'message' => 'error'
            ]);
        }

        $last_login = Carbon::now();
        $user = User::where(['email' => $request->email])->update(["last_login" => $last_login]);

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'status' => true,
            'code' => 0,
            'data' => [
                [
                    'user' => auth()->user(),
                    'access_token' => $token,
                ]
            ],
            'message' => 'success'
        ]);
    }

    public function logout($request)
    {
        auth()->logout();

        return response()->json([
            'status' => true,
            'code' => 0,
            'data' => [],
            'message' => 'success'
        ]);
    }

    public function store($request)
    {
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'fullname' => 'required|min:6|max:255',
            'password' => 'required|min:6|max:255|confirmed',
            'password_confirmation' => 'required|min:6|max:255|same:password'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'code' => 707,
                'data' => [],
                'message' => $validator->errors()
            ]);
        }

        $input = $request->except('password_confirmation');
        $input['password'] = bcrypt($input['password']);

        $input['email'] =  xss_cleaner($request->email);
        $input['fullname'] =  xss_cleaner($request->fullname);

        $to_name = $input['fullname'];
        $to_email = $input['email']; // send to this email
        $input['token'] = Str::random(10);
        $url = url()->previous();
        $link = $url.'/api/set_active_user?email='.$request->email.'&token='.$input['token'];


        $data = array("link" => $link);

        $user = User::create($input);

        Mail::send('plugins/auth::mail.confirm_email', $data, function($message) use ($to_name, $to_email){
            $message->to($to_email)->subject('Click vào link để kích hoạt tài khoản.');
            $message->from($to_email, $to_name);
        });

        return response()->json([
            'status' => true,
            'code' => 0,
            'data' => $user,
            'message' => 'success'
        ], 200);
    }

    public function set_active_user ( $request )
    {
        $email  =  $_GET['email'];
        $token  =  $_GET['token'];

        $user = User::where(['email' => $email, 'token' => $token])->get();

        if( count($user) == 1)
        {
            User::where(['email' => $email, 'token' => $token])->update(['status' => 1]);
            return response()->json([
                'status' => true,
                'code' => 0,
                'data' => $user,
                'message' => 'success'
            ]);
        }
        else
        {
            return response()->json([
                'status' => false,
                'code' => 300,
                'data' => [],
                'message' => 'error'
            ]);
        }
    }

    public function update($id, $request)
    {
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email,'.param('user'),
            'username' => 'required|max:255|unique:users,username,'.param('user'),
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'code' => 707,
                'data' => [],
                'message' => $validator->errors()
            ]);
        }

        $user = User::findOrFail($id);

        $input = $request->except(['token']);


        $input['email'] =  xss_cleaner($request->email);
        $input['username'] =  xss_cleaner($request->username);

        $user->update($input);

        return response()->json([
            'status' => true,
            'code' => 0,
            'data' => $user,
            'message' => 'success'
        ], 200);
    }

    public function update_password($id, $request)
    {
        $validator = \Validator::make($request->all(), [
            'new_password' => 'required|min:6|max:255',
            'new_confirm_password' => 'required|min:6|max:255|same:new_password',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'code' => 707,
                'data' => [],
                'message' => $validator->errors()
            ]);
        }

        $user = User::findOrFail($id);
        if (\Hash::check($request->password, $user->password))
        {
            $new_password = $request->new_password;
            $input = $request->except(['token', 'new_password', 'new_confirm_password']);
            $input['password'] = bcrypt($new_password);

            $user->update($input);
            return response()->json([
                'status' => true,
                'code' => 0,
                'data' => $user,
                'message' => 'success'
            ], 200);
        }
        else{
            return response()->json([
                'status' => false,
                'code'  => 601,
                'data'  => [],
                'message' => 'error'
            ], 404);
        }
    }

    public function sendmail_resetpw($request)//gui email xac nhan dat lai mat khau
    {
        $user = User::where('email', $request->email)->get();

        if(count($user) != 1){
            return response()->json([
                'status' => false,
                'code' => 101,
                'data' => [],
                'message' => 'error'
            ]);
        }

        $title = 'Lấy lại password';
        $to_email = $request->email; // send to this email
        $token_random = Str::random(10);
        $url = url()->previous();
        $link = $url.'api/form_reset_password?email='.$request->email.'&token='.$token_random;

        $data = array("name" => $title, "link" => $link);

        User::where('email', $request->email)->update(['token' => $token_random]);

        Mail::send('plugins/auth::mail.forgot_pass', $data, function($message) use ($title, $to_email){
            $message->to($to_email)->subject('Đặt lại password');
            $message->from($to_email, $title);
        });
        return response()->json([
            'status' => true,
            'code' => 0,
            'data' => [],
            'message' => 'success'
        ]);
    }

    public function form_reset_password ()//xac nhan dung email va token dc quyen dat lai mat khau khong
    {
        $email  =  $_GET['email'];
        $token  =  $_GET['token'];

        $user = User::where(['email' => $email, 'token' => $token])->get();

        if( count($user) == 1)
        {
            return response()->json([
                'status' => true,
                'code' => 0,
                'data' => $email,
                'message' => 'success'
            ]);
        }
        else
        {
            return response()->json([
                'status' => false,
                'code' => 300,
                'data' => [],
                'message' => 'error'
            ]);
        }
    }

    public function reset_password ($request)
    {
        $validator = \Validator::make($request->all(), [
            'new_password' => 'required|min:6|max:255',
            'new_confirm_password' => 'required|min:6|max:255|same:new_password',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'code' => 707,
                'data' => [],
                'message' => $validator->errors()
            ]);
        }

        $new_password = $request->new_password;
        $input['password'] = bcrypt($new_password);
        $token_random = Str::random(10);
        $input['token'] = $token_random;

        User::where('email', $request->email)->update($input);
        $user = User::where('email', $request->email)->get();

        return response()->json([
            'status' => true,
            'code' => 0,
            'data' => $user,
            'message' => 'success'
        ], 200);
    }
}

