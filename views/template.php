<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sistema Boletas | Ugel Espinar</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Sistema de Boletas para la Ugel Espinar, consulte sus boletas aqui">
    <meta name="keywords" content="Sistema de boletas ugeles, ugel sistema boletas,boletas ugel espinar">
    <!-- Favicon icon -->
    <link rel="icon" href="views/images/favicon.png" type="image/x-icon">
    <!-- Google font--><link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="views/css/bootstrap.min.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="views/css/icofont.css">
    <!-- jpro forms css -->
    <link rel="stylesheet" type="text/css" href="views/css/j-pro-modern.css">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="views/css/feather.css">
    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css" href="views/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="views/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="views/css/responsive.bootstrap4.min.css">
    <!-- input file -->
    <link rel="stylesheet" type="text/css" href="views/css/input-file.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="views/css/style.css">
    <link rel="stylesheet" type="text/css" href="views/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="views/css/estilos.css">
    <!-- Sweet Alert -->
    <script src="views/js/sweetalert2@8.js"></script>
</head>

<body>
    <!--====== CONTENIDO DINAMICO ===========-->
    <?php
            $modulos = new EnlacesController();
            $modulos->enlacesControllers();
    ?> 
    <!--====  FIN CONTENIDO DINAMICO  ====-->   
    <!-- Required Jquery -->
    <script type="text/javascript" src="views/js/jquery.min.js"></script>
    <script type="text/javascript" src="views/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="views/js/popper.min.js"></script>
    <script type="text/javascript" src="views/js/bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="views/js/jquery.slimscroll.js"></script>
    <!-- Vue JS -->
    <script src="views/js/vue.js"></script>
    <script src="views/js/axios.min.js"></script>
    <script src="views/js/vue-scripts.js"></script>
    <!-- data-table js -->
    <script src="views/js/jquery.dataTables.min.js"></script>
    <script src="views/js/dataTables.buttons.min.js"></script>
    <script src="views/js/jszip.min.js"></script>
    <script src="views/js/pdfmake.min.js"></script>
    <script src="views/js/vfs_fonts.js"></script>
    <script src="views/js/buttons.print.min.js"></script>
    <script src="views/js/buttons.html5.min.js"></script>
    <script src="views/js/dataTables.bootstrap4.min.js"></script>
    <script src="views/js/dataTables.responsive.min.js"></script>
    <script src="views/js/responsive.bootstrap4.min.js"></script>
    <script src="views/js/data-table-custom.js"></script>
    <!-- input file -->
    <script src="views/js/input-file.min.js"></script>
    <script>
        new InputFile({
            // options
        });
    </script>
    <!-- JS page -->
    <script type="text/javascript" src="views/js/common-pages.js"></script>
    <script src="views/js/pcoded.min.js"></script>
    <script src="views/js/vartical-layout.min.js"></script>
    <script src="views/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Custom js -->
    <script src="views/js/script.js"></script>
</body>

</html>
