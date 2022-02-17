<?php
$user_id = $_SESSION['userID'];
$enc = base64_encode($user_id);
$entryID = $_GET['f'];
$sql = "SELECT * FROM progress_book_entry WHERE entryID = $entryID;";
$result = $db->query($sql);

if (($result->num_rows) == 0) {
    $status = "no data"; //meaning no existing data    
}
$row = $result->fetch_assoc();
$imglocation = $row['progressImage'];
$fulllocation = ("$default_location/modules/Patient/img/$user_id/$imglocation");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
</head>

<body>

    <div class="container">
        <h1>Patient (Edit Record)</h1>
        <div style="margin-bottom: 50px;"></div>
        <form class="row g-3 form_wrap_shadow" enctype="multipart/form-data">

            <div class="col-md-6">
                <div id="imgwidth" class="col-md-12 fw-bold">
                    <p>Upload Image here: </p>
                    <input class="ipimg" accept="image/*" type="file" name="file" required>
                </div>
                <div class="pt-3" align='left'>
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
            </div>

            <div class="col-md-6" id="imgheight">

                <div class="col-md-12 py-1">
                    <!-- <label for="">Title:</label>
                    <input type="text" class="form-control" name="title" id="" placeholder="Enter Title Here"> -->

                    <div class="form-outline">
                        <input type="text" id="form12" class="form-control" name="title" value="<?php echo $row['progressTitle'] ?>" />
                        <label class="form-label" for="form12">Title</label>
                    </div>
                </div>

                <div class="col-md-12 py-1">
                    <!-- <label for="">Description:</label>
                    <textarea type="textarea" class="form-control" name="comment" id="" aria-describedby="helpId" placeholder="" rows="3"></textarea> -->
                    <div class="form-outline">
                        <textarea class="form-control" name="comment" id="textAreaExample" rows="2"><?php echo $row['progressDescription'] ?></textarea>
                        <label class="form-label" for="textAreaExample">Description</label>
                    </div>
                    <!-- <small id="helpId" class="form-text text-muted">Write Comemnts Here</small> -->

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
                            <!-- <label for="">1. Did fluid drain from wound?</label><br> -->
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
                    <!-- <label for="customRange3" class="form-label">Pain range : &nbsp;&nbsp;</label><output style="font-weight: bold;">2.5</output><br>
                    <input type="range" class="form-range" min="0" max="5" step="0.5" id="customRange3" oninput="$('output').val(this.value)"> -->
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
                            <!-- <label for="">1. Did fluid drain from wound?</label><br> -->
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
                            <!-- <label for="">1. Did fluid drain from wound?</label><br> -->
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
                            <!-- <label for="">1. Did fluid drain from wound?</label><br> -->
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
                            <!-- <label for="">1. Did fluid drain from wound?</label><br> -->
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

                <!-- <div class="col-12 pt-3" align='right'>
                    <button name="upimg" type="submit" class="btn btn-warning">Action</button>
                    <span name="clickUpload" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden></span>
                </div> -->

                <div class="col-12 pt-3" align='right'>
                    <!-- <button name="upimg" type="submit" class="btn btn-warning">Action</button> -->

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
        </form>



    </div>

</body>

</html>
<script>
    // var $winW = $('#imgWidth').width();
    // $('img').width($winW - 100);
    var imgchanged = 'false';

    $(".ipimg").change(function(e) {
        e.preventDefault();

        $('p[name="bsmd"]').attr("hidden", false);
        imgchanged = 'true';

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
    });

    //Update image
    $("button[name='upd_img']").click(function(e) {
        e.preventDefault();
        var myform = $('form');
        var fd = new FormData(myform[0]);
        fd.append('type', '1entEdit');
        fd.append('imgchanged', imgchanged);
        fd.append('tgt', "<?php echo $enc ?>");
        fd.append('eid', "<?php echo $entryID ?>");
        Swal.fire({
            title: 'Do you want to save the changes?',
            // showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Save',
            showLoaderOnConfirm: true,
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "Patient/includes/1ent_conn.php",
                    type: "POST",
                    data: fd,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $('span[name="clickUpload"]').attr("hidden", false);
                        $('ul li :button').attr("disabled", true);
                        // $('button[name="upimg"]').attr("disabled", true);
                    },
                    success: function(response) {
                        $('span[name="clickUpload"]').attr("hidden", true);
                        $('ul li :button').attr("disabled", false);
                        console.log(response);
                        successUpload("Succesfully updated");
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(errorThrown);
                        console.log(textStatus);
                        failUpload("Oh no, something went wrong");
                    }
                })
            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info')
            }
        })

    });

    //Archive image
    $("button[name='ar_img']").click(function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Do you want to archive this progress image?',
            // showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Yes',
            showLoaderOnConfirm: true,
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            console.log(result);
            if (result.isConfirmed) {
                $.ajax({
                    url: "Patient/includes/1ent_conn.php",
                    type: "POST",
                    data: {
                        archive : "true",
                        type: "1entArchive",
                        tgt: "<?php echo $enc ?>",
                        eid: "<?php echo $entryID ?>",
                    },
                    // contentType: false,
                    cache: false,
                    // processData: false,
                    beforeSend: function() {
                        $('span[name="clickUpload"]').attr("hidden", false);
                        $('ul li :button').attr("disabled", true);
                        // $('button[name="upimg"]').attr("disabled", true);
                    },
                    success: function(response) {
                        $('span[name="clickUpload"]').attr("hidden", true);
                        $('ul li :button').attr("disabled", false);
                        console.log(response);
                        successUpload("Succesfully updated");
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(errorThrown);
                        console.log(textStatus);
                        failUpload("Oh no, something went wrong");
                    }
                })
            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info')
            }
        })

    });

    //de image
    $("button[name='de_img']").click(function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Do you want to delete this progress image?',
            // showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Yes',
            showLoaderOnConfirm: true,
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            console.log(result);
            if (result.isConfirmed) {
                $.ajax({
                    url: "Patient/includes/1ent_conn.php",
                    type: "POST",
                    data: {
                        delete : "true",
                        type: "1entDelete",
                        tgt: "<?php echo $enc ?>",
                        eid: "<?php echo $entryID ?>",
                    },
                    // contentType: false,
                    cache: false,
                    // processData: false,
                    beforeSend: function() {
                        $('span[name="clickUpload"]').attr("hidden", false);
                        $('ul li :button').attr("disabled", true);
                        // $('button[name="upimg"]').attr("disabled", true);
                    },
                    success: function(response) {
                        $('span[name="clickUpload"]').attr("hidden", true);
                        $('ul li :button').attr("disabled", false);
                        console.log(response);
                        successUpload("Succesfully updated");
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(errorThrown);
                        console.log(textStatus);
                        failUpload("Oh no, something went wrong");
                    }
                })
            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info')
            }
        })

    });

    $('form').on('submit', function(e) {
        e.preventDefault();
        var response = confirm("Are u sure?");
        if (response) {
            var myform = $('form');
            var fd = new FormData(myform[0]);
            fd.append('type', '1entEdit');
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