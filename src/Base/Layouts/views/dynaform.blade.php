<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8">
    <title>NextForm-></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
</head>

<body>
<div class="container" id="app">
    <div class="panel panel-default">
        <div class="panel-body">
            <next-form :schema="schema" :model="model" :options="formOptions"></next-form>
        </div>
    </div>
</div>
<input type="hidden" name="structure" id="structure" value='{!! $structure !!}'>
<input type="hidden" name="data" id="data" value='{!! $data !!}'>
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
<script type="text/javascript" src="/lib/js/next-form.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/lib/js/main.js"></script>
<script>
    var structure = JSON.parse($('#structure').val());
    var data = JSON.parse($('#data').val());
</script>
</body>
</html>