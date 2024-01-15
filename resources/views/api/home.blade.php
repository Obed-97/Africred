<!DOCTYPE html>

<html>

<head>
        
    <meta charset="utf-8" />
    <title>AFRICRED | API</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}">
    
    <link href="{{asset('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- DataTables -->
    <link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />  

    <!-- Bootstrap Css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
    
    <style>
        .tables{
          border: 1px solid #5664d2;
          border-collapse: collapse;
          border-spacing: 30px;
        }
       
        
        .thead, th, td {
          padding-top: 10px;
          padding-bottom: 20px;
          padding-left: 10px;
          padding-right: 20px;
          
          border: 1px solid #5664d2;
          border-collapse: collapse;
          border-spacing: 30px;
          
        }
        
      
        .input{
            border:0;
            border-color: transparent;
            
        }
        
        .ligne{
            line-height: 23px;
            word-spacing: 2px;
        }
        
        .first{
            border-top: 1px solid #fff;
            border-left: 1px solid #fff;
           
        }
        
    
        
        
        
        
    </style>
    

</head>

<body >
    <!-- Loader -->
    <div id="web">
        <div id="preloader">
            <div id="status">
                <div class="spinner">
                    <i class="ri-loader-line spin-icon"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        
        <!-- end page title -->
    <div class="container mt-2 mb-4" style=" border:1px solid white; background-color: white; color: black;">
        <div class="row mt-0 mb-5">
            <div class="col-4"></div>
            <div class="col-md-4 mt-4 text-center">
                <img src="{{asset('assets/images/Logo AfriCRED.png')}}" alt="" height="70">
            </div>
            
            <div class="col-md-4 mt-5 ">
               
            </div>
            
        </div>
        <div class="row mt-1 mb-4">
                <div class="col-3"></div>
                <div class="col-md-6 mt-0 text-center">
                   <h5>API : <a href="https://app.africa-africred.com/api">https://app.africa-africred.com/api</a></h5> 
                </div>
                
                <div class="col-md-3 mt-5 ">
                   
                </div>
                
            </div>
        <div class="row mt-4">  
                <div class="col-1"></div>
                <div class="col-md-10">
                    <table  class="tables dt-responsive th thead nowrap w-100  text-black mb-3" style="font-size: 17px;">
                        <thead class="thead-light">
                            <tr class="text-center" style="background-color: #5664d2; color: white ">
                                <th>APIs</th>
                                <th>MÉTHODES</th>
                                <th>URLs</th>
                                
                            </tr>
                            
                        </thead>
                        <tbody style="background-color: #F5F5F5;  ">
                            <tr class="text-center">
                                <td>Rôle</td>
                                <td><span class="text-success">GET</span>, <span class="text-primary">POST</span>, <span class="text-warning">PUT</span>, <span class="text-danger">DELETE</span></td>
                                <td><a href="https://app.africa-africred.com/api/role" target="_blank">https://app.africa-africred.com/api/role</a></td>
                            </tr>
                            <tr class="text-center">
                                <td>User</td>
                                <td><span class="text-success">GET</span>, <span class="text-primary">POST</span>, <span class="text-warning">PUT</span>, <span class="text-danger">DELETE</span></td>
                                <td><a href="https://app.africa-africred.com/api/user" target="_blank">https://app.africa-africred.com/api/user</a></td>
                            </tr>
                            <tr class="text-center">
                                <td>Client</td>
                                <td><span class="text-success">GET</span>, <span class="text-primary">POST</span>, <span class="text-warning">PUT</span>, <span class="text-danger">DELETE</span></td>
                                <td><a href="https://app.africa-africred.com/api/client" target="_blank">https://app.africa-africred.com/api/client</a></td>
                            </tr>
                            <tr class="text-center">
                                <td>Crédit</td>
                                <td><span class="text-success">GET</span>, <span class="text-primary">POST</span>, <span class="text-warning">PUT</span>, <span class="text-danger">DELETE</span></td>
                                <td><a href="https://app.africa-africred.com/api/credit" target="_blank">https://app.africa-africred.com/api/credit</a></td>
                            </tr>
                            <tr class="text-center">
                                <td>Encours</td>
                                <td><span class="text-success">GET</span></td>
                                <td><a href="https://app.africa-africred.com/api/encours" target="_blank">https://app.africa-africred.com/api/encours</a></td>
                            </tr>
                            <tr class="text-center">
                                <td>Marché</td>
                                <td><span class="text-success">GET</span>, <span class="text-primary">POST</span>, <span class="text-warning">PUT</span>, <span class="text-danger">DELETE</span></td>
                                <td><a href="https://app.africa-africred.com/api/marche" target="_blank">https://app.africa-africred.com/api/marche</a></td>
                            </tr>
                            <tr class="text-center">
                                <td>Recouvrement</td>
                                <td><span class="text-success">GET</span>, <span class="text-primary">POST</span>, <span class="text-warning">PUT</span>, <span class="text-danger">DELETE</span></td>
                                <td><a href="https://app.africa-africred.com/api/recouvrement" target="_blank">https://app.africa-africred.com/api/recouvrement</a></td>
                            </tr>
                        
                            
                        </tbody>
                        
                    </table>
                </div>
            </div>
           <div class="row mt-0 mb-4">
                <div class="col-4"></div>
                <div class="col-md-4 mt-4 text-center">
                   <b><script>document.write(new Date().getFullYear())</script> © AFRICRED</b> 
                </div>
                
                <div class="col-md-4 mt-5 ">
                   
                </div>
                
            </div>
    </div>

</div>


@include('layouts.script')


</body>
</html>