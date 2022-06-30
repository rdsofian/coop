<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Loan;
use App\LoanPayment;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return view("customer.index", compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("customer.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer = new Customer();
        $customer->identity_number = $request->identity_number;
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->birth_place = $request->birth_place;
        $customer->birth_date = $request->birth_date;
        $customer->user_id = 1;
        $customer->save();
        return redirect()->route('customer.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view('customer.list', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer, Request $request)
    {
        $customer->delete();
        $request->session()->flash('success', "Data Berhasil Dihapus");
        return response()->json('success');
    }

    public function loan($id) {
        $customer = Customer::find($id);
        return view("customer.loan", compact('customer'));
    }

    public function storeLoan(Request $request) {
        $loan = new Loan();
        $loan->loan_date = date('Y-m-d');
        $loan->customer_id = $request->customer_id;
        $loan->amount = $request->amount;
        $loan->remaining = $request->amount;
        $loan->finish_date = $request->finish_date;
        $loan->status = 1;
        $loan->user_id = 1;
        $loan->save();
        return redirect()->route('customer.show', $loan->customer_id);
    }

    public function paymentForm($id) {
        $customer = Customer::find($id);
        return view("customer.payment", compact('customer'));
    }

    public function payment(Request $request) {
        $loans = Loan::where('customer_id', $request->customer_id)->where('remaining', '>', 0)->get();
        $customer = Customer::find($request->customer_id);
        $amount = $request->payment;
        if($customer->remainingLoan() >= $request->payment) {

            foreach($loans as $loan) {
                if($amount == 0) {
                    break;
                } else {
                    if($amount >= $loan->remaining){
                        if($loan->remaining == $amount) {
                            $amount = 0;
                            $loan->remaining = 0;
                            $loan->status = 0;
                            $loan->save();

                            $loanPayment = new LoanPayment();
                            $loanPayment->loan_id = $loan->id;
                            $loanPayment->payment_date = date('Y-m-d');
                            $loanPayment->payment = $request->payment;
                            $loanPayment->user_id = 1;
                            $loanPayment->save();
                            break;
                        } else {
                            $payment_amount = $loan->remaining;
                            $amount = $amount -  $loan->remaining;
                            $loan->remaining = 0;
                            $loan->status = 0;
                            $loan->save();

                            $loanPayment = new LoanPayment();
                            $loanPayment->loan_id = $loan->id;
                            $loanPayment->payment_date = date('Y-m-d');
                            $loanPayment->payment = $payment_amount;
                            $loanPayment->user_id = 1;
                            $loanPayment->save();
                        }
                    } else {
                        $payment = $amount;
                        $remaining_amount =  $loan->remaining - $amount;
                        $amount = 0;
                        $loan->remaining = $remaining_amount;
                        $loan->status = 1;
                        $loan->save();

                        $loanPayment = new LoanPayment();
                        $loanPayment->loan_id = $loan->id;
                        $loanPayment->payment_date = date('Y-m-d');
                        $loanPayment->payment = $payment;
                        $loanPayment->user_id = 1;
                        $loanPayment->save();
                    }
                }
            }
        }

        return redirect()->route('customer.show', $customer->id);
    }
}
