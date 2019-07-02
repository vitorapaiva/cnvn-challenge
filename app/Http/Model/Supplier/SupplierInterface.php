<?php

namespace App\Http\Model\Supplier;



interface SupplierInterface
{
	
	public function getAllSupplier($company_id);
	public function getSupplier($company_id,$suppliers_id);
	public function createSupplier($company_id,array $array_data);
	public function editSupplier($company_id,$suppliers_id,array $array_data);
	public function deleteSupplier($company_id,$suppliers_id);
}
