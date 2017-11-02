<?php

session_start();

include('includes/head.html');
include_once('includes/navigation.html');

if (isset($_POST['lg_email']) && isset($_POST['lg_password'])) {
    require("vendor/autoload.php");
    require("includes/phpauth/phpauth/Config.php");
    require("includes/phpauth/phpauth/Auth.php");

    $email = $_POST['lg_email'];
    $password = $_POST['lg_password'];

    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);

    $dbh = new PDO("mysql:host=$server; dbname=$db;", $username, $password);

    $config = new PHPAuth\Config($dbh);
    $auth   = new PHPAuth\Auth($dbh, $config);

    $hash = $auth->login($email, $password);

    setcookie('authID', $hash['hash'], time() + 90000);

    $_SESSION['userId'] = $auth->getUID($email);
    $_SESSION['userEmail'] = $email;
    $_SESSION['loggedIn'] = 1;

    if (isset($_GET['redirect']) && strlen($_GET['redirect']) != 0) {
        header("Location: /" . $_GET['redirect'] . ".php");
    } else {
        header("Location: /user.php");
    }

}
?>

<div class="container inner cover"> <!-- Main div -->

    <h1 class="cover-heading">Login</h1>
    <!-- LOGIN FORM -->
    <div class="text-center" style="padding:50px 0">
        <!-- Main Form -->
        <div class="login-form-1">
            <form id="login-form" class="text-left" method="post" action="login.php?redirect=<?php echo $_GET['redirect']?>">
                <div class="login-form-main-message"></div>
                <div class="main-login-form">
                    <div class="login-group">
                        <div class="form-group">
                            <label for="lg_email" class="sr-only">Username</label>
                            <input type="text" class="form-control" id="lg_email" name="lg_email" placeholder="email">
                        </div>
                        <div class="form-group">
                            <label for="lg_password" class="sr-only">Password</label>
                            <input type="password" class="form-control" id="lg_password" name="lg_password" placeholder="password">
                        </div>
<!--                        <div class="form-group login-group-checkbox">-->
<!--                            <input type="checkbox" id="lg_remember" name="lg_remember">-->
<!--                            <label for="lg_remember">remember</label>-->
<!--                        </div>-->
                    </div>
                    <button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
                </div>
                <div class="etc-login-form">
                    <p>new user? <a href="register.php?redirect=<?php echo $_GET['redirect']?>">create new account</a></p>
                </div>
            </form>
        </div>
        <!-- end:Main Form -->
    </div>

</div> <!-- End of main div -->

<script type="text/javascript" src="./codemirror/lib/codemirror.js"></script>
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

        // Login Form
        //----------------------------------------------
        // Validation
        $("#login-form").validate({
            rules: {
                lg_email: "required",
                lg_password: "required",
            },
            errorClass: "form-invalid"
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
