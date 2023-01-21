@extends('layouts.app')
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
                </div>
            </div>
        </div>
    </div>
@endsection