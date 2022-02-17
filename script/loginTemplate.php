<div class="container">
<div class="login-wrap mx-auto">
    <div class="login-head">
        <div class="linkGB" align='left'>
            <p><a href="../"><i class="fa fa-home mr-2 fa-fw"></i>Click to go back</a></p>
        </div>
        <br>
        <h4><?php echo $BRAND_NAME; ?></h4>
        <p>Hello there, Sign into your Account!</p>
    </div>
    <div class="login-body">
        <form name="login_form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" placeholder="admin Email" required>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                <div align='center' style="padding-top: 10px;">
                    <p class="linkFP" data-toggle="modal" data-target="#forgotpass"><a id="resetpass" href="#">Forgot password</a></p>
                </div>
            </div>
            <hr>
            <button type="submit" name="loginbtn" class="btn btn-primary btn-block button">Log In</button>

        </form>
        <!-- Modal -->
        <div class="modal fade" id="forgotpass" tabindex="-1" role="dialog" aria-labelledby="forgotpassLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="forgotpassLabel">Reset Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="../assets/includes/resetPassword-inc.php" id="reset-form" method="POST">
                            <div class="form-group w-75 py-4 container-fluid">
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fa fa-envelope"></i></div>
                                    <input type="email" id="reset-input" name="email-reset" class="form-control" placeholder="Email" required />
                                </div>
                            </div>

                            <!-- Reset password button -->
                            <div class="text-center">
                                <input type="submit" id="" class="btn btn-primary" value="Reset" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include JS_PATH; ?>
    <script>
        $("#reset-form").submit(function(event) {
            event.preventDefault();
            var form = $(this)[0];
            var formData = new FormData(form);

            $.ajax({
                method: "POST",
                url: "../config/resetPassword-inc.php?",
                data: formData,
                dataType: "JSON",
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    if (response.sent) {
                        // if an email sent will display an alert with sweetalert
                        Swal.fire({
                            title: 'Password Reset',
                            text: 'Instrctions will be send to your Email. Make sure to check spam/junk folder',
                            icon: 'success'
                        })
                    } else {
                        // if an email does not exists or wrongly entered will display an alert with sweetalert
                        if (!response.sent) {
                            Swal.fire({
                                title: 'Password Reset',
                                text: "We couldn't find a match for the email entered please enter again or singup if you are not already. ",
                                icon: 'error'
                            })
                        }
                    }

                }

            });
        });
    </script>

</div>