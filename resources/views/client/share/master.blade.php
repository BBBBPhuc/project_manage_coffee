<!DOCTYPE html>
<html>
<head>
@include('client.share.css')

</head>

<body>
<div class="page-wrapper">
    @include('client.share.header')
	@yield('noi_dung')
    @include('client.share.footer')
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-arrow-up"></span></div>
    </div>
@include('client.share.js')
@yield('js')
</body>
</html>
