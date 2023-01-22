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
                                    <th>{{trans('invoices/lang.customer_name')}}</th>
                                    <th>{{trans('invoices/lang.customer_email')}}</th>
                                    <th>{{trans('invoices/lang.invoice_number')}}</th>
                                    <th>{{trans('invoices/lang.customer_mobile')}}</th>
                                    <th>{{trans('invoices/lang.total_due')}}</th>
                                    <th>{{trans('invoices/lang.control')}}</th>
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
                                        <td class="d-flex gap-1">
                                            <button class="btn btn-primary btn-sm">
                                                <a href="{{route('invoice.edit' , $invoice->id)}} ">
                                                    <i class="fa-sharp fa-solid fa-pen-to-square text-light"></i>
                                                </a>
                                            </button>
                                            <form action="{{route('invoice.destroy' , $invoice->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Are you sure you want to delete this record?')">
                                                    <i class="fa-sharp fa-solid fa-trash text-light"></i>
                                                </button>
                                            </form>
                                        </td>
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