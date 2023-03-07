<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            @yield('titulo')
        </title>
        <style>
            body, hr, pre{
                background-color: #22252a!important;
                color: #42aedb!important;
                border-color: #42aedb!important;
            }
        </style>
        <!-- boostrap (via CDN) -->
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> -->
        <!-- boostrap (via LOCAL) -->
        <link href={{ asset('./css/bootstrap.min.css') }} rel="stylesheet">
        <!-- fontawesome -->
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <!-- css -->
        <link href= {{ asset('./css/main.css') }} rel="stylesheet">
        <!-- favicon -->
        <link rel="shortcut icon" href= {{ asset('./images/favicon.jpg') }} type="image/jpg">
    </head>
    <body>

        <div class="container-fluid pt-3 pb-3 text-center">
            <!-- cabeçalho e navegação -->
            @include('layout/cabecalho')

            <!-- conteúdo -->
            @yield('conteudo')

            <!-- rodapé -->
            @include('layout/rodape')
        </div>

        <!-- bootstrap js (via CDN) -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    </body>
</html>
