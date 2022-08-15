<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\SendEmail;
use App\Models\Topic;
use App\Models\User;
use App\Models\Water;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{


    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(User::all(),200);
        //return response(Topic::with('lessons')->where('id','=','2')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $request->validate(
//            [
//                'name'=>['required'],
//                'surname'=>'required',
//                'email'=>['required',Rule::unique(\Orchid\Platform\Models\User::class, 'email')],
//                'password'=>'required'
//            ]
//        );

        $rules = [
            'email'=>'required|unique:users,email',
            'password'=>'required',
            'name'=>'required',
            'surname'=>'required',
            //'confirm'=>'required'
        ];
        $messages = [
            'required' => 'Поле :attribute обов\'язкове для заповнення.',
            'unique' => 'Користувач з таким :attribute уже є в базі.',
            'email' => 'Має бути дійсна email адреса.',
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $user = new User();
        if($validator->fails()){
            return response($validator->messages(),405);
        }else{
            $user->fill($request->all())->save();
            return response($user);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response(User::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//        $water = new Water();
//        $water->count = 100;
//        $water->user_id = 1;
//        $water->save();

        return response();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->file();
        $user->fill($request->all())->save();
        return response($user);
    }

    public function photo(Request $request, $id)
    {
        $request->validate([
            'photo' => [
                'required',
            ],
        ]);
        return response($request);
        $user = User::findOrFail($id);
        $photo = $request->file('photo');
        //return response($request);
        $user->photo = $photo->store(date('Y'.'/'.'m'.'/'.'d'),'public');
        //$user->fill($request->all())->save();
        $user->save();
        return response($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response(User::destroy($id));
    }


    public function test_email(){
        Mail::to('mykolamysiv@ucu.edu.ua')->send(new SendEmail('test1'));
    }

    public function get_user(){
        return response(User::find(1));
    }

    public function check(Request $request){
        $request->validate([
            'email'=>'required|unique:users,email'
        ]);
    }
}
