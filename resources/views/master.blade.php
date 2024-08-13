<!DOCTYPE html>
<html>
	<head>
		@include('layouts.head')
	</head>
	<body  data-keep-enlarged="true" class="vertical-collpsed">
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
        @include('layouts.header')

		@include('layouts.left_sidebar')

		@yield('content')

		@yield('extra-js')

		@include('layouts.footer')

		@include('layouts.script')

		@include('sweetalert::alert')

		@yield('scripts')

		@yield('historique_scripts')

		@yield('credit_scripts')

	</body>
</html>
