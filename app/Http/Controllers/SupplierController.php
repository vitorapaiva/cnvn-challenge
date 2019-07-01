<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\Supplier\SupplierRepository;
use App\Http\Model\Company\CompanyRepository;


class SupplierController extends Controller
{

    private $supplierRepo;
    private $companyRepo;

    public function __construct(SupplierRepository $supplierRepo,
                                CompanyRepository $companyRepo)
    {
        $this->supplierRepo=$supplierRepo;
        $this->companyRepo=$companyRepo;
    }

    public function add(){
    	$company_list=$this->companyRepo->getBrandList();
    }

    public function addStore(Request $request){
        $validatedData = $request->validate([
        'supplier_name' => 'required|max:255',
        'company_id' => 'required'
        ]);    	
        $supplier=$this->supplierRepo->createSupplier($request->except('_token'));
    }

    public function edit($supplier_id){
        $supplier=$this->supplierRepo->getSupplier($supplier_id);
    	$company_list=$this->companyRepo->getBrandList();
    }

    public function editStore($supplier_id,Request $request){
        $this->supplierRepo->editSupplier($supplier_id,$request->except('_token'));
    }

    public function delete($supplier_id){
    	$this->supplierRepo->deleteSupplier($supplier_id);
    }
}
