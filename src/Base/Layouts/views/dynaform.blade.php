<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <script>
            var structure = JSON.parse('{!! $structure !!}');
        </script>
    </head>
    <body>
        <div id="app"></div>
        <script src="/lib/js/build.js"></script>
    </body>
</html>
