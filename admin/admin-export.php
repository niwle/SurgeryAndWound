<?php
include("../config/autoload.php");
include("includes/session.inc.php");
include("includes/path.inc.php");
$current_link = htmlspecialchars($_SERVER["PHP_SELF"]);
include CSS_PATH;
if (isset($_POST['export'])) {
    include_once("excel.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    
</head>

<body>
    <?php include NAVIGATION; ?>
    <!-- Page content holder -->
    <div class="page-content" id="content">
        <?php include HEADER; ?>
        <!-- Page content -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5>Select Criteria:</h5>
                        <hr>
                        <br>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label for="inputBusinessHourWeek" class="col-sm-2 col-form-label">Choose date:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control form-control timepicker" name="expStartDate">
                                </div><span>--</span>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control form-control timepicker" name="expEndDate">
                                </div>
                            </div>

                            <br>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Choose user status:</label>
                                <div class="row">
                                    <div class="col">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="inputActiveUser" name="flag" class="custom-control-input media_option" value="1">
                                            <label class="custom-control-label" for="inputActiveUser">Active User</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="inputInactiveUser" name="flag" class="custom-control-input media_option" value="0">
                                            <label class="custom-control-label" for="inputInactiveUser">Inactive user</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="inputAllUser" name="flag" class="custom-control-input media_option" value="" checked>
                                            <label class="custom-control-label" for="inputAllUser">All</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Choose user type:</label>
                                <div class="row">
                                    <div class="col">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="inputDoctor" name="m_type" class="custom-control-input type_option" value="d">
                                            <label class="custom-control-label" for="inputDoctor">Doctor</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="inputPatient" name="m_type" class="custom-control-input type_option" value="p">
                                            <label class="custom-control-label" for="inputPatient">Patient</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="inputResearch" name="m_type" class="custom-control-input type_option" value="r">
                                            <label class="custom-control-label" for="inputResearch">Research Team</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="inputAll" name="m_type" class="custom-control-input type_option" value="" checked>
                                            <label class="custom-control-label" for="inputAll">All</label>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <br>
                           <div >
                               <button name="export" type="submit" class="btn btn-primary btn-block">Export</button>
                           </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
        <!-- End Page Content -->
    </div>
    <?php include JS_PATH; ?>
    <script>
		$(function() {
			$('.timepicker').datetimepicker({
				format: 'YYYY-MM-DD'
			});
		});
	</script>
</body>

</html>