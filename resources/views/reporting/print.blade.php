<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Rapport d'activité</title>
        <style media="screen">
            .clearfix:after {
                content: "";
                display: table;
                clear: both;
            }

            a {
                color: #0087C3;
                text-decoration: none;
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
                padding-left: 2px;
                border-left: 6px solid #0087C3;
                float: left;
            }

            #client .to {
                color: #777777;
            }

            h2.name {
                font-size: 1em;
                font-weight: normal;
                margin: 0;
            }

            #invoice {
                float: right;
                text-align: right;
            }

            #invoice h1 {
                color: #0087C3;
                font-size: 1;
                line-height: 1em;
                font-weight: normal;
                margin: 0 0 10px 0;
            }

            #invoice .date {
                font-size: 1em;
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
                padding: 5px;
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

            table td h3 {
                color: #1b2586;
                font-size: 1em;
                font-weight: normal;
                margin: 0 0 0.2em 0;
            }

            table .no {
                color: #FFFFFF;
                font-size: 1em;
                background: #1b2586;
            }

            table .n1 {
                text-align: center;
            }

            table .n2 {
                background: #DDDDDD;
                text-align: center;
            }

            table .n5 {
                background: #d5c7b7;
            }

            table .n3 {
                background: #e6ad6c;
                text-align: rigth
            }

            table .n4 {
                background: #1b2586;
                color: #FFFFFF;
                text-align: center;
            }

            table td.n2,
            table td.n3,
            table td.n4 {
                font-size: 1em;
            }

            table tbody tr:last-child td {
                border: none;
            }

            table tfoot td {
                padding: 10px 20px;
                background: #FFFFFF;
                border-bottom: none;
                font-size: 1em;
                white-space: nowrap;
                border-top: 1px solid #AAAAAA;
            }

            table tfoot tr:first-child td {
                border-top: none;
            }

            table tfoot tr:last-child td {
                color: #1b2586;
                font-size: 1em;
                border-top: 1px solid #1b2586;

            }

            table tfoot tr td:first-child {
                border: none;
            }

            #thanks {
                font-size: 1;
                margin-bottom: 50px;
            }

            #notices {
                padding-left: 2px;
                border-left: 6px solid #0087C3;
            }

            #notices .notice {
                font-size: 1em;
            }
        </style>
    </head>
    <body>
        <header class="clearfix">
            <div id="logo">
                <img src="https://africa-africred.com/media/Logo%20AfriCRED1.png">
            </div>
            <div id="company">
                <div>Fait à Bamako le {{ \Date::now()->format('d.m.y') }}</div>
            </div>
        </header>
        <main>
            <x-reporting-component
                com1="{{ $coom1 }}"
                com2="{{ $coom2 }}"
                com3="{{ $coom3 }}"
                com4="{{ $coom4 }}"
                com5="{{ $coom5 }}"
                com6="{{ $coom6 }}"
                com7="{{ $coom7 }}"
                com8="{{ $coom8 }}"
                com9="{{ $coom9 }}"
                com10="{{ $coom10 }}"
                com11="{{ $coom11 }}"
                com12="{{ $coom12 }}"
                com13="{{ $coom13 }}"
                com14="{{ $coom14 }}"
                com15="{{ $coom15 }}"
            />
        </main>
        <footer>
            {{-- Ceci est une facture digitale et est valable sans la signature et le cachet. --}}
        </footer>
    </body>
</html>
