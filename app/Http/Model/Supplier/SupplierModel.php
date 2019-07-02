<?php

namespace App\Http\Model\Supplier;

use Illuminate\Database\Eloquent\Model;

class SupplierModel extends Model
{
	protected $table = 'suppliers';
    protected $primaryKey = 'suppliers_id';
    protected $guarded = ['suppliers_id'];

    public function company()
    {
        return $this->hasOne('App\Http\Model\Company\CompanyModel','company_id','company_id');
    }

	public function verifySupplier()
    {
      return $this->hasOne('App\Http\Model\VerifySupplier\VerifySupplierModel', 'suppliers_id');
    }
}
