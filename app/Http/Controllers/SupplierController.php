<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\Supplier\SupplierInterface;
use Auth;


class SupplierController extends Controller
{

    private $supplierRepo;
    private $user;

    public function __construct(SupplierInterface $supplierRepo)
    {
        $this->supplierRepo=$supplierRepo;
        $this->user = Auth::user();
    }

    public function createSupplier(Request $request){
        $validatedData = $request->validate([
        'suppliers_name' => 'string|required',
        'suppliers_email' => 'email|required',
        'suppliers_fee' => 'numeric|required'
        ]);    	
        $supplier=$this->supplierRepo->createSupplier($this->user->company_id,$request->except('_token'));
        return response()->json($supplier);
    }

    public function editSupplier($suppliers_id,Request $request){
        $validatedData = $request->validate([
        'suppliers_name' => 'string',
        'suppliers_email' => 'email',
        'suppliers_fee' => 'numeric'
        ]);    
        $supplier=$this->supplierRepo->editSupplier($this->user->company_id,$suppliers_id,$request->except('_token'));
        return response()->json($supplier);
    }

    public function deleteSupplier($suppliers_id){
    	$supplier=$this->supplierRepo->deleteSupplier($this->user->company_id,$suppliers_id);
        return response()->json($supplier);
    }
}
