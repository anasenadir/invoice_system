<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Example 1</title>
    <!-- <link rel="stylesheet" href="test.css" media="all" /> -->
    <style>
      .clearfix:after {
          content: "";
          display: table;
          clear: both;
        }

        a {
          color: #5D6975;
          text-decoration: underline;
        }

        body {
          position: relative;
          width: 19cm;  
          height: 27cm; 
          margin: 0 auto; 
          color: #001028;
          background: #FFFFFF; 
          font-family: Arial, sans-serif; 
          font-size: 12px; 
          font-family: Arial;
        }

        header {
        padding: 10px 0;
        margin-bottom: 30px;
        }

        #logo {
        text-align: center;
        margin-bottom: 10px;
        }

        #logo img {
        width: 120px;
        }

        h1 {
          border-top: 1px solid  #5D6975;
          border-bottom: 1px solid  #5D6975;
          color: #5D6975;
          font-size: 2.4em;
          line-height: 1.4em;
          font-weight: normal;
          text-align: center;
          margin: 0 0 20px 0;
          background: url(dimension.png);
        }

        #project {
        float: left;
        }

        #project span {
        color: #5D6975;
        text-align: right;
        width: 52px;
        margin-right: 10px;
        display: inline-block;
        font-size: 0.8em;
        }

        #company {
        float: right;
        text-align: right;
        }

        #project div,
        #company div {
        white-space: nowrap;        
        }

        table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px;
        }

        table tr:nth-child(2n-1) td {
        background: #F5F5F5;
        }

        table th,
        table td {
        text-align: center;
        }

        table th {
        padding: 5px 20px;
        color: #5D6975;
        border-bottom: 1px solid #C1CED9;
        white-space: nowrap;        
        font-weight: normal;
        }

        table .service,
        table .desc {
        text-align: left;
        }

        table td {
        padding: 20px;
        }

        table td.service,
        table td.desc {
        vertical-align: top;
        }

        table td.unit,
        table td.qty,
        table td.total {
        font-size: 1.2em;
        }

        table td.grand {
        border-top: 1px solid #5D6975;;
        }

        #notices .notice {
        color: #5D6975;
        font-size: 1.2em;
        }

        footer {
        color: #5D6975;
        width: 100%;
        height: 30px;
        position: absolute;
        bottom: 0;
        border-top: 1px solid #C1CED9;
        padding: 8px 0;
        text-align: center;
        }
    </style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        @if ($type == 'view')
          <img src="/logo.png" alt="image">
        @endif

        @if ($type == 'download')
          <img src="{{public_path('logo.png')}}" alt="image">
          @endif
          
        @if ($type == 'send')
          <img src="{{$message->embed(public_path('logo.png'))}}" alt="image">
        @endif
      </div>
      <h1>{{ config('app.name', 'Laravel') }}</h1>
      <div id="company" class="clearfix">
        <div>{{$invoice->company_name}}</div>
        <div>455 Foggy Heights,<br /> AZ 85004, US</div>
        <div>{{$invoice->customer_mobile}}</div>
        <div><a href="#">{{$invoice->customer_email}}</a></div>
      </div>
      <div id="project">
        <div><span>INVOICE</span> {{$invoice->invoice_number}}</div>
        <div><span>CLIENT</span> {{$invoice->customer_name}} </div>
        {{-- <div><span>ADDRESS</span> 796 Silver Harbour, TX 79273, US</div> --}}
        <div><span>EMAIL</span> <a href="#">{{$invoice->customer_email}}</a></div>
        <div><span>DATE</span> {{$invoice->invoice_date}}</div>
        <div><span>DUE DATE</span> September 17, 2015</div>
      </div>
    </header>
    <main>
        <table>
            @yield('table')
            <thead>
              <tr>
                <th scope="col">Product Name</th>
                <th scope="col">Unit</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">Productn Subtotal</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($invoice->details as $details)
              <tr>
                <td>
                    {{$details->product_name}}
                </td>
                <td>
                    {{$details->unit}}
                </td>
                <td>
                    {{$details->quantity}}
                </td>
                <td>
                    {{$details->price}}
                </td>
                <td>
                    {{$details->productn_subtotal}}
                </td>
              </tr>
            @endforeach
          </tbody>
            <tfoot>

                            <tr>
                                <td colspan="3"></td>
                                <td>{{trans('invoices/lang.sub_total')}}</td>
                                <td>
                                    {{$invoice->sub_total}}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td>{{trans('invoices/lang.discount')}}</td>
                                <td>
                                    <div class="input-group">
                                        <span width="25%">{{$invoice->discount_type}}</span>
                                        <span width='75%'>{{$invoice->discount_value}}</span>
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

      
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
      </div>
    </main>
    <footer>
      Invoice was created on a <a href="www.google.com">computer</a>  and is valid without the signature and seal.
    </footer>
  </body>
</html>