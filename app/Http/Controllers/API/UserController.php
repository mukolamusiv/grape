<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AwardRequest;
use App\Http\Requests\UserPasswordRequest;
use App\Mail\SendEmail;
use App\Models\Awards;
use App\Models\AwardUser;
use App\Models\OpenQuestionAnswerUser;
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
        $data = collect(User::find($id));
        $data->put('awards',$this->AwardUser($id));
        return response($data);
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
        $request->validate([
//            'photo' => [
//                'required',
//            ],
            'name'=>'required',
            'surname'=>'required',
            'birthday'=>'min:5'
        ]);
        $user = User::findOrFail($id);
        $request->file();
        $user->fill($request->all())->save();
//        if($request->file('photo')){
//            $this->photo_update($request,$user)->save();
//        }
        return response($user);
    }

    public function photo(Request $request, $id)
    {
        $request->validate([
            'photo' => [
                'required',
            ],
        ]);
        //return response($request);
        $user = User::findOrFail($id);
        $photo = $request->file('photo');
        //return response($request);
        $user->photo = $photo->store(date('Y'.'/'.'m'.'/'.'d'),'public');
        //$user->fill($request->all())->save();
        $user->save();
        return response($user);
    }

    private function photo_update(Request $request, User $user){
        $photo = $request->file('photo');
        $user->photo = $photo->store(date('Y'.'/'.'m'.'/'.'d'),'public');
        return $user;
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
        $data = collect(User::find(Auth::id()));
        $data->put('awards',$this->AwardUser(Auth::id()));
        return response($data);
    }

    public function check(Request $request){
        $request->validate([
            'email'=>'required|unique:users,email'
        ]);
    }

    /**
     * @param UserPasswordRequest $request
     * @param $user_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update_password(UserPasswordRequest $request, $user_id){
        $user = User::find(Auth::id());
        if(Hash::check($request->input('old_password'), $user->password)){
            $user->password = $request->input('password');
            if($user->save()){
                return response('Пароль змінено',200);
            }else{
                return response('Щось пішло не так',204);
            }
        }else{
            return response('Пароль не вірний',422);
        }
    }


    public function getUserClassroom($user_id){
        return response(User::where(['katehyt_id'=>$user_id])->get());
    }

    public function Awards($user_id){
        return response($this->AwardUser($user_id));
    }

    private function AwardUser($user_id){
        $all = Awards::all();
        $data = AwardUser::with('Awards')->where(['user_id'=>$user_id])->get();
        $return = collect();
        foreach ($all as $award){
            $demo = collect($award);
            $demo->put('completed',false);
            foreach ($data as $datum){
                if($datum->award_id == $award->id){
                    $demo->put('completed',true);
                }
            }
            $return->push($demo);
        }
        return $return;
    }


    public function NonAuditOpenQuestions($user_id){
        return response(OpenQuestionAnswerUser::with('OpenQuestion','User')->where(['user_id'=>$user_id,'audit'=>false])->get());
    }

    public function AuditOpenQuestions($user_id){
        return response(OpenQuestionAnswerUser::with('OpenQuestion','User')->where(['user_id'=>$user_id,'audit'=>true])->get());
    }


    public function NonOpenQuestions(){
        return response(OpenQuestionAnswerUser::with('OpenQuestion','User')->where(['audit_user_id'=>1,'audit'=>false])->get());
    }

    public function OpenQuestions(){
        return response(OpenQuestionAnswerUser::with('OpenQuestion','User')->where(['audit_user_id'=>1,'audit'=>true])->get());
    }

    public function AwardsAll($user_id){
        $data = AwardUser::with('Awards')->where(['user_id'=>$user_id])->get()->toArray();
        $user_award = array();
        foreach ($data as $datum){
            $user_award[] = $datum['awards'][0]['id'];
        }
        $awards = Awards::whereNotIn('id',$user_award)->get();
        return response($awards);
    }

    public function addAwards(AwardRequest $request, $user_id){
        $award_id = $request->input('award_id');
        if(AwardUser::where(['user_id'=>$user_id,'award_id'=>$award_id])->get()->isEmpty() ){
            if(is_null(Awards::find($award_id))){
                return response(['error'=>'Такої нагороди не існує']);
            }else {
            $award = new AwardUser();
            $award->award_id = $request->input('award_id');
            $award->user_id = $user_id;
            $award->save();
            }
            return response('success');
        }else{
            return response(['error'=>'Уже нагорода додана']);
        }
    }
}
