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
        <?php include HEADER; $enc = base64_encode($_SESSION['sess_id']) ?>
        <!-- Page content -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form class="row g-3 form_wrap_shadow" enctype="multipart/form-data">

                            <div class="col-md-6">
                                <div id="imgwidth" class="col-md-12 fw-bold">
                                    <p>Upload Image here: </p>
                                    <input class="ipimg" accept="image/*" type="file" name="file" required>
                                </div>
                                <div class="pt-3" align='left'>
                                    <img id="not_modal" data-toggle="modal" name="bsmd" data-target="#exampleModal" style="cursor: pointer;" class="outImg" alt="your image" />
                                </div>
                                <div class="col-md-12" align='left'>

                                    <!-- Button trigger modal -->
                                    <p data-toggle="modal" name="bsmd" data-target="#exampleModal" style="cursor: pointer;" hidden>
                                        Click to view larger image
                                    </p>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Image Preview</h5>
                                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body" style="overflow: auto;" align="center">
                                                    <img class="outImg" alt="your image" style="width: 1000px; height: auto" />
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                                        <label class="form-label" for="form12">Title:</label>
                                        <input type="text" id="form12" class="form-control" name="title" required/>
                                    </div>
                                </div>

                                <div class="col-md-12 py-1">
                                    <!-- <label for="">Description:</label>
        <textarea type="textarea" class="form-control" name="comment" id="" aria-describedby="helpId" placeholder="" rows="3"></textarea> -->
                                    <div class="form-outline">
                                        <label class="form-label" for="textAreaExample">Description:</label>
                                        <textarea class="form-control" name="comment" id="textAreaExample" rows="2" required></textarea>
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
                                                <input class="form-check-input" type="radio" name="fluidwound" id="fwyes" value="Yes" required />
                                                <label class="form-check-label text-capitalize" for="inlineRadio1">Yes</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="fluidwound" id="fwno" value="No" />
                                                <label class="form-check-label text-capitalize" for="inlineRadio2">No</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="fluidwound" id="fwnotsure" value="Not Sure" />
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
                                            Rate your pain: <output style="font-weight: bold;">3</output> <small> out of 5</small> 
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-1 ">
                                        </div>
                                        <div class="col-11 ">
                                            <div class="range">
                                                <input type="range" class="form-range" min="0" value='3' step="1" max="5" style="min-width: 300px !important;" id="customRange2" name="quespain" oninput="$('output').val(this.value)"/>
                                                <small id="helpId" class="form-text text-muted">Please slide here to rate your pain</small>
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
                                                <input class="form-check-input" type="radio" name="redwound" id="rwworse" value="worse" required />
                                                <label class="form-check-label text-capitalize" for="inlineRadio1">Worse</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="redwound" id="rwsome" value="some" />
                                                <label class="form-check-label text-capitalize" for="inlineRadio2">Some</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="redwound" id="rwbetter" value="better" />
                                                <label class="form-check-label text-capitalize" for="inlineRadio3">better</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="redwound" id="rwunsure" value="unsure" />
                                                <label class="form-check-label text-capitalize" for="inlineRadio3">unsure</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="redwound" id="rwnone" value="none" />
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
                                                <input class="form-check-input" type="radio" name="swellwound" id="swworse" value="worse" required  />
                                                <label class="form-check-label text-capitalize" for="inlineRadio1">Worse</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="swellwound" id="swsome" value="some" />
                                                <label class="form-check-label text-capitalize" for="inlineRadio2">Some</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="swellwound" id="swbetter" value="better" />
                                                <label class="form-check-label text-capitalize" for="inlineRadio3">better</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="swellwound" id="swunsure" value="unsure" />
                                                <label class="form-check-label text-capitalize" for="inlineRadio3">unsure</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="swellwound" id="swnone" value="none" />
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
                                                <input class="form-check-input" type="radio" name="odourwound" id="owyes" value="Yes" required />
                                                <label class="form-check-label text-capitalize" for="inlineRadio1">Yes</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="odourwound" id="owno" value="No" />
                                                <label class="form-check-label text-capitalize" for="inlineRadio2">No</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="odourwound" id="ownotsure" value="Not Sure" />
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
                                                <input class="form-check-input" type="radio" name="fever" id="owno" value="No" required />
                                                <label class="form-check-label text-capitalize" for="inlineRadio2">No</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="fever" id="owyes" value="Yes" />
                                                <label class="form-check-label text-capitalize" for="inlineRadio1">Yes</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 pt-3" align='right'>
                                    <button name="upimg" type="submit" class="btn btn-primary">Submit</button>
                                    <span name="clickUpload" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden></span>
                                </div>
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

            console.log("height: "  + height);
            console.log("width: "  + width);
        });

    }
    /* End Image Resize Code */



    /* How to use with DOM Ready */
    $(document).ready(function() {
        /* Call function for image resize (not for a Webkit browser) */
        image_resize();
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
                url: "includes/1ent_conn.php",
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
                    Swal.fire({ title: "Great!", text: "Succesfully Uploaded!", type: "success" }).then((result) => {
                        if (result.value) { window.location.href = "patient-Iview.php"; }
                    });
                },
            });
        }

    });
</script>
</body>

</html>

<?php
$current_link = htmlspecialchars($_SERVER["PHP_SELF"]);
