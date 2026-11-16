
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Portfolio Admin')</title>

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>

    @yield('body')

    <script src="{{ asset('admin/js/admin.js') }}"></script>

</body>
</html>
