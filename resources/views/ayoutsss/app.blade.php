<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Title not found')</title>
</head>

<link rel="stylesheet" href="/css/bootstrap.min.css">
<link rel="stylesheet" href="@yield('customCSS', '')">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

<body>
    @include('Layouts.navbar')

    @yield('content')

    @yield('footer')

</body>
<script src="{{ asset('js/jquery-3.5.1.min.js')}}"></script>
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
<script src="{{ asset('js/popper.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script src="{{ asset('js/@yield('cutomJS')"></script>
    
<script>
    $(document).ready(function() {
        $(document).ready(function() {
    $('.select2').select2({
        placeholder: "  Choose some tags"
        }
    );
});
    });
</script>

</html>