@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h2>{{ trans('invoices/lang.invoice') }}</h2>
            <a href="{{route('home')}}">
                <button class="btn btn-primary">
                    <i class="fa-solid fa-house"></i>
                    {{ trans('invoices/lang.back_to_home') }}
                </button>
            </a>
        </div>
        <div class="card-body">
            <div class="invoice-data">
                <div class="row">
                    <div class="col-4">
                        <label for="customer_name">{{ trans('invoices/lang.customer_name') }}</label>
                        <span class="d-block p-2 border">{{$invoice->customer_name}}</span>
                    </div>
                    {{-- --------------------- --}}
                    <div class="col-4">
                        <label for="customer_email">{{trans('invoices/lang.customer_email')}}</label>
                        <span class="d-block p-2 border">{{$invoice->customer_email}}</span>
                    </div>
                    {{-- --------------------- --}}
                    <div class="col-4">
                        <label for="customer_mobile">{{trans('invoices/lang.customer_mobile')}}</label>
                        <span class="d-block p-2 border">{{$invoice->customer_mobile}}</span>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-4">
                        <label for="company_name">{{trans('invoices/lang.company_name')}}</label>
                        <span class="d-block p-2 border">{{$invoice->company_name}}</span>
                    </div>
                    {{-- --------------------- --}}
                    <div class="col-4">
                        <label for="invoice_number">{{trans('invoices/lang.invoice_number')}}</label>
                        <span class="d-block p-2 border">{{$invoice->invoice_number}}</span>
                    </div>
                    {{-- --------------------- --}}
                    <div class="col-4">
                        <label for="invoice_date">{{trans('invoices/lang.invoice_date')}}</label>
                        <span class="d-block p-2 border">{{$invoice->invoice_date}}</span>
                    </div>
                </div>
    
    
                <div class="table-responsive mt-3">
                    <table class="table col-12">
                        <thead>
                            <tr>
                                <th class="col-3">{{trans('invoices/lang.product_name')}}</th>
                                <th class="col-2">{{trans('invoices/lang.unit')}}</th>
                                <th class="col-2">{{trans('invoices/lang.quantity')}}</th>
                                <th class="col-2">{{trans('invoices/lang.price')}}</th>
                                <th class="col-3">{{trans('invoices/lang.productn_subtotal')}}</th>
                            </tr>
                        </thead>
                        <tbody  class="invoice_details">
                            @foreach ($invoice->details as $key => $details)
                                <tr class="order_details" id='{{$key}}'>
                                    <td>
                                        <span class="d-block p-2 border">{{$details->product_name}}</span>
                                    </td>
                                    <td>
                                        <span class="d-block p-2 border">{{$details->unit}}</span>
                                    </td>
                                    <td>
                                        <span class="d-block p-2 border">{{$details->quantity}}</span>
                                    </td>
                                    <td>
                                        <span class="d-block p-2 border">{{$details->price}}</span>
                                    </td>
                                    <td>
                                        <span class="d-block p-2 border">{{$details->productn_subtotal}}</span>
                                    </td>
                                </tr>
                            @endforeach
        
                            
                        </tbody>
                        <tfoot>

                            <tr>
                                <td colspan="3"></td>
                                <td>{{trans('invoices/lang.sub_total')}}</td>
                                <td>
                                    <span class="d-block p-2 border">{{$invoice->sub_total}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td>{{trans('invoices/lang.discount')}}</td>
                                <td>
                                    <div class="input-group">
                                        <span class="d-inline-block p-2 border w-25">{{$invoice->discount_type}}</span>
                                        <span class="d-inline-block p-2 border w-75">{{$invoice->discount_value}}</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td>{{trans('invoices/lang.vat')}}(5%)</td>
                                <td>
                                    <span class="d-block p-2 border">{{$invoice->vat}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td>{{trans('invoices/lang.shipping')}}</td>
                                <td>
                                    <span class="d-block p-2 border">{{$invoice->shipping}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td>{{trans('invoices/lang.total_due')}}</td>
                                <td>
                                    <span class="d-block p-2 border">{{$invoice->total_due}}</span>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>

            <div class="d-flex gap-2 justify-content-center align-items-center">
                <a href="{{route('invoice.downloadInvoice' , $invoice->id)}}" class="link-light text-decoration-none">
                    <button class="btn btn-primary text-light">
                        <i class="fa-solid fa-download"></i> 
                        {{ trans('invoices/lang.download_invoice') }} 
                    </button>
                </a>
                <a href="{{route('invoice.sendInvoice' , $invoice->id)}}" class="link-light text-decoration-none">
                    <button class="btn btn-success">
                        <i class="fa-sharp fa-solid fa-paper-plane"></i> 
                        {{ trans('invoices/lang.send_by_email') }} 
                    </button>
                </a>
                {{-- <button class="btn btn-primary"></button> --}}
            </div>
        </div>
    </div>
@endsection