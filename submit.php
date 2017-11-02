<?php

session_start();

include('includes/auth_page.php');
include('includes/head.html');


if (isset($_POST['submit-editor'])) {
    echo $_POST['submit-editor'];
}

?>

    <?php
    include_once('includes/navigation.html');
    ?>

    <div class="container inner cover"> <!-- Main div -->

        <h1 class="cover-heading">Let's Have A Look <br /> At Your Code</h1>

        <form name="submit-form" id="submit-form" action="sent.php" method="post" style="text-align: left;">
            <div class="form-group row">
                <label for="submit-header" class="col-2 col-form-label">Title</label>
                <input type="text" id="submit-header" name="submit-header" class="form-control col-6">
            </div>

            <div class="form-group row">
                <label for="submit-type" class="col-2 col-form-label">Code Type</label>
                <label class="c-input c-radio">
                    <input id="radioStacked1" name="submit-type" type="radio" value="php">
                    <span class="c-indicator"></span>
                    PHP
                </label>
                <label class="c-input c-radio">
                    <input id="radioStacked2" name="submit-type" type="radio" value="html">
                    <span class="c-indicator"></span>
                    HTML/CSS
                </label>
                <label class="c-input c-radio">
                    <input id="radioStacked3" name="submit-type" type="radio" value="javascript">
                    <span class="c-indicator"></span>
                    JavaScript
                </label>
            </div>

            <textarea id="submit-editor" name="submit-editor"></textarea>
            <br>
            <input type="submit" id="submit-button" class="lead btn btn-lg btn-secondary"/>
        </form>

    </div> <!-- End of main div -->

<script
        src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>
<script type="text/javascript" src="./codemirror/lib/codemirror.js"></script>
<script>
    var code;
    var editor;
    $(document).ready(function(){
        //code here...
        code = document.getElementById("submit-editor");
        editor = CodeMirror.fromTextArea(code, {
            lineNumbers : true,
            mode: "javascript"
        });

//        $('#submit-form').submit(
//            function(event) {
//                $(this).append('<input type="hidden" name="submit-code" id="submit-code" value="' + editor.getValue() + '" />');
//            }
//        );
    });


</script>
<?php

include('includes/foot.html');

?>
