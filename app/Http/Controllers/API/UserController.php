<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use App\Models\User;
use App\Models\Water;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
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
//return response($request->all());
        //return response('ривіт',200);
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
        return response(Water::all());
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
        //
        return response(Water::all(['user_id','count']));
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
}
