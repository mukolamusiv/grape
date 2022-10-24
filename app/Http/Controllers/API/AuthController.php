<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\PasswordForgetRequest;
use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\UserRequest;
use App\Mail\SendEmail;
use Carbon\Carbon;
use Faker\Extension\Helper;
use Faker\Provider\Text;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Egulias\EmailValidator\EmailValidator;
use phpseclib3\Crypt\Random;
use function PHPUnit\Framework\isEmpty;

class AuthController extends Controller
{


    public function __construct()
    {
        //$this->middleware('auth');
    }





    public function passportLogin(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $data = [
                    'email' => $request->email,
                    'password' => $request->password
                ];
                if(Auth::attempt($data)){
                    //$request->session()->regenerate();
                    //shell_exec('php ../artisan passport:install');

                    $token = Auth::user()->createToken(config('app.name'));
                    //$token = Auth::user()->createToken('api_token')->accessToken;

                    $token->token->expires_at = $request->remember_me ?
                        Carbon::now()->addMonth() :
                        Carbon::now()->addDay();

                    $token->token->save();

                    //$token = \auth()->user()->createToken('Laravel Password Grant Client')->accessToken;
                    //session()->put('token', $token);

                    $response = ['token_type' => 'Bearer',
                        'token' => $token->accessToken,
                        'expires_at' => Carbon::parse($token->token->expires_at)->toDateTimeString(),
                        'user'=>Auth::user()
                    ];
                    return response($response, 200);
                }else{
                    return response(["message" => "error"],422);
                }
            } else {
                $response = ["message" => "Password mismatch"];
                return response($response, 422);
            }
        } else {
            $response = ["message" =>'User does not exist'];
            return response($response, 422);
        }
    }


    public function passportlogout (Request $request) {
        $token = $request->user()->token();

        //dd($token);
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }

    /**
     * Create User
     * @param Request $request
     * @return User
     */
    public function register(UserRequest $request)
    {
//        // Validate request data
//        $validator = Validator::make($request->all(), [
//            'name' => 'required|string|max:255',
//            'surname' => 'required|string|max:255',
//            'email' => 'required|email|unique:users|max:255',
//            'password' => 'required|min:10',
//            'birthday'=> 'max:50',
//        ]);
//        // Return errors if validation error occur.
//        if ($validator->fails()) {
//            $errors = $validator->errors();
//            return response()->json([
//                'error' => $errors
//            ], 400);
//        }
        // Check if validation pass then create user and auth token. Return the auth token
//        if ($request->passes()) {
            $user = User::create([
                'name'     => $request->name,
                'surname'  => $request->surname,
                'email'    => $request->email,
                'password' => $request->password,
                'birthday' => $request->birthday
            ]);
        if(Auth::attempt($user)){
            //$request->session()->regenerate();
            //shell_exec('php ../artisan passport:install');

            $token = Auth::user()->createToken(config('app.name'));
            //$token = Auth::user()->createToken('api_token')->accessToken;

            $token->token->expires_at = $request->remember_me ?
                Carbon::now()->addMonth() :
                Carbon::now()->addDay();

            $token->token->save();

            //$token = \auth()->user()->createToken('Laravel Password Grant Client')->accessToken;
            //session()->put('token', $token);

            $response = ['token_type' => 'Bearer',
                'token' => $token->accessToken,
                'expires_at' => Carbon::parse($token->token->expires_at)->toDateTimeString(),
                'user'=>Auth::user()
            ];
            return response($response, 200);
//        }
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginUserRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            //return response($request);
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }
        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('access_token')->plainTextToken;
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user'=>$user
        ]);
    }



    /**
     * Login The User
     * @param Request $request
     * @return User
     */
    public function loginUser(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required'
                ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->input('email'))->first();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken,
                //'test'=> $user->currentAccessToken()
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request){
        Auth::logout();
        return response()->json([
            'status'=>'Ви вийшли з системи'
        ]);
        //return response($request->user()->currentAccessToken());
        //return response(\auth()->user());
//        if($request->user()->currentAccessToken()->delete()){
//            return response([
//                'status' => true,
//                'message' => 'User Logout In Successfully',
//            ]);
//        }else{
//            return response('Помилка');
//        }
    }












    public function forget_password(PasswordForgetRequest $request){
        $request->validate(['email' => 'required|email']);

        $user = User::where(['email'=>$request->input('email')])->get();

        $pass = '';
        if($user->isNotEmpty()){
            $user = $user->first();
            $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
            for ($i = 0; $i < 8; $i++) {
                $n = rand(0,59);
                $pass .= $alphabet[$n];
            }
            $user->password = $pass;
            $user->save();
            Mail::to($request->input('email'))->send(new SendEmail($user,$pass));
            $status = 'Новий пароль згенеровано та надіслано на пошту';
        }else{
            $status = ['error'=> 'Email is not isset'];
        }
//        $status = \Illuminate\Support\Facades\Password::sendResetLink(
//            $request->only('email')
//        );

//        $status === Password::RESET_LINK_SENT
//            ? back()->with(['status' => __($status)])
//            : back()->withErrors(['email' => __($status)]);



        return response($status);
    }


    public function reset_password(PasswordResetRequest $request){
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
        return response($status);
    }
}
