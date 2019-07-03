<?php

namespace App\Http\Model\VerifySupplier;



interface VerifySupplierInterface
{
	
	public function createVerifySupplier(array $array_data);
	public function getVerifySupplier($token);
}
