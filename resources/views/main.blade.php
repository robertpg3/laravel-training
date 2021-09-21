<!DOCTYPE html>
<html lang="en">
<head>
    <title>Internship</title>
    <link rel="stylesheet"
          href="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-1.11.0/b-2.0.0/sl-1.3.3/datatables.min.css"/>
    <link rel="stylesheet" href="{{asset('/editor/css/editor.dataTables.css')}}">
    <link rel="stylesheet" href="{{asset('/css/app.css')}}">
    @yield('additional-css')
</head>
<body class="mainContainer">
@yield('content')

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-1.11.0/b-2.0.0/sl-1.3.3/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
<script src="{{asset('editor/js/dataTables.editor.js')}}"></script>

<script src="{{asset('js/shop.js')}}"></script>
@yield('additional-scripts')
</body>
</html>
