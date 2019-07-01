<?php

namespace App\Http\Model\Company;

use Illuminate\Database\Eloquent\Model;

class CompanyModel extends Model
{
    protected $table = 'company';
    protected $primaryKey = 'company_id';
    protected $guarded = ['company_id'];

    public function users()
    {
        return $this->belongsTo('App\Http\Model\User\UserModel','company_id','company_id');
    }
}
