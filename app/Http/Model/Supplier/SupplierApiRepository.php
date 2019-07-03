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

    public function getCompanyTotalCost($company_id){
        return $this->model->where('company_id',$company_id)->sum('suppliers_fee');
    }

    public function createSupplier($company_id,$array){
        $array['company_id']=$company_id;
    	$result = $this->model->create($array);
        $this->model->clearCache();
        return $result;
    }

    public function editSupplier($company_id,$suppliers_id,$array){
    	$supplier=$this->getSupplier($company_id,$suppliers_id);
        if(!is_null($supplier)){            
            $supplier->fill($array);
            $result = $supplier->save();
            $this->model->clearCache();
            return $result;
        }
        return false;
    }

    public function deleteSupplier($company_id,$suppliers_id){
    	$supplier=$this->getSupplier($company_id,$suppliers_id);
        if(!is_null($supplier)){            
            $result = $supplier->delete();
            $this->model->clearCache();
            return $result;
        }
        return false;
    }
}
