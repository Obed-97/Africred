<div>
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
          color: #1b2586;
          font-size: 1.2em;
          font-weight: normal;
          margin: 0 0 0.2em 0;
        }

        table .no {
          color: #FFFFFF;
          font-size: 1.6em;
          background: #1b2586;
        }

        table .n1 {
          text-align: left;
        }

        table .n2 {
          background: #DDDDDD;
        }

        table .n5 {
          background: #f2ae6d;
        }

        table .n3 {
        }

        table .n4 {
          background: #1b2586;
          color: #FFFFFF;
        }

        table td.n2,
        table td.n3,
        table td.n4 {
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
          color: #1b2586;
          font-size: 1.4em;
          border-top: 1px solid #1b2586;

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

    </style>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="clearfix">
                                <div id="logo">
                                    <img src="{{ asset('assets/images/Logo AfriCRED.png') }}">
                                </div>
                                <div id="company">
                                    <br>
                                    <br>
                                    <div>Fait à Bamako le 08.03.24</div>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <h1 class="card-title text-left mb-4">
                        Encours sans intérêt
                    </h1>
                    <p>
                        L’encours sans intérêt fait référence au capital qui reste à recouvrir sur les prêts accordés aux clients dans les différents marchés.
                        Le tableau ci-dessous donne les détails sur les encours sans intérêts ou encore capital à recouvrir.
                    </p>
                    <div class="row">
                        <div class="col-xl-12">
                            <table border="0" cellspacing="0" cellpadding="0">
                                <thead>
                                    <tr>
                                        <th class="no"></th>
                                        <th class="n1">Semaine 1</th>
                                        <th class="n2">Semaine 2</th>
                                        <th class="n4">ECART</th>
                                    </tr>
                                </thead>
                                <tbody>

                                        <tr>
                                            <td class="no">1</td>
                                            <td class="n1">sed</td>
                                            <td class="n2">dde</td>
                                            <td class="n4">343 FCFA</td>
                                        </tr>
                                        <tr>
                                          <td class="no">TOTAL NANO</td>
                                          <td class="n1">sed</td>
                                          <td class="n2">dde</td>
                                          <td class="n4">343 FCFA</td>
                                        </tr>
                                        <tr>
                                          <td class="no">TOTAL AB-SUGU</td>
                                          <td class="n1">sed</td>
                                          <td class="n2">dde</td>
                                          <td class="n4">343 FCFA</td>
                                        </tr>
                                        <tr>
                                          <td class="n5">TOTAL GENERALE</td>
                                          <td class="n5">sed</td>
                                          <td class="n5">dde</td>
                                          <td class="n5">343 FCFA</td>
                                        </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <h1 class="card-title text-left mb-4">
                        Commentaires
                    </h1>
                    <p>
                        Cette semaine l’encours sans intérêt a baissé de 1.087.500 CFA, ce qui signifie que nous avons pas fait assez de déblocage cette semaine par rapport à la semaine passée.
                        Sur le capital de 55.747.100 CFA, 1.611.275 CFA représente le capital à recouvrir sur les crédits en difficultés de paiement et 54.135.825 CFA de capital en mouvement.
                    </p>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>
