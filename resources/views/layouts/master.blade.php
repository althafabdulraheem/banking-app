<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">  
  <title>Banking App || {{ucfirst(request()->segments()[0])}}</title>
    <style>
        .header-menus{
            display: flex;
            justify-content: center;
            align-items: start;
            height: 17px;
        }

        .header-menus ul{
            display: flex;
            list-style: none;
            gap: 17px;
        }

        .header-title h1{
            font-size: 22px;
        padding: 10px;
        border-bottom: 2px solid #c5c1c147;
        color: #4c4b4be0;;

        }

        li a{
            font-size: 13px;
            text-decoration: none;
            color: grey;
            font-weight: 400;

        }

        .nav-active{
         
            border-bottom: 3px solid #0d80fe;
            padding-bottom: 13px;
        }

    </style>
    @yield('styles')
</head>
<body>
    @include('components.header')
    <div class="body-wrapper" style="background: #a1a1a117;height:100vh;margin-top: 20px;">
        @yield('content')
    </div>
    @yield('scripts')
</body>
</html>