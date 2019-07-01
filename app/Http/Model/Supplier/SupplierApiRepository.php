<?php

namespace App\Http\Model\Supplier;

use App\Http\Model\Supplier\SupplierModel;

class SupplierApiRepository
{
	private $model;
    
    public function __construct(SupplierModel $model){
    	$this->model=$model;
    }

    public function getAllSupplier(){
    	return $this->model->with(['company'])->orderBy('supplier_id')->get();
    }

    public function getSupplier($supplier_id){
    	return $this->model->with(['company'])->find($supplier_id);
    }

    public function createSupplier($array){
    	return $this->model->create($array);
    }

    public function editSupplier($supplier_id,$array){
    	$supplier=$this->model->find($supplier_id);
    	$supplier->fill($array);
    	return $supplier->save();
    }

    public function deleteSupplier($supplier_id){
    	$supplier=$this->model->find($supplier_id);
    	return $supplier->delete();
    }
}
