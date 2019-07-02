<?php

namespace App\Http\Model\Supplier;

use App\Http\Model\Supplier\SupplierModel;

class SupplierApiRepository implements SupplierInterface
{
	private $model;
    
    public function __construct(SupplierModel $model){
    	$this->model=$model;
    }

    public function getAllSupplier($company_id){
    	return $this->model->where('company_id',$company_id)->orderBy('suppliers_id')->get();
    }

    public function getSupplier($company_id,$suppliers_id){
    	return $this->model->where('company_id',$company_id)->where('suppliers_id',$suppliers_id)->first();
    }

    public function createSupplier($company_id,$array){
        $array['company_id']=$company_id;
    	return $this->model->create($array);
    }

    public function editSupplier($company_id,$suppliers_id,$array){
    	$supplier=$this->getSupplier($company_id,$suppliers_id);
    	$supplier->fill($array);
    	return $supplier->save();
    }

    public function deleteSupplier($company_id,$suppliers_id){
    	$supplier=$this->getSupplier($company_id,$suppliers_id);
    	return $supplier->delete();
    }
}
