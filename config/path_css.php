<?php
echo '<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>'. $PAGE_TITLE .'</title>
<link rel="shortcut icon" type="image/png" href="../assets/img/icon/favicon.ico">' . PHP_EOL;

$cssItem = array(
    'bootstrap.min.css',
    'bootstrap-datetimepicker.min.css',
    'dataTables.bootstrap4.min.css',
    'bootstrap-select.min.css',
    'animate.css',
    'themify-icons.css',
    'owl.carousel.min.css',
    'all.min.css',
    'metisMenu.min.css',
    'sweetalert2.min.css',
    'typography.css',
    'default.css',
    'login.css'
);

foreach ($cssItem as $cssPath) {
    echo '<link rel="stylesheet" href="' . ('../assets/css/' . $cssPath) . '">' . PHP_EOL;
}
echo '<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />';
echo '<script src="../assets/js/sweetalert2.all.min.js"></script>'.PHP_EOL;
echo '<script src="../assets/js/jquery-3.4.1.min.js"></script>'.PHP_EOL;
echo '<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>'.PHP_EOL;
echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>'.PHP_EOL;
echo '<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>'.PHP_EOL;
// echo '<script>$(window).resize(function(){drawChart();});</script>'.PHP_EOL;