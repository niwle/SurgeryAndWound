<?php
include("../config/autoload.php");
include("includes/session.inc.php");
include("includes/path.inc.php");
$current_link = htmlspecialchars($_SERVER["PHP_SELF"]);

if(isset($_GET['d'])){
    if(base64_decode($_GET['d']) == 'd'){
        $file = "../assets/sample/test_excel.xlsx";
        header('Content-disposition: attachment; filename='.$file);
        header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Length: ' . filesize($file));
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        ob_clean();
        flush(); 
        readfile($file);
    }
}

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
        $errorEmail = false;

        if (isset($_POST['submit'])) {
          
            $resultemail = $conn->query("SELECT email FROM user_master;");
            $emailexist = [];

            while ($rowemail = $resultemail->fetch_assoc()){
                $emailexist [] = $rowemail['email'];
            }


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
                    // case 'csv':
                    //     $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Csv');
                    //     break;
                    case 'xlsx':
                        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
                        break;
                    // case 'xls':
                    //     $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xls');
                    //     break;
                }

                $reader->setReadDataOnly(TRUE);
                // $reader->setReadDataOnly(FALSE);
                $spreadsheet = $reader->load($target_file);
                $worksheet = $spreadsheet->getActiveSheet();
                $generateTable = '<table  id="uploadTb" class="table table-striped" table-responsive" style="width:100%;"> <thead>';
                $errorRow = [];
                $errorEmailRow = [];
                $buildSQL = [];

                foreach ($worksheet->getRowIterator() as $no => $row) {

                    $generateTable .= '<tr>';
                    $cellIterator = $row->getCellIterator();
                    $cellIterator->setIterateOnlyExistingCells(FALSE);
                    

                    $m_name = "";
                    $m_identity = "";
                    $m_gender = "";
                    $m_type = "";
                    $m_regis_id = "";
                    $m_dob = "";
                    $email = "";
                    $phone = "";
                    
                    

                    foreach ($cellIterator as $col => $cell) {
                        
                        if ($cell->getValue() == "") {
                            $generateTable .= '<td style="background-color:#FF0000">' . $cell->getValue() . '</td>'; //make user aware there is an empty column in the excel
                            $errorInexcel = true;
                            if (!in_array($no, $errorRow)) {
                                print_r($row);
                                array_push($errorRow, $no);
                            }
                        } else {
                            $generateTable .= '<td>' . $cell->getValue() . '</td>';

                            switch ($col) {
                                case 'A': //name
                                    $m_name = $cell->getValue();
                                    break;
                                case 'B': //type
                                    $m_type = $cell->getValue();
                                    break;
                                case 'C': //RegistrationID
                                    $m_regis_id = $cell->getValue();
                                    break;
                                case 'D': //Identification
                                    $m_identity = $cell->getValue();
                                    break;
                                // case 'E': //date of birth
                                //     $m_dob = date(($cell->getFormattedValue()));
                                //     // $value = $cell->getValue();
                                //     // $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($value);
                                //     // $excel_date = $date;
                                //     // $unix_date = ($excel_date - 25569) * 86400;
                                //     // $excel_date = 25569 + ($unix_date / 86400);
                                //     // $unix_date = ($excel_date - 25569) * 86400;
                                //     // $m_dob = gmdate("Y-m-d", $unix_date);
                                //     break;
                                case 'E': //Gender
                                    $m_gender = $cell->getValue();
                                    break;
                                case 'F': //Email
                                    $email = $cell->getValue();
                                    if (in_array($email, $emailexist)) {
                                        array_push($errorEmailRow, $no);
                                        $errorEmail = true;
                                    }
                                    break;
                                case 'G': //Phone
                                    $phone = $cell->getValue();
                                    break;
                            }
                        }
                    }
                    if ($no != 1) { // To ignore the header
                        array_push($buildSQL, array(
                            "m_name" => $m_name, 
                            "m_identity" => $m_identity, 
                            "m_type" => $m_type,
                            "m_regis_id" => $m_regis_id,
                            "m_gender" => $m_gender,
                            "email" => $email,
                            "phone" => $phone,
                            // "m_dob"=> strval($m_dob)
                        ));
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
                        <p class="text-muted">*Supported format (xlsx) only</p>
                        <p class="text-muted">*Please follow the format as shown on the sample excel</p>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="input-group mb-3">
                                <input type="file" name="upload" class="form-control" id="upload" required>
                                <label class="input-group-text" for="upload">Upload</label>
                            </div>
                            <div align='left'> 
                                <button type="submit" name="sample" class="btn btn-info">Download format Excel</button>
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body" style="overflow-x: auto;">
                        <!-- Datatable -->
                        <?php if ($correctFiletype && $status) : ?>
                            <br>
                            <?php if ($errorEmail) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <p class="text-danger">*Email already exist, check <b>excel</b> record on line (<?php echo implode(', ', $errorEmailRow) ?>)</p>
                                </div>
                            <?php endif ?>
                            <?php if ($errorInexcel) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <p class="text-danger">*Please check the <b>excel</b> file, there is some <b>excel</b> record missing on line (<?php echo implode(', ', $errorRow) ?>)</p>
                                </div>
                                
                            <?php endif ?>
                            <?php echo $generateTable ?>
                            <hr>
                            <div class="row">
                                <div class="col-12" align=right>
                                    <span name="clickUpload" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden></span>
                                    <button name="upDB" type="button" class="btn btn-warning" <?= ($errorEmail)? 'disabled' : '' ?>>Upload to database</button>
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
                           
                            Swal.fire({
                                title: 'Success',
                                text: "Successfully uploaded to Database",
                                icon: 'success',
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                window.location.href = window.location.href;
                            })
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            failUpload("Oh No, something went wrong");
                        }
                    });
                }

                $('span[name="clickUpload"]').attr("hidden", true);
                $('button[name="upDB"]').attr("disabled", false);
            });

            $('button[name="sample"]').click(function(e) {
                e.preventDefault();
                window.location.href = "admin-upload.php?d=<?= base64_encode('d') ?>";
            });

            function getBuildSQL (){
                info = `<?php if(isset($buildSQL)) echo json_encode($buildSQL); ?>`;
                // info = `<?php //echo ($buildSQL); ?>`;
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