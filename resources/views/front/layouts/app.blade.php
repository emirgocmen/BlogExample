<!DOCTYPE html>
<html lang="tr">  
<head>
   @include('front.includes.header')
</head>
<body>

    @include('front.includes.navbar')

    @yield('content')

    @include('front.includes.footer')

</body>
</html>