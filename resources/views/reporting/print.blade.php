<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Facture #{{ $invoice->invoice_no }} - Ibraci Links</title>
        <style media="screen">
            @font-face {
                font-family:proxima-nova;
                src: url(../fonts/proxima-nova.eot);
                src: url(../fonts/proxima-novad41d.eot?#iefix) format("embedded-opentype"),
                     url(../fonts/proxima-nova.woff) format("woff"),
                     url(../fonts/proxima-nova.ttf) format("truetype"),
                     url(../fonts/proxima-nova.svg#proxima-nova) format("svg");
                font-weight:400;font-style:normal
            }

            .clearfix:after {
              content: "";
              display: table;
              clear: both;
            }

            a {
              color: #0087C3;
              text-decoration: none;
            }

            body {
              position: relative;
              max-width: 900px;
              height: 29.7cm;
              margin: 0 auto;
              color: #555555;
              background: #FFFFFF;
              font-size: 14px;
              font-family:proxima-nova,sans-serif;
            }

            header {
              padding: 10px 0;
              margin-bottom: 20px;
              border-bottom: 1px solid #AAAAAA;
            }

            #logo {
              float: left;
              margin-top: 4px;
            }

            #logo img {
              height: 90px;
            }

            #company {
              float: right;
              text-align: right;
            }


            #details {
              margin-bottom: 50px;
            }

            #client {
              padding-left: 6px;
              border-left: 6px solid #0087C3;
              float: left;
            }

            #client .to {
              color: #777777;
            }

            h2.name {
              font-size: 1.4em;
              font-weight: normal;
              margin: 0;
            }

            #invoice {
              float: right;
              text-align: right;
            }

            #invoice h1 {
              color: #0087C3;
              font-size: 2em;
              line-height: 1em;
              font-weight: normal;
              margin: 0  0 10px 0;
            }

            #invoice .date {
              font-size: 1.1em;
              color: #777777;
            }

            table {
              width: 100%;
              border-collapse: collapse;
              border-spacing: 0;
              margin-bottom: 20px;
            }

            table th,
            table td {
              padding: 20px;
              background: #EEEEEE;
              text-align: center;
              border-bottom: 1px solid #FFFFFF;
            }

            table th {
              white-space: nowrap;
              font-weight: normal;
            }

            table td {
              text-align: right;
            }

            table td h3{
              color: #0099cc;
              font-size: 1.2em;
              font-weight: normal;
              margin: 0 0 0.2em 0;
            }

            table .no {
              color: #FFFFFF;
              font-size: 1.6em;
              background: #0099cc;
            }

            table .desc {
              text-align: left;
            }

            table .unit {
              background: #DDDDDD;
            }

            table .qty {
            }

            table .total {
              background: #0099cc;
              color: #FFFFFF;
            }

            table td.unit,
            table td.qty,
            table td.total {
              font-size: 1.2em;
            }

            table tbody tr:last-child td {
              border: none;
            }

            table tfoot td {
              padding: 10px 20px;
              background: #FFFFFF;
              border-bottom: none;
              font-size: 1.2em;
              white-space: nowrap;
              border-top: 1px solid #AAAAAA;
            }

            table tfoot tr:first-child td {
              border-top: none;
            }

            table tfoot tr:last-child td {
              color: #0099cc;
              font-size: 1.4em;
              border-top: 1px solid #0099cc;

            }

            table tfoot tr td:first-child {
              border: none;
            }

            #thanks{
              font-size: 2em;
              margin-bottom: 50px;
            }

            #notices{
              padding-left: 6px;
              border-left: 6px solid #0087C3;
            }

            #notices .notice {
              font-size: 1.2em;
            }

            footer {
              color: #777777;
              width: 100%;
              height: 30px;
              position: absolute;
              bottom: 0;
              border-top: 1px solid #AAAAAA;
              padding: 8px 0;
              text-align: center;
            }
        </style>
    </head>
    <body>
        <header class="clearfix">
            <div id="logo">
                <img src="https://ibracilinks.com/assets/images/logo.png">
            </div>
            <div id="company">
                <h2 class="name">{{ config('app.name') }}</h2>
                <div>+223 78 61 61 94</div>
                <div><a href="mailto:{{ config('app.email') }}">{{ config('app.email') }}</a></div>
                <div>
                    Immeuble Elhadji Bah Sady Dabo,<br>
                    Faladie, en face de SONEF Tranport,<br>
                    Bamako - Mali
                </div>
            </div>
        </header>
        <main>
            <div id="details" class="clearfix">
                <div id="client">
                    <div class="to"></div>
                    <h2 class="name">{{ $invoice->user->fullName() }}</h2>
                    <div>
                        +{{ $invoice->user->phone }}<br>
                        {{ $invoice->user->email }}
                    </div>
                    <div class="address">
                        {{ $invoice->user->address() }}<br>
                        {{-- {{ $invoice->user->city }}, {{ $invoice->user->country }} --}}
                    </div>
                    <div class="email"><a href="mailto:{{ $invoice->user->email }}">{{ $invoice->user->email }}</a></div>
                </div>
                <div id="invoice">
                    <h1>Facture no: #{{ $invoice->invoice_no }}<br></h1>
                    <div class="date">Date : {{ Carbon\Carbon::parse($invoice->created_at)->format('F d, Y ') }}</div>
                </div>
            </div>
            <table border="0" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th class="no">#</th>
                        <th class="desc">Désignation</th>
                        <th class="unit">Prix</th>
                        <th class="qty">QTE</th>
                        <th class="total">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1;
                    @endphp
                    @foreach ($invoice->items as $item)
                        <tr>
                            <td class="no">{{ $i }}</td>
                            <td class="desc">{{ $item->item }}</td>
                            <td class="unit">{{ $item->price() }}</td>
                            <td class="qty">{{ $item->quantity }}</td>
                            <td class="total">{{ $item->total() }} FCFA</td>
                        </tr>
                        @php
                            $i = $i+1;
                        @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">GRAND TOTAL</td>
                        <td>{{ $invoice->total() }} FCFA</td>
                    </tr>
                </tfoot>
            </table>
            <div id="thanks">Merci !</div>
        </main>
        <footer>
            {{-- Ceci est une facture digitale et est valable sans la signature et le cachet. --}}
        </footer>
    </body>
</html>
