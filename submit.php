<?php

session_start();

include('includes/head.html');

?>

    <div class="cover-container">

        <?php
        include_once('includes/navigation.html');
        ?>

        <div class="inner cover">
            <h1 class="cover-heading">Peer Review Your Code</h1>
            <form name="submit-code" action="" style="text-align: left;">
                <textarea id="submit-code"></textarea>
                <br>
                <input type="submit" class="lead btn btn-lg btn-secondary"/>
            </form>
        </div>

<script
        src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>
<script type="text/javascript" src="codemirror/lib/codemirror.js"></script>
<script>
    $(document).ready(function(){
        //code here...
        var code = document.getElementById("submit-code");
        var editor = CodeMirror.fromTextArea(code, {
            lineNumbers : true
        });
    });
</script>
<?php

include('includes/foot.html');

?>
