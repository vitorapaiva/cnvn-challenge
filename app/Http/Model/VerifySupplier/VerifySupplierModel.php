<?php

namespace App\Http\Model\VerifySupplier;

use Illuminate\Database\Eloquent\Model;

class VerifySupplierModel extends Model
{
	protected $table = 'verify_suppliers';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public function supplier()
    {
        return $this->belongsTo('App\Http\Model\Supplier\SupplierModel', 'suppliers_id');
    }
}
