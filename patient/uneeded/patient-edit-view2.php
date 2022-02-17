<?php

$enc = base64_encode($_SESSION['userID']);
// $entryID = $_GET['f'];
$entryID = 52;
$sql = "SELECT * FROM progress_book_entry WHERE entryID = $entryID;";
$result = $db->query($sql);

if (($result->num_rows) == 0) {
    $status = "no data"; //meaning no existing data    
}
$row = $result->fetch_assoc();
$imglocation = $row['progressImage'];
$masterUserID = $row['masterUserid_fk'];
$fulllocation = ("$default_location/modules/Patient/img/$masterUserID/$imglocation");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View</title>
</head>

<body>
    <div class="container">
        <h1>Patient HomePage (View)</h1>
        <div style="margin-bottom: 50px;"></div>
        <form class="row g-3 form_wrap_shadow" enctype="multipart/form-data">

            <div class="col-md-6">
                <div id="imgwidth" class="col-md-12 fw-bold">
                    <p>View Details:</p>

                </div>
                <div class="pt-1" align='left'>
                    <img id="not_modal" data-bs-toggle="modal" name="bsmd" data-bs-target="#exampleModal" style="cursor: pointer;" class="outImg" alt="your image" />
                </div>
                <div class="col-md-12" align='left'>

                    <!-- Button trigger modal -->
                    <p data-bs-toggle="modal" name="bsmd" data-bs-target="#exampleModal" style="cursor: pointer;" hidden>
                        Preview Image
                    </p>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Image Preview</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="overflow: auto;" align="center">
                                    <img class="outImg" alt="your image" style="width: 1000px; height: auto" />
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>

                    <div class="col-md-12 py-1">
                        <div class="form-outline">
                            <input type="text" id="form12" class="form-control" name="title" value="<?php echo $row['progressTitle'] ?>" />
                            <label class="form-label" for="form12">Title</label>
                        </div>
                    </div>

                    <div class="col-md-12 py-1">
                        <div class="form-outline">
                            <textarea class="form-control" name="comment" id="textAreaExample" rows="2"><?php echo $row['progressDescription'] ?></textarea>
                            <label class="form-label" for="textAreaExample">Description</label>
                        </div>
                    </div>

                    <div class="col-md-12 py-2">
                        <div class="row fw-bold">
                            <div class="col-1 ">
                                1.
                            </div>
                            <div class="col-11 ">
                                Did fluid drain from wound?
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-1 ">
                            </div>
                            <div class="col-11 ">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="fluidwound" id="fwyes" value="Yes" <?php if ($row['quesFluid'] == 'Yes') echo "checked" ?> />
                                    <label class="form-check-label text-capitalize" for="inlineRadio1">Yes</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="fluidwound" id="fwno" value="No" <?php if ($row['quesFluid'] == 'No') echo "checked" ?> />
                                    <label class="form-check-label text-capitalize" for="inlineRadio2">No</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="fluidwound" id="fwnotsure" value="Not Sure" <?php if ($row['quesFluid'] == 'Not Sure') echo "checked" ?> />
                                    <label class="form-check-label text-capitalize" for="inlineRadio3">Not Sure</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 py-2">
                        <div class="row fw-bold">
                            <div class="col-1 ">
                                2.
                            </div>
                            <div class="col-11 ">
                                Rate your pain
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-1 ">
                            </div>
                            <div class="col-11 ">
                                <div class="range">
                                    <input type="range" class="form-range" min="0" step="0.5" max="5" value="<?php echo $row['quesPain'] ?>" id="customRange2" name="quespain" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 py-2">
                        <div class="row fw-bold">
                            <div class="col-1 ">
                                3.
                            </div>
                            <div class="col-11 ">
                                Is there any redness around the wound?
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-1 ">
                            </div>
                            <div class="col-11 ">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="redwound" id="rwworse" value="worse" <?php if ($row['quesRedness'] == 'worse') echo "checked" ?> />
                                    <label class="form-check-label text-capitalize" for="inlineRadio1">Worse</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="redwound" id="rwsome" value="some" <?php if ($row['quesRedness'] == 'some') echo "checked" ?> />
                                    <label class="form-check-label text-capitalize" for="inlineRadio2">Some</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="redwound" id="rwbetter" value="better" <?php if ($row['quesRedness'] == 'better') echo "checked" ?> />
                                    <label class="form-check-label text-capitalize" for="inlineRadio3">better</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="redwound" id="rwunsure" value="unsure" <?php if ($row['quesRedness'] == 'unsure') echo "checked" ?> />
                                    <label class="form-check-label text-capitalize" for="inlineRadio3">unsure</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="redwound" id="rwnone" value="none" <?php if ($row['quesRedness'] == 'none') echo "checked" ?> />
                                    <label class="form-check-label text-capitalize" for="inlineRadio3">none</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 py-2">
                        <div class="row fw-bold">
                            <div class="col-1 ">
                                4.
                            </div>
                            <div class="col-11 ">
                                Is there any swelling?
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-1 ">
                            </div>
                            <div class="col-11 ">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="swellwound" id="swworse" value="worse" <?php if ($row['quesSwelling'] == 'worse') echo "checked" ?> />
                                    <label class="form-check-label text-capitalize" for="inlineRadio1">Worse</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="swellwound" id="swsome" value="some" <?php if ($row['quesSwelling'] == 'some') echo "checked" ?> />
                                    <label class="form-check-label text-capitalize" for="inlineRadio2">Some</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="swellwound" id="swbetter" value="better" <?php if ($row['quesSwelling'] == 'better') echo "checked" ?> />
                                    <label class="form-check-label text-capitalize" for="inlineRadio3">better</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="swellwound" id="swunsure" value="unsure" <?php if ($row['quesSwelling'] == 'unsure') echo "checked" ?> />
                                    <label class="form-check-label text-capitalize" for="inlineRadio3">unsure</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="swellwound" id="swnone" value="none" <?php if ($row['quesSwelling'] == 'none') echo "checked" ?> />
                                    <label class="form-check-label text-capitalize" for="inlineRadio3">none</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 py-2">
                        <div class="row fw-bold">
                            <div class="col-1 ">
                                5.
                            </div>
                            <div class="col-11 ">
                                Is there any odour from the wound?
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-1 ">
                            </div>
                            <div class="col-11 ">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="odourwound" id="owyes" value="Yes" <?php if ($row['quesOdour'] == 'Yes') echo "checked" ?> />
                                    <label class="form-check-label text-capitalize" for="inlineRadio1">Yes</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="odourwound" id="owno" value="No" <?php if ($row['quesOdour'] == 'No') echo "checked" ?> />
                                    <label class="form-check-label text-capitalize" for="inlineRadio2">No</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="odourwound" id="ownotsure" value="Not Sure" <?php if ($row['quesOdour'] == 'Not Sure') echo "checked" ?> />
                                    <label class="form-check-label text-capitalize" for="inlineRadio3">Not Sure</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 py-2">
                        <div class="row fw-bold">
                            <div class="col-1 ">
                                6.
                            </div>
                            <div class="col-11 ">
                                Do you have fever?
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-1 ">
                            </div>
                            <div class="col-11 ">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="fever" id="owno" value="No" <?php if ($row['quesFever'] == 'No') echo "checked" ?> />
                                    <label class="form-check-label text-capitalize" for="inlineRadio2">No</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="fever" id="owyes" value="Yes" <?php if ($row['quesFever'] == 'Yes') echo "checked" ?> />
                                    <label class="form-check-label text-capitalize" for="inlineRadio1">Yes</label>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-12 pt-3" align='right'>
                        <div class="btn-group">
                            <button type="button" class="btn btn-warning" data-mdb-toggle="dropdown" aria-expanded="false">
                                Action <i class="fas fa-caret-down"></i><span name="clickUpload" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden></span>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><button type="button" name="upd_img" class="dropdown-item"> Update</button></li>
                                <li><button type="button" name="ar_img" class="dropdown-item"> Archive</button></li>
                                <li><button type="button" name="de_img" class="dropdown-item"> Delete</button></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-6" id="imgheight" style="border-left: solid 1px grey;">
                <div align='center'>
                    <h3>Doctor's Feedback</h3>
                </div>

                <div id="doctor_feedback_box">
                    <?php
                    while (true) : ?>
                        <div class="doctor_feedback_comment_box">
                            <div class="comment_title">
                                continue here
                            </div>
                            <div class="comment_description">

                            </div>
                        </div>
                    <?php break;
                    endwhile ?>
                </div>
            </div>
        </form>
    </div>
    <script>
        // var $winW = $('#imgWidth').width();
        // $('img').width($winW - 100);

        $(".ipimg").change(function(e) {
            e.preventDefault();

            $('p[name="bsmd"]').attr("hidden", false);
            console.log(this.files);

            $(".outImg").attr("src", window.URL.createObjectURL(this.files[0]));
            // $('#outImg1').src = window.URL.createObjectURL(this.files[0]);

        });

        /* Start Image Resize Code */
        function image_resize() {
            $("img#not_modal").each(function() {
                /* Current image width */
                var width = $('#imgwidth').width() - 95;

                /* Current image height */
                var height = $('#imgheight').height() - 95;

                // ratio = (maxWidth / width);
                /* Set New hieght and width of Image */
                $(this).attr({
                    // height: auto,
                    width: (width),
                    alt: "Your uploaded image will display here"
                });

                console.log("height: " + height);
                console.log("width: " + width);
            });

        }
        /* End Image Resize Code */



        /* How to use with DOM Ready */
        $(document).ready(function() {
            $(".outImg").attr("src", ("<?php echo $fulllocation ?>"));
            $('p[name="bsmd"]').attr("hidden", false);
            image_resize();
            $('form *').prop("disabled", true);


        });


        $('form').on('submit', function(e) {
            e.preventDefault();
            var response = confirm("Are u sure?");
            if (response) {
                var myform = $('form');
                var fd = new FormData(myform[0]);
                fd.append('type', '1entUpload');
                fd.append('tgt', "<?php echo $enc ?>");

                $.ajax({
                    url: "Patient/includes/1ent_conn.php",
                    type: "POST",
                    data: fd,
                    // dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $('span[name="clickUpload"]').attr("hidden", false);
                        $('button[name="upimg"]').attr("disabled", true);
                    },
                    success: function(response) {
                        $('span[name="clickUpload"]').attr("hidden", true);
                        $('button[name="upimg"]').attr("disabled", false);
                        console.log(response);
                        successUpload("Succesfully uploaded");
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(errorThrown);
                        console.log(textStatus);
                        failUpload("Oh no, something went wrong");
                    }
                });
            }

        });
    </script>
</body>

</html>