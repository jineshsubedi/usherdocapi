
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="{{asset('backend/assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('backend/assets/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" />
    <link href="{{asset('backend/assets/vendors/themify-icons/css/themify-icons.css')}}" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
    <link href="{{asset('backend/assets/vendors/jvectormap/jquery-jvectormap-2.0.3.css')}}" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="{{asset('backend/assets/css/main.min.css')}}" rel="stylesheet" />
	<link rel="shortcut icon" href="{{asset('frontend/favicon.ico')}}" type="image/x-icon" >
    <style>
        .tab-pane td:first-child {
        width: 160px;   
        }
        .tab-pane td:last-child {
        width: 80px;   
        }
        .tab-pane td:nth-child(2) {
        width: 600px;   
        max-width: 720px;
        overflow: auto;
        }
        p {
            word-break: break-word;
        }
    </style>
    @yield('styles')
    <!-- PAGE LEVEL STYLES-->
</head>