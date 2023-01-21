<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceDetails;
use Illuminate\Http\Request;

class Invoices extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('invoices.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd(file_exists('frontend/js/form-validation/jquery.form.js'));
        return view('invoices.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        
        $data['customer_name']      = $request->customer_name;
        $data['customer_email']     = $request->customer_email;
        $data['customer_mobile']    = $request->customer_mobile;
        $data['company_name']       = $request->company_name;
        $data['invoice_number']     = $request->invoice_number;
        $data['invoice_date']       = $request->invoice_date;
        $data['sub_total']          = $request->sub_total;
        $data['discount_type']      = $request->descount_type ;
        $data['discount_value']     = $request->descount_value;
        $data['vat']                = $request->vat;
        $data['shipping']           = $request->shipping ?? 0;
        $data['total_due']          = $request->total_due;

        // return $data ;

        $invoice = Invoice::create($data);

        if($invoice){
            $invoice_details = [];
            for($i =0 ; $i < count($request->product_name) ; $i++){
                $invoice_details[$i]['product_name']        = $request->product_name[$i];
                $invoice_details[$i]['unit']        = $request->product_unit[$i];
                $invoice_details[$i]['quantity']    = $request->product_quantity[$i];
                $invoice_details[$i]['price']       = $request->product_price[$i] ;
                $invoice_details[$i]['productn_subtotal']    = $request->product_subtotal[$i];
                $invoice_details[$i]['invoice_id']          = $invoice->id;
            }
            // return $invoice_details;
    
            InvoiceDetails::insert($invoice_details);
        }

        // foreach

        return back();
        // return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('invoices.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('invoices.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
