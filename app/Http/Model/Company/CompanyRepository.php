<?php

namespace App\Http\Model\Company;

use App\Http\Model\Company\CompanyModel;
use App\Http\Model\Company\CompanyInterface;

class CompanyRepository implements CompanyInterface
{
	private $model;
    
    public function __construct(CompanyModel $model){
    	$this->model=$model;
    }

    public function createCompany($array){
    	return $this->model->create($array);
    }
}
