<?php

namespace Tests\Feature;

use App\Http\Model\Company\CompanyModel;
use App\Http\Model\Supplier\SupplierModel;
use App\User;
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
        $user = User::create([
            'email' => 'teste@gmail.com',
            'name' => 'Teste',
            'password' => bcrypt('teste1234'),
        ]);
        $this->user = $user;
        $token = JWTAuth::fromUser($user);
        return $token;
    }

    public function testCreate()
    {
        //create company
        $company=CompanyModel::create([
            'company_name' => 'Farmaceuticos São Paulo'
        ]);
        
        //get Bearer token
        $token = $this->authenticate();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('POST',route('add'),[
            'supplier_name' => 'Seringa Tipo Pistola',
        ]);
        //if 302 means that the page redirects successfully to the edit page
        $response->assertStatus(302);
    }

    public function testUpdate(){
        //create company
        $company=CompanyModel::create([
            'company_name' => 'Farmaceuticos Manaus'
        ]);
        //create supplier
        $supplier = SupplierModel::create([
            'supplier_name' => 'Antiinflamatorio Nimesulida',
            'company_id' => $company->company_id
        ]);
        //get Bearer token
        $token = $this->authenticate();
        //call route and assert response
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('POST',route('edit',['supplier_id' => $supplier->supplier_id]),[
            'supplier_name' => 'Antiinflamatorio Ibupofreno',
        ]);
        //if 302 means that the page redirects successfully to the edit page
        $response->assertStatus(302);

        //get supplier
        $supplierUpdated=SupplierModel::find($supplier->supplier_id);
        //Assert title is the new title
        $this->assertEquals('Antiinflamatorio Ibupofreno',$supplierUpdated->supplier_name);
    }

    public function testDelete(){
        //create company
        $company=CompanyModel::create([
            'company_name' => 'Farmaceuticos Manaus'
        ]);
        //create supplier
        $supplier = SupplierModel::create([
            'supplier_name' => 'Antiinflamatorio Nimesulida',
            'company_id' => $company->company_id
        ]);
        $token = $this->authenticate();
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('POST',route('delete',['supplier_id' => $supplier->supplier_id]));
        //if 302 means that the page redirects successfully to the home
        $response->assertStatus(302);
        //get supplier
        $supplierDeleted=SupplierModel::find($supplier->supplier_id);
        //Assert there are no recipes
        $this->assertEquals(null,$supplierDeleted);
    }
}