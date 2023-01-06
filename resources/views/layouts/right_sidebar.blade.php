<!-- Right Sidebar -->
<div class="right-bar">
    <div data-simplebar class="h-100">
        <div class="rightbar-title px-3 py-4">
            <a href="javascript:void(0);" class="right-bar-toggle float-right">
                <i class="mdi mdi-close noti-icon"></i>
            </a>
            <h5 class="m-0">Paramètres</h5>
        </div>

        <!-- Settings -->
        <hr class="mt-0" />
        <h6 class="text-center mb-0"> Mode d'affichage</h6>

        <div class="p-4">
            <div class="mb-2">
                <img src="{{asset('assets/images/claire.png')}}" class="img-fluid img-thumbnail" alt="">
            </div>
            <div class="custom-control custom-switch mb-3">
                <input type="checkbox" class="custom-control-input theme-choice" id="light-mode-switch" checked />
                <label class="custom-control-label" for="light-mode-switch"> Mode clair</label>
            </div>
    
            <div class="mb-2">
                <img src="{{asset('assets/images/sombre.png')}}" class="img-fluid img-thumbnail" alt="">
            </div>
            <div class="custom-control custom-switch mb-3">
                <input type="checkbox" class="custom-control-input theme-choice" id="dark-mode-switch" data-bsStyle="assets/css/bootstrap-dark.min.css" data-appStyle="assets/css/app-dark.min.css" />
                <label class="custom-control-label" for="dark-mode-switch">Mode sombre</label>
            </div>
     
        </div>

    </div> <!-- end slimscroll-menu-->
</div>
<!-- /Right-bar -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>