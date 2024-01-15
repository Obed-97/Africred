     <!-- JAVASCRIPT -->
     <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
     <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
     <script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
     <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
     <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
     
     <script src="{{asset('assets/libs/select2/js/select2.min.js')}}"></script>
     <script src="{{asset('assets/js/pages/form-advanced.init.js')}}"></script>
    
     <!-- form mask -->
     <script src="{{asset('assets/libs/inputmask/jquery.inputmask.min.js')}}"></script>

     <!-- form mask init -->
     <script src="{{asset('assets/js/pages/form-mask.init.js')}}"></script>
     
     <!-- twitter-bootstrap-wizard js -->
    <script src="{{asset('assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}"></script>

    <script src="{{asset('assets/libs/twitter-bootstrap-wizard/prettify.js')}}"></script>

    <!-- form wizard init -->
    <script src="{{asset('assets/js/pages/form-wizard.init.js')}}"></script>
    

     <!-- Required datatable js -->
     <script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
     <script src="{{asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
     <!-- Buttons examples -->
     <script src="{{asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
     <script src="{{asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
     <script src="{{asset('assets/libs/jszip/jszip.min.js')}}"></script>
     <script src="{{asset('assets/libs/pdfmake/build/pdfmake.min.js')}}"></script>
     <script src="{{asset('assets/libs/pdfmake/build/vfs_fonts.js')}}"></script>
     <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
     <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
     <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>

     <script src="{{asset('assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
     <script src="{{asset('assets/libs/datatables.net-select/js/dataTables.select.min.js')}}"></script>
     
     <!-- Responsive examples -->
     <script src="{{asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
     <script src="{{asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

     <!-- Datatable init js -->
     <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>


     <script src="{{asset('assets/js/app.js')}}"></script>
     <script>
        $(document).ready(function(){
            $('input[type="radio"]').click(function(){
            	var demovalue = $(this).val(); 
                $("div.myDiv").hide();
                $("#show"+demovalue).show();
            });
        });
    </script>
    <script>
        function showMe(value) {
            if(value=="1"){
                document.getElementById('x').style.display="block";
                document.getElementById('y').style.display="none";
            }
            if(value=="2"){
                document.getElementById('x').style.display="none";
                document.getElementById('y').style.display="block";
            }
        }
    </script>
    
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function() {
            readURL(this);
        });
    </script>
    
    

