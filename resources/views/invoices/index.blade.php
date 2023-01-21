@extends('layouts.app')
@section('css')
    <style>
        svg{
            width: 20px !important;
        }

        span[aria-current] > span{
            background: #0d6efd !important;
            color: white
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header ">
                    {{session()->get('lang_rtl') ? 'yes' : "no"}}
                </div>
                <div class="card-body">
                    <a href="{{route('invoice.create')}}">
                        <button class="btn btn-primary">
                            <i class="fa-solid fa-file-invoice"></i>
                            Create Invoice
                        </button>
                    </a>


                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Email</th>
                                    <th>Invoice Number</th>
                                    <th>Phone</th>
                                    <th>Total Due</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <td><a href="{{ route('invoice.show', $invoice->id) }}">{{$invoice->customer_name}}</a> </td>
                                        <td>{{$invoice->customer_email}}</td>
                                        <td>{{$invoice->invoice_number}}</td>
                                        <td>{{$invoice->invoice_date}}</td>
                                        <td>{{$invoice->total_due}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                
                                {{-- {{$invoices->setCursorName()}} --}}
                            </tfoot>
                        </table>


                        <div class="">
                            {{$invoices->links()}}
                            {{-- {{$invoices->nextPageUrl()}} --}}
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection