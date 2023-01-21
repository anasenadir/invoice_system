@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{asset('frontend/css/pickadate/classic.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/pickadate/classic.date.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/pickadate/classic.time.css')}}">
    @if (config('app.locale') == 'ar')
        <link rel="stylesheet" href="{{asset('frontend/css/pickadate/rtl.js')}}">
    @endif
    <style>
        .error{
            color: rgb(223, 15, 15);
            margin-top: 2px
        }
    </style>
@endsection
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h2>{{ trans('invoices/lang.create_invoice') }}</h2>
            <a href="{{route('home')}}">
                <button class="btn btn-primary">
                    <i class="fa-solid fa-house"></i>
                    {{ trans('invoices/lang.back_to_home') }}
                </button>
            </a>
        </div>
        <div class="card-body">
            <form id="myform" method="POST" action="{{route('invoice.store')}}">
                @csrf
                <div class="row">
                    <div class="col-4">
                        <label for="customer_name">{{ trans('invoices/lang.customer_name') }}</label>
                        <input type="text" class="form-control" name='customer_name'>
                    </div>
                    @error('customer_name')
                        <p class="text-danger">{{trans('invoices/lang.customer_message')}}</p>
                    @enderror
                    {{-- --------------------- --}}
                    <div class="col-4">
                        <label for="customer_email">{{trans('invoices/lang.customer_email')}}</label>
                        <input type="text" class="form-control"  name='customer_email'>
                    </div>
                    @error('customer_email')
                        <p class="text-danger">{{trans('invoices/lang.customer_message')}}</p>
                    @enderror
                    {{-- --------------------- --}}
                    <div class="col-4">
                        <label for="customer_mobile">{{trans('invoices/lang.customer_mobile')}}</label>
                        <input type="text" class="form-control" name='customer_mobile'>
                    </div>
                    @error('customer_mobile')
                        <p class="text-danger">{{trans('invoices/lang.customer_message')}}</p>
                    @enderror
                </div>
    
    
                <div class="row mt-3">
                    <div class="col-4">
                        <label for="company_name">{{trans('invoices/lang.company_name')}}</label>
                        <input type="text" class="form-control"  name='company_name'>
                    </div>
                    @error('company_name')
                        <p class="text-danger">{{trans('invoices/lang.company_message')}}</p>
                    @enderror
                    {{-- --------------------- --}}
                    <div class="col-4">
                        <label for="invoice_number">{{trans('invoices/lang.invoice_number')}}</label>
                        <input type="text" class="form-control"  name='invoice_number'>
                    </div>
                    @error('invoice_number')
                        <p class="text-danger">{{trans('invoices/lang.invoice_message')}}</p>
                    @enderror
                    {{-- --------------------- --}}
                    <div class="col-4">
                        <label for="invoice_date">{{trans('invoices/lang.invoice_date')}}</label>
                        <input type="date" class="form-control invoice_date"  name='invoice_date'>
                    </div>
                    @error('invoice_date')
                        <p class="text-danger">{{trans('invoices/lang.invoice_message')}}</p>
                    @enderror
                </div>
    
    
                <div class="table-responsive">
                    <table class="table col-12" id='form-details'>
                        <thead>
                            <tr>
                                <th scope="col" class="px-3"></th>
                                <th scope="col">{{trans('invoices/lang.product_name')}}</th>
                                <th scope="col">{{trans('invoices/lang.unit')}}</th>
                                <th scope="col">{{trans('invoices/lang.quantity')}}</th>
                                <th scope="col">{{trans('invoices/lang.price')}}</th>
                                <th scope="col">{{trans('invoices/lang.productn_subtotal')}}</th>
                            </tr>
                        </thead>
                        <tbody  class="invoice_details">
                            <tr class="order_details" id='0'>
                                <td class="px-3">*</td>
                                <td>
                                    <input type="text" class="form-control product_name"  name='product_name[0]'>
                                </td>
                                <td>
                                    <select class="form-select unit" aria-label="Default select example" name="product_unit[0]">
                                        <option selected></option>
                                        <option value="piece">Piece</option>
                                        <option value="g">G</option>
                                        <option value="km">KG</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="number"  class="form-control product_quantity"  name='product_quantity[0]'>
                                </td>
                                <td>
                                    <input type="number" value="0.00" step="0.01" class="form-control product_price"  name='product_price[0]'>
                                </td>
                                <td>
                                    <input type="number" step="0.01" class="form-control product_subtotal"  readonly name='product_subtotal[0]'>
                                </td>
                            </tr>
        
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6">
                                    <button class="btn btn-primary" id='add_product'><i class="fa-solid fa-plus"></i> {{trans('invoices/lang.add_another_product')}}</button>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="4"></td>
                                <td>{{trans('invoices/lang.sub_total')}}</td>
                                <td>
                                    <input type="number" step="0.01" class="form-control sub_total"  name='sub_total' readonly/>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                                <td>{{trans('invoices/lang.discount')}}</td>
                                <td>
                                    <div class="input-group">
                                        <select class="form-select-sm descount_type" name="descount_type">
                                            <option value="dh">Dh</option>
                                            <option value="percent">prcentage</option>
                                        </select>
                                        <input type="number" step="0.01" class="form-control descount_value" value='0'  name='descount_value' />
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                                <td>{{trans('invoices/lang.vat')}}(5%)</td>
                                <td>
                                    <input type="number" step="0.01" class="form-control vat"  name='vat' readonly/>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                                <td>{{trans('invoices/lang.shipping')}}</td>
                                <td>
                                    <input type="number" step="0.01" class="form-control shipping"  name='shipping' />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                                <td>{{trans('invoices/lang.total_due')}}</td>
                                <td>
                                    <input type="number" step="0.01" class="form-control total_due"  name='total_due' readonly/>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="text-end">
                    <button class="btn btn-primary">{{ trans('invoices/lang.save') }}</button>
                </div> 
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- ✅  validation libararies from project assets ✅ -->
    <script src="{{asset('frontend/js/form-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('frontend/js/form-validation/additional-methods.min.js')}}"></script>
    

    <!-- ✅  pickdate from project asstes ✅ -->
    <script src="{{asset('frontend/js/pickadate/picker.js')}}"></script>
    <script src="{{asset('frontend/js/pickadate/picker.date.js')}}"></script>    


    @if (config('app.locale') == 'ar')
        <script src="{{asset('frontend/js/pickadate/ar.js')}}"></script>
        <script src="{{asset('frontend/js/form-validation/messages_ar.js')}}"></script>
    @endif


    <!-- ✅ my custom js file ✅ -->
    <script src="{{asset('frontend/js/custom.js')}}"></script>
    

    
@endsection