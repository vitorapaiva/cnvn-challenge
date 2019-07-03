<?php

namespace App\Http\Model\Company;

use Watson\Rememberable\Rememberable;
use Illuminate\Database\Eloquent\Model;

class CompanyModel extends Model
{
	use Rememberable;
    protected $table = 'company';
    protected $primaryKey = 'company_id';
    protected $guarded = ['company_id'];
    public $rememberCacheTag = 'company_queries';
    public $rememberFor = 10; // 10 minutes

    public function users()
    {
        return $this->belongsTo('App\Http\Model\User\UserModel','company_id','company_id');
    }

    public function clearCache(){
    	CompanyModel::flushCache();
    }
}
