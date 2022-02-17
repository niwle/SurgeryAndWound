<?php
include("../config/autoload.php");
include("includes/session.inc.php");
include("includes/path.inc.php");
$current_link = htmlspecialchars($_SERVER["PHP_SELF"]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include CSS_PATH; ?>
</head>

<body>
    <?php include NAVIGATION; ?>
    <!-- Page content holder -->
    <div class="page-content" id="content">
        <?php include HEADER; ?>
        <!-- PHP Code -->
        <?php
        $correctFiletype = false;
        $errorInexcel = false;

        if (isset($_POST['submit'])) {
            $filePath =  basename($_FILES["upload"]["name"]);
            $target_dir = "temp/";
            $target_file = $target_dir . $filePath;

            if (move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file)) {
                $status = 1;
                $correctFiletype = true;
                if ($filePath  != '') {
                    $allowed_extension = array('xls', 'xlsx', 'csv');
                    $file_array = explode(".", $filePath);
                    $file_extension = end($file_array);
                    if (!in_array($file_extension, $allowed_extension)) {
                        $correctFiletype = false;
                    }
                }
            } else {
                $status = 0;
            }


            if ($correctFiletype && $status) {

                switch ($file_extension) {
                    case 'csv':
                        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Csv');
                        break;
                    case 'xlsx':
                        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
                        break;
                    case 'xls':
                        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xls');
                        break;
                }

                $reader->setReadDataOnly(TRUE);
                $spreadsheet = $reader->load($target_file);
                $worksheet = $spreadsheet->getActiveSheet();
                $generateTable = '<table  id="uploadTb" class="table table-striped" table-responsive" style="width:100%;"> <thead>';
                $errorRow = [];
                $buildSQL = [];

                foreach ($worksheet->getRowIterator() as $no => $row) {

                    $generateTable .= '<tr>';
                    $cellIterator = $row->getCellIterator();
                    $cellIterator->setIterateOnlyExistingCells(FALSE);
                    $m_name = "";
                    $m_ic = "";
                    $m_type = "";
                    $m_gender = "";
                    $password = "";
                    // date_default_timezone_set("Asia/Kuala_Lumpur");
                    // $created_at = date('Y-m-d H:i:s');

                    foreach ($cellIterator as $col => $cell) {
                        if ($cell->getValue() == "") {
                            $generateTable .= '<td style="background-color:#FF0000">' . $cell->getValue() . '</td>'; //make user aware there is an empty column in the excel
                            $errorInexcel = true;
                            if (!in_array($no, $errorRow)) {
                                array_push($errorRow, $no);
                            }
                        } else {
                            $generateTable .= '<td>' . $cell->getValue() . '</td>';

                            switch ($col) {
                                case 'A':
                                    $m_type = $cell->getValue();
                                    break;
                                    // case 'B':
                                    //     $m_name = $cell->getValue();
                                    //     break;
                                case 'C':
                                    $m_ic = $cell->getValue();
                                    break;
                                case 'D':
                                    $m_name = $cell->getValue();
                                    break;
                                case 'E':
                                    $m_gender = $cell->getValue();
                                    break;
                            }
                        }
                    }
                    if ($no != 1) { // To ignore the header
                        array_push($buildSQL, array("m_name" => $m_name, "m_ic" => $m_ic, "m_type" => $m_type));
                    }
                    $generateTable .= '</tr>';
                    if ($no == 1) {
                        $generateTable .= '</thead>';
                    }
                }
                $generateTable .= '</tbody></table>';
               
            }
        }
        ?>

        <!-- Page content -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2>Please submit the Excel here </h2>
                        <p class="text-muted">*Supported format (xls, xlsx, csv)</p>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="input-group mb-3">
                                <input type="file" name="upload" class="form-control" id="upload">
                                <label class="input-group-text" for="upload">Upload</label>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body" style="overflow-x: auto;">
                        <!-- Datatable -->
                        <?php if ($correctFiletype && $status) : ?>
                            <br>
                            <?php if ($errorInexcel) : ?>
                                <p class="text-danger">*Please check the excel file, there is some record missing on line (<?php echo implode(', ', $errorRow) ?>)</p>
                            <?php endif ?>
                            <?php echo $generateTable ?>
                            <hr>
                            <div class="row">
                                <div class="col-12" align=right>
                                    <span name="clickUpload" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden></span>
                                    <button name="upDB" type="button" class="btn btn-warning">Upload to database</button>
                                </div>
                            </div>
                        <?php endif ?>
                        <!-- End Datatable -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Content -->
    </div>
    <?php include JS_PATH; ?>
    <script>
            var info = "";
            $('button[name="upDB"]').click(function(e) {

                e.preventDefault();
                $('span[name="clickUpload"]').attr("hidden", false);
                $('button[name="upDB"]').attr("disabled", true);

                var response = confirm("Are u sure?");
                if (response) {
                    console.info(info);
                    $.ajax({
                        url: "includes/adm_conn.php",
                        type: "POST",
                        data: {
                            type: "adminUpload",
                            info: getBuildSQL (),
                        },
                        cache: false,
                        success: function(response) {
                            console.log(response);
                            successUpload("Successfully uploaded to Database");
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            failUpload("Oh No, something went wrong");
                        }
                    });
                }

                $('span[name="clickUpload"]').attr("hidden", true);
                $('button[name="upDB"]').attr("disabled", false);
            });

            function getBuildSQL (){
                info = `<?php echo json_encode($buildSQL); ?>`;
                
                
                return info;
            }
    </script>

    <!-- DataTables -->
    <script>
        $(document).ready(function() {
            $('#uploadTb').DataTable();
        });
    </script>
</body>

</html>