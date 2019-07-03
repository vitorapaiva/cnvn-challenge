<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\Supplier\SupplierInterface;
use Auth;


class CompanyController extends Controller
{

    private $supplierRepo;
    private $user;
    private $verifyRepo;

    public function __construct(SupplierInterface $supplierRepo)
    {
        $this->supplierRepo=$supplierRepo;
        $this->user = Auth::user();
    }

    public function returnCompanyTotalCost(){
        
        $total_cost=$this->supplierRepo->getCompanyTotalCost($this->user->company_id);

        return response()->json(["total_cost"=>$total_cost]);
    }
}
