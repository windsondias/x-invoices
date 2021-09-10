<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice Print</title>
    <style>

        @page {
            margin: 100px 50px;
        }

        @font-face {
            font-family: 'Betterlove';
            src: url({{storage_path('fonts/Betterlove.ttf')}}) format('truetype');
            font-weight: normal;
            font-style: normal;
            font-variant: normal;
        }

        @font-face {
            font-family: 'BebasNeue-Regular';
            src: url({{storage_path('fonts/BebasNeue-Regular.ttf')}}) format('truetype');
            font-weight: normal;
            font-style: normal;
            font-variant: normal;
        }

        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 100px;
        }

        footer {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            height: 200px;
        }

        .font-bold {
            font-weight: bold;
        }

        .mt-1 {
            margin-top: 10px;
        }

        .mt-2 {
            margin-top: 20px;
        }

        .mt-3 {
            margin-top: 30px;
        }

        .mt-5 {
            margin-top: 50px;
        }

        p {
            margin: 0;
            padding: 0;
        }
        .table-description{
            border-collapse: collapse;
        }
        .table-description thead tr th{
            padding-top: 10px;
            padding-bottom: 10px;
            border-top: #F00 solid 2px;
            border-bottom: #F00 solid 2px;
        }
        .table-description tbody tr td{
            padding-top: 5px;
            padding-bottom: 5px;
        }
        .table-description tfoot tr th{
            padding-top: 10px;
            padding-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <header style="">
        <p class="font-bold" style="font-size: 60px;color: #28416c">INVOICE</p>
        <p class="font-bold" style="font-size: 16px;padding-top: 10px">{{$invoice->from}}</p><br/>
    </header>

    <footer style="">
        <table style="width: 100%">
            <tbody>
            <tr>
                <td style="text-align: right;padding-right: 10px;width: 50%; height: 200px;vertical-align: bottom;border-right: #000 solid 2px">
                    <span style="font-size: 60px;font-family: Betterlove">Thank You</span>
                </td>
                <td style="text-align: left;vertical-align: top;padding-top: 10px;padding-left: 10px">
                    <span style="font-size: 18px;color: #F00">TERMS & CONDITIONS</span>
                    <p style="white-space: pre-wrap; padding-top: 30px;font-size: 16px">{{ $invoice->terms}}</p>
                </td>
            </tr>
            </tbody>
        </table>
    </footer>
    <main style=" margin-top: 80px">
        <section style="">
            <table style="width: 100%">
                <tbody>
                <tr>
                    <th style="text-align: left; width: 60%;color: #28416c">BILL TO</th>
                    <th style="text-align: left;color: #28416c">INVOICE #</th>
                    <td style="text-align: right">{{$invoice->number}}</td>
                </tr>
                <tr>
                    <td style="text-align: left">{{$invoice->bill_to}}</td>
                    <th style="text-align: left;color: #28416c">INVOICE DATE</th>
                    <td style="text-align: right">{{\Carbon\Carbon::parse($invoice->invoice_date)->format('d/m/Y')}}</td>
                </tr>
                </tbody>
            </table>

            <table class="table-description" style="width: 100%;margin-top: 100px">
                <thead>
                <tr>
                    <th style="color: #28416c">QTY</th>
                    <th style="color: #28416c">DESCRIPTION</th>
                    <th style="text-align: right;color: #28416c">UNIT PRICE</th>
                    <th style="text-align: right;padding-right: 10px;color: #28416c">AMOUNT</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $total = 0;
                @endphp
                @foreach($invoice->items as $item)
                    @php
                        $amount = $item->quantity * $item->unit_price;
                        $total += $amount;
                    @endphp
                    <tr>
                        <td style="text-align: center;width: 10%">{{$item->quantity}}</td>
                        <td style="text-align: center;width: 50%">{{$item->description}}</td>
                        <td style="text-align: right">{{number_format($item->unit_price, 2)}}</td>
                        <td style="text-align: right;padding-right: 10px">{{number_format($amount, 2)}}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th style=""></th>
                    <th style=""></th>
                    <th style="text-align: right;color: #28416c">TOTAL</th>
                    <th style="text-align: right;padding-right: 10px;color: #28416c">{{number_format($total, 2)}} €</th>
                </tr>
                </tfoot>
            </table>
        </section>
    </main>

</div>

</body>
</html>
