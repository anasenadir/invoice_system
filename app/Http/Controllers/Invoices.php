<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceDetails;
use Illuminate\Http\Request;
use Stringable;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;

class Invoices extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::paginate(10)->setPageName('invoicesList');
        return view('invoices.index')->with('invoices' , $invoices);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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


        $invoice = Invoice::create($data);

        $invoice_details = [];
        for($i =0 ; $i < count($request->product_name) ; $i++){
            $invoice_details[$i]['product_name']        = $request->product_name[$i];
            $invoice_details[$i]['unit']        = $request->product_unit[$i];
            $invoice_details[$i]['quantity']    = $request->product_quantity[$i];
            $invoice_details[$i]['price']       = $request->product_price[$i] ;
            $invoice_details[$i]['productn_subtotal']    = $request->product_subtotal[$i];
            $invoice_details[$i]['invoice_id']          = $invoice->id;
        }
        $details =  InvoiceDetails::insert($invoice_details);
        if($details){
            return redirect()->to('invoice')->with('message',flash_message_template('create_message' , 'alert-success'));
        }

        return redirect()->to('invoice')->with('message' , flash_message_template('error_message' , 'alert-danger'));
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::find($id); 
        if(!$invoice){
            return back();
        }
        return view('invoices.show')->with('invoice' , $invoice);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoice = Invoice::find($id);
        if(!$invoice){
            return back();
        }
        return view('invoices.edit')->with('invoice' , $invoice);
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
        $invoice = Invoice::find($id);

        if(!$invoice){
            return back();
        }
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


        // $invoice = Invoice::create($data);
        $invoice->update($data);

        $invoice_details = [];
        for($i =0 ; $i < count($request->product_name) ; $i++){
            $invoice_details[$i]['product_name']        = $request->product_name[$i];
            $invoice_details[$i]['unit']        = $request->product_unit[$i];
            $invoice_details[$i]['quantity']    = $request->product_quantity[$i];
            $invoice_details[$i]['price']       = $request->product_price[$i] ;
            $invoice_details[$i]['productn_subtotal']    = $request->product_subtotal[$i];
            $invoice_details[$i]['invoice_id']          = $invoice->id;
        }
        $invoice->details()->delete();
        // $details =  InvoiceDetails::insert($invoice_details);
        $details = $invoice->details()->insert($invoice_details);
        
        if($details){
            return redirect()->to('invoice')->with('message',flash_message_template('update_message' , 'alert-success'));
        }

        return redirect()->to('invoice')->with('message' , flash_message_template('error_message' , 'alert-danger'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invoice = Invoice::find($id);

        if(!$invoice){
            return back();
        }

        $deleted = $invoice->delete();
        if($deleted){
            return redirect()->to('invoice')->with('message', flash_message_template('delete_message' , 'alert-success'));
        }
        return redirect()->to('invoice')->with('message' , flash_message_template('error_message' , 'alert-danger'));
    }


    public function downloadInvoice($id)
    {
        $invoice = Invoice::find($id);
        if(!$invoice){
            return back();
        }
        $type = 'download';
        $pdf = Pdf::loadView('invoices.pdf', compact('invoice' , 'type'));
        return $pdf->download('template'.time(). rand(90 , 9999).'.pdf');
    }


    public function sendInvoice($id)
    {
        $invoice = Invoice::find($id);
        if(!$invoice){
            return back();
        }
        
        $type = 'send';
        Mail::send('invoices.pdf',compact('invoice' , 'type') ,function ($message) use ($invoice) {
            $type = 'download';
            $pdf = Pdf::loadView('invoices.pdf', compact('invoice' , 'type'));
            $message->to('khadija@alumaco.com')
                    ->from('anas@gmail.com')
                    ->subject('Created At 2022-12-20')
                    ->attachData($pdf->output() , 'invoice.pdf');
        });
        
        return redirect()->to('invoice')->with('message',flash_message_template('send_message' , 'alert-success'));
    }
}
