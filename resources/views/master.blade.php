<!DOCTYPE html>
<html>
	<head>
		@include('layouts.head')
	</head>
	<body data-sidebar="dark">
        <!-- Loader -->
        <div id="preloader">
            <div id="status">
                <div class="spinner">
                    <i class="ri-loader-line spin-icon"></i>
                </div>
            </div>
        </div>
        
        @include('layouts.header')

		@include('layouts.left_sidebar')

		@yield('content')

		@include('layouts.footer')
		
	    @include('layouts.right_sidebar')

		@include('layouts.script')


	</body>
</html>