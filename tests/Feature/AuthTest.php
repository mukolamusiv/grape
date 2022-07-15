<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Water;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_status_200()
    {
        $response = $this->get('/api/user');
        $response->assertStatus(200);
        //$response;
    }

//    public function test_CRUD(){
//        $i = 1;
//    }

    public function test_get_user(){
        $response = $this->getJson('/api/user/1');
//        $response
//            ->assertJson(fn (AssertableJson $json) =>
//            $json->where('id', 1)
//                //->where('name', 'Victoria Faith')
//                ->missing('password')
//                ->etc()
//            );
        $response->assertStatus(401);
    }


    public function test_register_update_destroy_user(){
        $body = [
            'email' => 'mukolamusiv@gmail.com',
            'password' => 'mukola39911993'
        ];
        $response = $this->json('POST','/login',$body,['Accept' => 'application/json'])
            ->assertStatus(204);
//        $response = $this->postJson('api/register',
//            [
//                'id'=>100,
//                'name'=>'Тестове імя',
//                'surname'=>'тестове прізвище',
//                'email'=>'email@emaidl.com',
//                'password'=>'password',
//            ]);
//        $response->assertStatus(200);
        //$this->deleteJson('api/user/'.$response->viewData('id'))->assertStatus(200);
        $body = [
            'name'=>'Тестове ім\'я',
            'surname'=>'Прізвище',
            'email'=>'tesdt@test.com',
            'password'=>'password',
        ];
        $response = $this->postJson('api/register',$body)->assertStatus(200);
        $id = $response->json('id');

        $body = [
            'name'=>'Тестове ім\'я',
            'surname'=>'Прізdвище',
            'email'=>'tessssdst@test.com',
            'password'=>'password',
        ];
        $this->putJson('api/user/'.$id,$body)->assertStatus(200);

        $this->deleteJson('api/user/'.$id,$body)->assertStatus(200);
    }

    public function test_auth_user(){
        $body = [
            'email' => 'mukolamusiv@gmail.com',
            'password' => 'mukola39911993'
        ];
        $response = $this->json('POST','/login',$body,['Accept' => 'application/json'])
            ->assertStatus(204);
            //->assertJsonStructure(['token']);
        //$this->token = $response['token'];

        $response = $this->getJson('/api/user/1');
        $response->assertStatus(200);
    }

    public function test_max_user(){
        for ($i = 1; $i < 35; $i++){

            $d = $i+15;

            $water = new User();
            $water->name = 'Користувач '.$i;
            $water->surname = 'Прізвище '.$i;
            $water->email = $i.'tessssdst@test.com';
            $water->password = 'password';
            $water->water = $d;
            $water->save();
            //User::destroy($i);

        }
//        $body = [
//            'name'=>'Тестове ім\'я',
//            'surname'=>'Прізdвище',
//            'email'=>'tessssdst@test.com',
//            'password'=>'password',
//        ];
//        $this->putJson('api/user/1',$body)->assertStatus(200);
//        sleep(2);
    }
}
