<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Finance\ReceiptRepositoryInterface;
use App\Models\PatientAccount;
use Illuminate\Http\Request;

class ReceiptAccountController extends Controller
{



    protected $Receipt;

    public function __construct(ReceiptRepositoryInterface $Receipt)
    {
        $this->Receipt = $Receipt;
    }

    public function index()
    {

        // $Debit = PatientAccount::where('patient_id',1)->sum('Debit');
        // $credit = PatientAccount::where('patient_id',1)->sum('credit');
        // return $Debit - $credit;
       return $this->Receipt->index();
    }

    public function create()
    {
        return $this->Receipt->create();
    }


    public function store(Request $request)
    {
       return $this->Receipt->store($request);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        return $this->Receipt->edit($id);
    }


    public function update(Request $request)
    {
        return $this->Receipt->update($request);
    }


    public function destroy(Request $request)
    {
        return $this->Receipt->destroy($request);
    }
}