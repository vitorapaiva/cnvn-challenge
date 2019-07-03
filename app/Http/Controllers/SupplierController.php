<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\VerifySupplier\VerifySupplierInterface;
use App\Http\Model\Supplier\SupplierInterface;
use App\Http\Mail\VerifySupplierMail;
use Illuminate\Support\Facades\Mail;
use Auth;


class SupplierController extends Controller
{

    private $supplierRepo;
    private $user;
    private $verifyRepo;

    public function __construct(SupplierInterface $supplierRepo,
                                VerifySupplierInterface $verifyRepo)
    {
        $this->supplierRepo=$supplierRepo;
        $this->user = Auth::user();
        $this->verifyRepo = $verifyRepo;
    }

    public function createSupplier(Request $request){
        $validatedData = $request->validate([
        'suppliers_name' => 'string|required',
        'suppliers_email' => 'email|required',
        'suppliers_fee' => 'numeric|required'
        ]);    	

        $supplier=$this->supplierRepo->createSupplier($this->user->company_id,$request->except('_token'));

        $verifySupplier = $this->verifyRepo->createVerifySupplier([
        'suppliers_id' => $supplier->suppliers_id,
        'token' => sha1(time())
        ]);
        Mail::to($supplier->suppliers_email)->send(new VerifySupplierMail($supplier));
        return response()->json($supplier);
    }

    public function editSupplier($suppliers_id,Request $request){
        $validatedData = $request->validate([
        'suppliers_name' => 'string',
        'suppliers_email' => 'email',
        'suppliers_fee' => 'numeric'
        ]);    
        $supplier=$this->supplierRepo->editSupplier($this->user->company_id,$suppliers_id,$request->except('_token'));
        return response()->json($supplier);
    }

    public function deleteSupplier($suppliers_id){
    	$supplier=$this->supplierRepo->deleteSupplier($this->user->company_id,$suppliers_id);
        return response()->json($supplier);
    }

    public function verifySuppliers($token){
        $verifySupplier = $this->verifyRepo->getVerifySupplier($token);
        if(isset($verifySupplier)){
            $supplier = $verifySupplier->supplier;
            if(!$supplier->activated) {
              $supplier->activated = 1;
              $supplier->save();
              $status = "Email verificado. Agradecemos sua atenção.";
            } else {
              $status = "Email já verificado. Agradecemos sua atenção.";
            }
        } else {
            $status = "Pedimos desculpa pelo inconveniente mas não foi possível identificar seu email.";
        }
        return view('emails.supplierVerified',compact('status'));
    }
}
