<?php

namespace App\Http\Model\VerifySupplier;

use App\Http\Model\VerifySupplier\VerifySupplierModel;

class VerifySupplierApiRepository implements VerifySupplierInterface
{
	private $model;
    
    public function __construct(VerifySupplierModel $model){
    	$this->model=$model;
    }

    public function createVerifySupplier($array){
        return $this->model->create($array);
    }

    public function getVerifySupplier($token){
        return $this->model->where('token',$token)->first();
    }
}
