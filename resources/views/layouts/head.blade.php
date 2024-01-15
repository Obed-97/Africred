<head>
        
    <meta charset="utf-8" />
    <title>AFRICRED | @yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Micro-finance de Crédit" name="description" />
    <!-- App favicon -->
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}">
    
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
    
    <!-- twitter-bootstrap-wizard css -->
    <link rel="stylesheet" href="{{asset('assets/libs/twitter-bootstrap-wizard/prettify.css')}}">
    
   


    <style>

        @media only screen

        and (min-device-width : 280px)

        and (max-device-width : 820px){  #web{display: none; }}
        
        
        @media only screen

        and (min-device-width : 1024px)

        and (max-device-width : 1920px){  #phone{display: none;}}

        .myDiv{
        	display:none;
           
        }
        
        .flip-card {
          background-color: transparent;
          width: 240px;
          height: 154px;
          perspective: 1000px;
         
        }
        
        .heading {
          position: absolute;
          letter-spacing: .2em;
          font-size: 7px;
          top: 2em;
          left: 18.6em;
        }
        
        .logos {
          position: absolute;
          top: 6.8em;
          left: 11.7em;
        }
        
        .chip {
          position: absolute;
          top: 2.3em;
          left: 1.5em;
        }
        
        .contactless {
          position: absolute;
          top: 3.5em;
          left: 12.4em;
        }
        
        .number {
          position: absolute;
          font-weight: bold;
          font-size: 10px;
          top: 7.3em;
          left: 2em;
        }
        
        .valid_thru {
          position: absolute;
          font-weight: bold;
          top: 635.8em;
          font-size: 5em;
          left: 140.3em;
        }
        
        .date {
          position: absolute;
          font-weight: bold;
          font-size: 0.5em;
          top: 13.6em;
          left: 3.2em;
        }
        
        .name {
          position: absolute;
         
          font-size: 10px;
          top: 12.1em;
          left: 2em;
        }
        
        .strip {
          position: absolute;
          background-color: black;
          width: 15em;
          height: 1.5em;
          top: 2.4em;
          background: repeating-linear-gradient(
            45deg,
            #303030,
            #303030 10px,
            #202020 10px,
            #202020 20px
          );
        }
        
        .mstrip {
          position: absolute;
          background-color: rgb(255, 255, 255);
          width: 8em;
          height: 0.8em;
          top: 5em;
          left: .8em;
          border-radius: 2.5px;
        }
        
        .sstrip {
          position: absolute;
          background-color: rgb(255, 255, 255);
          width: 4.1em;
          height: 0.8em;
          top: 5em;
          left: 10em;
          border-radius: 2.5px;
        }
        
        .code {
          font-weight: bold;
          text-align: center;
          margin: .2em;
          color: black;
        }
        
        .flip-card-inner {
          position: relative;
          width: 100%;
          height: 100%;
          text-align: center;
          transition: transform 0.8s;
          transform-style: preserve-3d;
        }
        
        .flip-card:hover .flip-card-inner {
          transform: rotateY(180deg);
        }
        
        .flip-card-front, .flip-card-back {
          box-shadow: 0 8px 14px 0 rgba(0,0,0,0.2);
          position: absolute;
          display: flex;
          flex-direction: column;
          justify-content: center;
          width: 100%;
          height: 100%;
          -webkit-backface-visibility: hidden;
          backface-visibility: hidden;
          border-radius: 1rem;
        }
        
        .flip-card-front {
          box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 2px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -1px 0px inset;
          background-color: #171717;
        }
        
        .flip-card-back {
          box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 2px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -1px 0px inset;
          background-color: #171717;
          transform: rotateY(180deg);
        }
        
        

         .avatar-upload {
        	 position: relative;
        	 max-width: 205px;
        	 margin: 5px auto;
        }
         .avatar-upload .avatar-edit {
        	 position: absolute;
        	 right: 12px;
        	 z-index: 1;
        	 top: 10px;
        }
         .avatar-upload .avatar-edit input {
        	 display: none;
        }
         .avatar-upload .avatar-edit input + label {
        	 display: inline-block;
        	 width: 34px;
        	 height: 34px;
        	 margin-bottom: 0;
        	 border-radius: 100%;
        	 background: #FFFFFF;
        	 border: 1px solid transparent;
        	 box-shadow: 0px 2px 4px 0px rgba(0,0,0,0.12);
        	 cursor: pointer;
        	 font-weight: normal;
        	 transition: all .2s ease-in-out;
        }
         .avatar-upload .avatar-edit input + label:hover {
        	 background: #f1f1f1;
        	 border-color: #d6d6d6;
        }
         .avatar-upload .avatar-edit input + label:after {
        	 content: "\f040";
        	 font-family: 'FontAwesome';
        	 color: #757575;
        	 position: absolute;
        	 top: 10px;
        	 left: 0;
        	 right: 0;
        	 text-align: center;
        	 margin: auto;
        }
         .avatar-upload .avatar-preview {
        	 width: 192px;
        	 height: 192px;
        	 position: relative;
        	 border-radius: 100%;
        	 border: 6px solid #F8F8F8;
        	 box-shadow: 0px 2px 4px 0px rgba(0,0,0,0.1);
        }
         .avatar-upload .avatar-preview > div {
        	 width: 100%;
        	 height: 100%;
        	 border-radius: 100%;
        	 background-size: cover;
        	 background-repeat: no-repeat;
        	 background-position: center;
        }
 
        
        
        body{margin-top:20px;
       
        }
        
        .card {
            box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
        }
        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0,0,0,.125);
            
        }
               
    </style>
    
    
        
       

    

</head>