<!DOCTYPE html>
<html>
	<head>
		@include('layouts.head')
	</head>
	<body>

        @include('layouts.header')

		@include('layouts.left_sidebar')

		@yield('content')

		@include('layouts.footer')

		@include('layouts.script')


	</body>
</html>