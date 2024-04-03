<!doctype html>
<html lang="en">

<head>
    @include('admin.shares.css')
</head>

<body>
	<div class="wrapper">
	  <div class="header-wrapper">
        @include('admin.shares.header')
		@include('admin.shares.menu')
	   </div>
		<div class="page-wrapper">
			<div class="page-content">
                @yield('noi_dung')
            </div>
		</div>
		<div class="overlay toggle-icon"></div>
		<a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		@include('admin.shares.footer')
	</div>
    @include('admin.shares.color')
    @include('admin.shares.js')
    @yield('js')
</body>

</html>
