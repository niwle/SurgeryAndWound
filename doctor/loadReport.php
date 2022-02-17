<?php
include('../config/autoload.php');

$datefrom = $_POST['datefrom'];
$dateto = $_POST['dateto'];
$id = $_POST['id'];

if (!empty($datefrom) && !empty($dateto)) {
    // $stmt = $conn->prepare("SELECT * FROM appointment, patients WHERE appointment.patient_id = patients.patient_id AND appointment.doctor_id = ? AND appointment.app_date BETWEEN ? AND ? ");
    // $stmt->bind_param("sss", $id, $datefrom, $dateto);

    $stmt = $conn->prepare("SELECT * FROM user_master");
    // $stmt->bind_param("sss", $id, $datefrom, $dateto);


    

    if ($stmt->execute()) {
?>
        <div class="result-page">
            <div class="action-btn-group">
                <!-- <button type="button" class="btn btn-primary btn-sm px-5" onClick="download();" name="downloadbtn" download><i class="fas fa-download"></i> Download as PDF</button> -->
                <button type="button" class="btn btn-primary btn-sm px-5" onClick="print();" name="printbtn"><i class="fas fa-print"></i> Print</button>
            </div>

            <div id="printContent">
                <div class="card">
                    <div class="card-body">
                        <table class="table" style="width: 100%" border="1">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result = $stmt->get_result();
                                if ($result->num_rows === 0) exit('No result');
                                while ($row = $result->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <th><?= $row['m_id'] ?></th>
                                        <td><?= $row['m_name'] ?></th>
                                        
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
<?php
    } else {
        echo "<script>Swal.fire({title: 'Error!', text: 'No Record Found', type: 'error', confirmButtonText: 'Try Again'})</script>";
    }
    $stmt->close();
}
?>