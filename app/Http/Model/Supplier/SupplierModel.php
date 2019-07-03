<?php

namespace App\Http\Model\Supplier;

use Watson\Rememberable\Rememberable;
use Illuminate\Database\Eloquent\Model;

class SupplierModel extends Model
{
    use Rememberable;
	protected $table = 'suppliers';
    protected $primaryKey = 'suppliers_id';
    protected $guarded = ['suppliers_id'];
    public $rememberCacheTag = 'supplier_queries';
    public $rememberFor = 10; // 10 minutes

    public function company()
    {
        return $this->hasOne('App\Http\Model\Company\CompanyModel','company_id','company_id');
    }

	public function verifySupplier()
    {
      return $this->hasOne('App\Http\Model\VerifySupplier\VerifySupplierModel', 'suppliers_id');
    }

    public function clearCache(){
        SupplierModel::flushCache();
    }
}
