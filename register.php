<?php

session_start();

include('includes/head.html');
include_once('includes/navigation.html');

if (isset($_POST['reg_email']) && isset($_POST['reg_password']) && isset($_POST['reg_password_confirm']) && isset($_POST['reg_agree'])) {
    require("vendor/autoload.php");
    require("includes/phpauth/phpauth/Config.php");
    require("includes/phpauth/phpauth/Auth.php");

    $email = $_POST['reg_email'];
    $password = $_POST['reg_password'];
    $confirmPassword = $_POST['reg_password_confirm'];

    $dbh = new PDO("mysql:host=localhost;dbname=roast", "root", "1234");

    $config = new PHPAuth\Config($dbh);
    $auth   = new PHPAuth\Auth($dbh, $config);

    $hash = $auth->register($email, $password, $confirmPassword);

    $hash = $auth->login($email, $password);

    setcookie('authID', $hash['hash'], time() + 9000000000);

    header("Location: /user.php");
}
?>

<div class="container inner cover"> <!-- Main div -->

    <h1 class="cover-heading">Register</h1>
    <!-- REGISTRATION FORM -->
    <div class="text-center" style="padding:50px 0">
        <!-- Main Form -->
        <div class="login-form-1">
            <form id="register-form" class="text-left" method="post" action="register.php">
                <div class="login-form-main-message"></div>
                <div class="main-login-form">
                    <div class="login-group">
                        <div class="form-group">
                            <label for="reg_email" class="sr-only">Email</label>
                            <input type="text" class="form-control" id="reg_email" name="reg_email" placeholder="email">
                        </div>
                        <div class="form-group">
                            <label for="reg_password" class="sr-only">Password</label>
                            <input type="password" class="form-control" id="reg_password" name="reg_password" placeholder="password">
                        </div>
                        <div class="form-group">
                            <label for="reg_password_confirm" class="sr-only">Password Confirm</label>
                            <input type="password" class="form-control" id="reg_password_confirm" name="reg_password_confirm" placeholder="confirm password">
                        </div>

                        <div class="form-group login-group-checkbox">
                            <input type="checkbox" class="" id="reg_agree" name="reg_agree">
                            <label for="reg_agree">i agree with <a href="#">terms</a></label>
                        </div>
                    </div>
                    <button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
                </div>
                <div class="etc-login-form">
                    <p>already have an account? <a href="#">login here</a></p>
                </div>
            </form>
        </div>
        <!-- end:Main Form -->
    </div>

<script>
    (function($) {
        "use strict";

        // Options for Message
        //----------------------------------------------
        var options = {
            'btn-loading': '<i class="fa fa-spinner fa-pulse"></i>',
            'btn-success': '<i class="fa fa-check"></i>',
            'btn-error': '<i class="fa fa-remove"></i>',
            'msg-success': 'All Good! Redirecting...',
            'msg-error': 'Wrong login credentials!',
            'useAJAX': true,
        };

        // Register Form
        //----------------------------------------------
        // Validation
        $("#register-form").validate({
            rules: {
                reg_username: "required",
                reg_password: {
                    required: true,
                    minlength: 5
                },
                reg_password_confirm: {
                    required: true,
                    minlength: 5,
                    equalTo: "#register-form [name=reg_password]"
                },
                reg_email: {
                    required: true,
                    email: true
                },
                reg_agree: "required",
            },
            errorClass: "form-invalid",
            errorPlacement: function( label, element ) {
                if( element.attr( "type" ) === "checkbox" || element.attr( "type" ) === "radio" ) {
                    element.parent().append( label ); // this would append the label after all your checkboxes/labels (so the error-label will be the last element in <div class="controls"> )
                }
                else {
                    label.insertAfter( element ); // standard behaviour
                }
            }
        });


        // Loading
        //----------------------------------------------
        function remove_loading($form)
        {
            $form.find('[type=submit]').removeClass('error success');
            $form.find('.login-form-main-message').removeClass('show error success').html('');
        }

        function form_loading($form)
        {
            $form.find('[type=submit]').addClass('clicked').html(options['btn-loading']);
        }

        function form_success($form)
        {
            $form.find('[type=submit]').addClass('success').html(options['btn-success']);
            $form.find('.login-form-main-message').addClass('show success').html(options['msg-success']);
        }

        function form_failed($form)
        {
            $form.find('[type=submit]').addClass('error').html(options['btn-error']);
            $form.find('.login-form-main-message').addClass('show error').html(options['msg-error']);
        }

    })(jQuery);
</script>
<?php

include('includes/foot.html');

?>
