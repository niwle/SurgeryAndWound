<?php
include("../config/autoload.php");
include("includes/session.inc.php");
include("includes/path.inc.php");
$current_link = htmlspecialchars($_SERVER["PHP_SELF"]);
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

if(isset($_GET['d'])){
    if(base64_decode($_GET['d']) == 'r'){
        $file = "../assets/sample/test_appointment_excel.xlsx";
        header('Content-disposition: attachment; filename='.$file);
        header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Length: ' . filesize($file));
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        ob_clean();
        flush(); 
        readfile($file);
        exit();
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
          
            // $resultemail = $conn->query("SELECT email FROM user_master;");
            // $emailexist = [];

            // while ($rowemail = $resultemail->fetch_assoc()){
            //     $emailexist [] = $rowemail['email'];
            // }


            $filePath =  basename($_FILES["upload"]["name"]);
            $target_dir = "temp/";
            $target_file = $target_dir . $filePath;

            if (move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file)) {
                $status = 1;
                $correctFiletype = true;
                if ($filePath  != '') {
                    // $allowed_extension = array('xls', 'xlsx', 'csv');
                    $allowed_extension = array('xlsx');
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
                        // $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
                        $reader = ReaderEntityFactory::createXLSXReader();
                        break;
                    // case 'xls':
                    //     $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xls');
                    //     break;
                }

               
                
                $reader->setShouldFormatDates(false);

                $reader->open($target_file);


                $generateTable = '<table  id="uploadTb" class="table table-striped " style="width:100%;"> <thead>';
                $errorRow = [];
                $errorEmailRow = [];
                $buildSQL = [];

                foreach ($reader->getSheetIterator() as $sheet) {
                    foreach ($sheet->getRowIterator() as $indexp => $row) { 
                        $generateTable .= '<tr>';
                        $value = $row->toArray();
                        $patient_id ="";
                        $doctor_id ="";
                        $description ="";
                        $apoinment_date ="";
                        $dateObj = "";

                        
                        foreach($value as $index => $val){
                            if(!empty($val)){
                                if ($val instanceof DateTime){
                                    $dateObj =  $val->format('Y-m-d H:i:s');
                                    $generateTable .= '<td>' . $dateObj . '</td>';
                                }else{
                                    $generateTable .= '<td>' . $val . '</td>';
                                }
    
                                switch ($index) {
                                    case 0: 
                                        $patient_id = $val;
                                        break;
                                    case 1: 
                                        $doctor_id = $val;
                                        break;
                                    case 2: 
                                        $description = $val;
                                        break;
                                    case 3: 
                                        $apoinment_date = $dateObj;
                                        break;
                                }
                            }
                        }
                        
                        $generateTable .= '</tr>';

                        if($indexp != 1){
                            $generateTable .= '</tr>';
                            array_push($buildSQL, array(
                                "patient_id" => $patient_id, 
                                "doctor_id" => $doctor_id, 
                                "description" => $description,
                                "apoinment_date" => $apoinment_date,
                            ));
                        }else{
                            
                            $generateTable .= '</tr></thead>';
                        }
                        
                    }
                }
                $generateTable .= '</table>';
                $reader->close();
                
            }
        }
        ?>

        <!-- Page content -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2>Please submit the (Appointment) Excel here </h2>
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
                            type: "appointmentUpload",
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
                window.location.href = "appointment-excel-add.php?d=<?= base64_encode('r') ?>";
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