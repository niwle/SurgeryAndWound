<?php

if (isset($_POST['export'])) {
    include_once("excel.php");
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Export Excel</title>
</head>

<body>
    <div class="container">
        <h2>Please submit the details here </h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="input-group mb-3">
                <div id="reportrange" name="export_date" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                    <i class="fa fa-calendar"></i>&nbsp;
                    <span></span> <i class="fa fa-caret-down"></i>
                </div>
            </div>

            <div class="input-group mb-3">
                <input type="radio" value="1" name="flag" class="media_option" autocomplete="off">&nbsp;Active User (User with flag = 1) &nbsp;
                <input type="radio" value="0" name="flag" class="media_option" autocomplete="off">&nbsp;Inactive User (User with flag = 0)&nbsp;
                <input type="radio" value="" name="flag" class="media_option" autocomplete="off" checked>&nbsp;All&nbsp;

            </div>
            <input type="text" id="expStartDate" name="expStartDate" value="" hidden>
            <input type="text" id="expEndDate" name="expEndDate" value="" hidden>
            <button name="export" type="submit" class="btn btn-warning">Export</button>
        </form>
        <hr>
    </div>

    <!-- DataTables -->
    <script>
        $(document).ready(function() {
            $('#uploadTb').DataTable();
        });
    </script>
</body>

</html>