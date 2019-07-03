<?php

namespace App\Http\Model\VerifySupplier;

use Watson\Rememberable\Rememberable;
use Illuminate\Database\Eloquent\Model;

class VerifySupplierModel extends Model
{
	use Rememberable;
	protected $table = 'verify_suppliers';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public $rememberCacheTag = 'verifysuppliers_queries';
    public $rememberFor = 10; // 10 minutes

    public function supplier()
    {
        return $this->belongsTo('App\Http\Model\Supplier\SupplierModel', 'suppliers_id');
    }

    public function clearCache(){
        VerifySupplierModel::flushCache();
    }
}
