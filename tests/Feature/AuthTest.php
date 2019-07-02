<?php

namespace Tests\Feature;

use App\Http\Model\User\UserModel;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     * Test registration
     */
    public function testRegister(){
        $data = [
            'company_email' => 'teste@gmail.com',
            'company_name' => 'Teste',
            'company_tax_id' => 123456789,
            'company_phone' => 123,
            'company_cep' => 123,
            'email' => 'teste@gmail.com',
            'name' => 'Teste',
            'password' => 'teste1234',
            'password_confirmation' => 'teste1234'
        ];

        //Send post request
        $response = $this->json('POST',route('api.register'),$data);
        //Assert it was successful
        $response->assertStatus(200);
        //Assert we received a token
        $this->assertArrayHasKey('token',$response->json());
    }

    /**
     * @test
     * Test login
     */
    public function testLogin()
    {
        
        $data = [
            'company_email' => 'teste@gmail.com',
            'company_name' => 'Teste',
            'company_tax_id' => 123456789,
            'company_phone' => 123,
            'company_cep' => 123,
            'email' => 'teste@gmail.com',
            'name' => 'Teste',
            'password' => 'teste1234',
            'password_confirmation' => 'teste1234'
        ];

        $this->json('POST',route('api.register'),$data);

        //attempt login
        $response = $this->json('POST',route('api.authenticate'),[
            'email' => 'teste@gmail.com',
            'password' => 'teste1234',
        ]);
        //Assert it was successful and a token was received
        $response->assertStatus(200);
        $this->assertArrayHasKey('token',$response->json());
    }


}