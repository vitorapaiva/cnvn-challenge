<?php

namespace App\Http\Model\Supplier;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class SupplierModel extends Model
{
	use Filterable;
    protected $table = 'supplier';
    protected $primaryKey = 'supplier_id';
    protected $guarded = ['supplier_id'];

    public function company()
    {
        return $this->hasOne('App\Http\Model\Company\CompanyModel','company_id','company_id');
    }
}
