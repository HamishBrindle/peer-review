<?php

session_start();

include('includes/auth_page.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="http://v4-alpha.getbootstrap.com/favicon.ico">

    <title>Roast My Code</title>

    <link href="https://fonts.googleapis.com/css?family=Oswald:700|Patua+One|Roboto+Condensed:700" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
          integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <!-- Codemirror CSS -->
    <link href="../codemirror/lib/codemirror.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/main.css" rel="stylesheet">

    <!-- Lodash -->
    <script src="https://unpkg.com/lodash@4.16.6"></script>

    <!-- JQuery -->
    <script
            src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>

    <!-- Login -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
</head>

<body>
<div class="container">
    <div class="myNavBar">
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #403f48">
            <a class="navbar-brand" href="/">Roast My Code</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <?php
                    if (isset($_COOKIE['authID'])) {
                        echo("
                        <li class=\"nav-item\">
                            <a class='nav-link' href='submit.php'>Submit</a>
                        </li>
                        <li class=\"nav-item\">
                            <a class='nav-link' href='logout.php'>Logout</a>
                        </li>
                    ");
                    } else {
                        echo("
                        <li class=\"nav-item\">
                            <a class='nav-link' href='register.php'>Register</a>
                        </li>
                        <li class=\"nav-item\">
                            <a class='nav-link' href='login.php'>Login</a>
                        </li>
                    ");
                    }
                    ?>
                </ul>
            </div>
        </nav>
    </div>
    <div class="jumbotron jumbotron-fluid" style="background: none;">
        <div class="container">
            <h1 class="display-3">Your Code Snippets</h1>
            <p class="lead">We'll try to roast your ass as soon as possible - be patient.</p>
        </div>
    </div>


    <?php
    require("vendor/autoload.php");

    if (!isset($_COOKIE['authID'])) {
        header("Location: /login.php");
    }

    function blog_post($type, $title, $content, $date, $roast)
    {
        if ($roast != NULL) {
            $roastContent = $roast;
            $roastColor = 'green';
        } else {
            $roastContent = "(Waiting for roasting...)";
            $roastColor = 'red';
        }
        $language = strtolower($type);
        return "
    <div class='left-panel'>
        <div class='col-md-12 col-sm-12 col-lg-12'>
           <div class='panel panel-default'>
               <div class='panel-body'>
                   <div class='col-md-12'>
                       <div class='icerik-bilgi'>
                           <h2>$title</h2>
                           <p style='display: inline-block; color: #a3a3a3; font-size: 12px;'>$date</p>
                           <pre style='text-align: left; width: 100%'>
                            <code style='color: #FFF; text-align: left;' class='language-$language' >
                            <p class='display-code'>$content</p>
                            </code>
                            </pre>
                           <p style='color: $roastColor'>$roastContent</p>
                       </div>
                   </div>
               </div>
           </div>
        </div>
    </div>";
    }

    $server = 'us-cdbr-iron-east-05.cleardb.net';
    $username = 'bffd13713c3b11';
    $password = 'ccc14f3a';
    $db = 'heroku_80a591f53062628';

    try {
        $dbh = new PDO("mysql:host=$server;dbname=$db;", $username, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    $conn = mysqli_connect($server, $username, $password, $db) or
    die(mysqli_connect_error());

    $snippets;
    $roasts;

    if (isset($_SESSION['userId'])) {
        $id = $_SESSION['userId'];
        $snippets = mysqli_query($conn, "
	      SELECT type, header, code, snippets.date, roast 
	      FROM snippets LEFT JOIN roasts ON snippets.id=roasts.snippetId
	      WHERE snippets.userId=$id
        ") or die(mysqli_error($conn));
    }


    ?>

    <div class="container inner cover" style='float: left;'> <!-- Main div -->

        <?php
        while ($record_snippet = mysqli_fetch_assoc($snippets)) {
            echo blog_post($record_snippet['type'], $record_snippet['header'], $record_snippet['code'], $record_snippet['date'], $record_snippet['roast']);
        }
        echo '</div>';
        ?>

    </div> <!-- End of main div -->

    <script type="text/javascript" src="./codemirror/lib/codemirror.js"></script>
    <script>
        (function ($) {
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
                    lg_username: "required",
                    lg_password: "required",
                },
                errorClass: "form-invalid"
            });

            // Form Submission
            $("#login-form").submit(function () {
                remove_loading($(this));

                if (options['useAJAX'] == true) {
                    // Dummy AJAX request (Replace this with your AJAX code)
                    // If you don't want to use AJAX, remove this
                    dummy_submit_form($(this));

                    // Cancel the normal submission.
                    // If you don't want to use AJAX, remove this
                    return false;
                }
            });

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
                errorPlacement: function (label, element) {
                    if (element.attr("type") === "checkbox" || element.attr("type") === "radio") {
                        element.parent().append(label); // this would append the label after all your checkboxes/labels (so the error-label will be the last element in <div class="controls"> )
                    }
                    else {
                        label.insertAfter(element); // standard behaviour
                    }
                }
            });

            // Form Submission
            $("#register-form").submit(function () {
                remove_loading($(this));

                if (options['useAJAX'] == true) {
                    // Dummy AJAX request (Replace this with your AJAX code)
                    // If you don't want to use AJAX, remove this
                    dummy_submit_form($(this));

                    // Cancel the normal submission.
                    // If you don't want to use AJAX, remove this
                    return false;
                }
            });

            // Forgot Password Form
            //----------------------------------------------
            // Validation
            $("#forgot-password-form").validate({
                rules: {
                    fp_email: "required",
                },
                errorClass: "form-invalid"
            });

            // Form Submission
            $("#forgot-password-form").submit(function () {
                remove_loading($(this));

                if (options['useAJAX'] == true) {
                    // Dummy AJAX request (Replace this with your AJAX code)
                    // If you don't want to use AJAX, remove this
                    dummy_submit_form($(this));

                    // Cancel the normal submission.
                    // If you don't want to use AJAX, remove this
                    return false;
                }
            });

            // Loading
            //----------------------------------------------
            function remove_loading($form) {
                $form.find('[type=submit]').removeClass('error success');
                $form.find('.login-form-main-message').removeClass('show error success').html('');
            }

            function form_loading($form) {
                $form.find('[type=submit]').addClass('clicked').html(options['btn-loading']);
            }

            function form_success($form) {
                $form.find('[type=submit]').addClass('success').html(options['btn-success']);
                $form.find('.login-form-main-message').addClass('show success').html(options['msg-success']);
            }

            function form_failed($form) {
                $form.find('[type=submit]').addClass('error').html(options['btn-error']);
                $form.find('.login-form-main-message').addClass('show error').html(options['msg-error']);
            }

            // Dummy Submit Form (Remove this)
            //----------------------------------------------
            // This is just a dummy form submission. You should use your AJAX function or remove this function if you are not using AJAX.
            function dummy_submit_form($form) {
                if ($form.valid()) {
                    form_loading($form);

                    setTimeout(function () {
                        form_success($form);
                    }, 2000);
                }
            }

        })(jQuery);
    </script>

</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
        integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"
        integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ"
        crossorigin="anonymous"></script>

</body>

</html>

