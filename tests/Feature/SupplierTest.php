<?php

namespace Tests\Feature;

use App\Http\Model\User\UserModel;
use App\Http\Model\Supplier\SupplierModel;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tymon\JWTAuth\Facades\JWTAuth;

class SupplierTest extends TestCase
{

    use RefreshDatabase;

    protected $user;

    /**
     * Create user and get token
     * @return string
     */
    protected function authenticate(){
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
        return $response->getData()->token;
    }

    public function testCreate()
    {
        //login
        $token = $this->authenticate();

        
        //create supplier
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('POST',route('supplier.createSupplier'),[
            'suppliers_name' => 'Convenia',
            'suppliers_email' => 'teste-supplier@email.com',
            'suppliers_fee' => 10.2,
        ]);

        $response->assertStatus(200);
    }

    public function testUpdate(){
        
        //login
        $token = $this->authenticate();
        
        //create supplier returning its data
        $supplier = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('POST',route('supplier.createSupplier'),[
            'suppliers_name' => 'Convenia',
            'suppliers_email' => 'teste-supplier@email.com',
            'suppliers_fee' => 10.2,
        ])->getData();
        //edit the supplier
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('PUT',route('supplier.editSupplier',['suppliers_id' => $supplier->suppliers_id]),[
            'suppliers_name' => 'Teste Novo Nome',
        ]);
        
        $response->assertStatus(200);
        
        $supplierUpdated=SupplierModel::find($supplier->suppliers_id);
       
        $this->assertEquals('Teste Novo Nome',$supplierUpdated->suppliers_name);
    }

    public function testDelete(){
        //login
        $token = $this->authenticate();
        
        //create supplier returning its data
        $supplier = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('POST',route('supplier.createSupplier'),[
            'suppliers_name' => 'Convenia',
            'suppliers_email' => 'teste-supplier@email.com',
            'suppliers_fee' => 10.2,
        ])->getData();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('DELETE',route('supplier.deleteSupplier',['suppliers_id' => $supplier->suppliers_id]));
        
        $response->assertStatus(200);
        
        $supplierDeleted=SupplierModel::find($supplier->suppliers_id);
        
        $this->assertEquals(null,$supplierDeleted);
    }
}