<?php
$user_id = $_SESSION['userID'];
$enc = base64_encode($user_id);
$sql = "SELECT * FROM progress_book_entry WHERE masterUserid_fk = $user_id;";
$result = $db->query($sql);


if (($result->num_rows) == 0) {
    $status = "no data"; //meaning no existing data    
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
</head>

<body>

    <div class="container">
        <h1>Patient HomePage (Edit)</h1>

        <?php while ($row = $result->fetch_assoc()) : ?>
            <div class="card mb-3">
                <div class="row g-0">
                    <a href="<?php echo _EDITR_ ?>&f=<?php echo $row['entryID'] ?>">
                        <div class="col-md-4">
                            <?php
                            $imglocation = $row['progressImage'];
                            $fulllocation = ("$default_location/modules/Patient/img/$user_id/$imglocation");
                            ?>
                            <img src="<?php echo $fulllocation ?>" class="img-fluid rounded-start" max-width="430px" height="240px" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Title: <?php echo $row['progressTitle'] ?></h5>
                                <p class="card-text">Description: <?php echo $row['progressDescription'] ?></p>
                                <p class="card-text">Created at: <?php echo $row['created_at'] ?></p>
                                <p class="card-text">Last Updated at: <?php echo $row['updated_at'] ?></p>
                                <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        <?php endwhile ?>

    </div>
</body>

</html>
<script>
    $(".ipimg").change(function(e) {
        e.preventDefault();
        $('p[name="bsmd"]').attr("hidden", false);
    });

    $('form').on('submit', function(e) {
        e.preventDefault();
        var response = confirm("Are u sure?");
        if (response) {
            var myform = $('form');
            var fd = new FormData(myform[0]);
            fd.append('type', '1entUpload');
            fd.append('tgt', "<?php echo $enc ?>");
            console.log(fd);
            $.ajax({
                url: "../script/1ent_conn.php",
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