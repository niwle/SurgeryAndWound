<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>

<body>
    <!-- <nav class="navbar">
        <a class="" href="<?php echo _HOMEPAGE_ ?>"><img style="width: 10%; height: 10%;" src="<?php echo _icon_ ?>">
            <lo>Surgery And WOund Monitoring</lo>
        </a>
    </nav> -->


    

    

    <div id="content">
        
        <div class="container">
            <h1>Patient HomePage </h1>
            <a name="Edit" id="Edit" title="Click here to edit excel" class="btn btn-primary" href="<?php echo _APLOCATION_ ?>?panel=1ent&sub_panel=edit" role="button">edit</a>
            <a name="Upload" id="Upload" title="Click here to upload excel" class="btn btn-primary" href="<?php echo _APLOCATION_ ?>?panel=1ent&sub_panel=upload" role="button">upload</a>
    
        </div>
    </div>




<script>

$('.navbar-toggler').click(function (e) { 
            e.preventDefault();
            console.log("hi");
        });
</script>

</body>

</html>