<?php

session_start();

include('includes/head.html');
include_once('includes/navigation.html');

if (isset($_POST['reg_email']) && isset($_POST['reg_password']) && isset($_POST['reg_agree'])) {
    require("vendor/autoload.php");
    require("includes/phpauth/phpauth/Config.php");
    require("includes/phpauth/phpauth/Auth.php");

    $email = $_POST['reg_email'];
    $password = $_POST['reg_password'];

    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);

    try {
        $dbh = new PDO("mysql:host=$server;dbname=$db;", $username, $password);

        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    $config = new PHPAuth\Config($dbh);
    $auth   = new PHPAuth\Auth($dbh, $config);

    $hash = $auth->register($email, $password, $password);

    if (!$hash["error"]) {
        echo "registration successful";
    } else {
        die($hash["message"] . "<a href='register.php'> Try Again</a>");
    }

    $hash = $auth->login($email, $password);

    var_dump($hash);

    if (!$hash["error"]) {
        setcookie('authID', $hash['hash'], time() + 90000);
        $_SESSION['userId'] = $auth->getUID($email);
        $_SESSION['userEmail'] = $email;
        $_SESSION['loggedIn'] = 1;
    }

    if (isset($_POST['redirect']) && strlen($_POST['redirect']) != 0) {
        header("Location: /" . $_POST['redirect'] . ".php");
    } else {
        header("Location: /user.php");
    }
}
?>

<div class="container inner cover"> <!-- Main div -->

    <h1 class="cover-heading">Register</h1>
    <!-- REGISTRATION FORM -->
    <div class="text-center" style="padding:50px 0">
        <!-- Main Form -->
        <div class="login-form-1">
            <form id="register-form" class="text-left" method="post" action='register.php'>
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

                        <div class="form-group login-group-checkbox">
                            <input type="checkbox" class="" id="reg_agree" name="reg_agree">
                            <label for="reg_agree">i agree with <a href="#">terms</a></label>
                        </div>

                        <input type="hidden" name="redirect" id="redirect" value="<?php if (isset($_GET['redirect'])) echo $_GET['redirect'] ?>">
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
