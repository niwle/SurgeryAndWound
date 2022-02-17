<?php

$jsItem = array(
    // 'jquery-3.4.1.min.js',
    'bootstrap.bundle.min.js',
    'moment.min.js',
    'bootstrap-datetimepicker.min.js',
    'bootstrap-select.min.js',
    'jquery.dataTables.min.js',
    'dataTables.bootstrap4.min.js',
    'metismenu.js',
    'owl.carousel.min.js',
    'popper.min.js',
    'scripts.js'
);

foreach ($jsItem as $jsPath) {
    echo '<script src="' . ('../assets/js/' . $jsPath) . '"></script>' . PHP_EOL;
}



// echo "<script>
// function successUpload(text) {
//     Swal.fire({
//         title: 'Success',
//         text: text,
//         icon: 'success',
//         confirmButtonText: 'Okay'
//     }).then(()=>{
//         window.location.href = window.location.href
//     })
// }
// </script>". PHP_EOL;

// echo "<script>
// function failUpload(text) {
//     Swal.fire({
//         title: 'Fail',
//         text: text,
//         icon: 'error',
//         confirmButtonText: 'Okay'
//     })
// }

// </script>". PHP_EOL;
