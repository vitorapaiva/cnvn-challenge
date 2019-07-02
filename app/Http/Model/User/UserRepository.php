<?php

namespace App\Http\Model\User;

use App\Http\Model\User\UserModel;
use App\Http\Model\User\UserInterface;

class UserRepository implements UserInterface
{
	private $model;
    
    public function __construct(UserModel $model){
    	$this->model=$model;
    }

    public function createUser($array){
    	return $this->model->create($array);
    }
}
