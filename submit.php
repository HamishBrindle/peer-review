<?php

session_start();

include('includes/head.html');

?>

<div class="site-wrapper">

    <div class="site-wrapper-inner">

        <div class="cover-container">

            <div class="masthead clearfix">
                <div class="inner">
                    <h3 class="masthead-brand">Peer Review</h3>
                    <nav class="nav nav-masthead">
                        <a class="nav-link active" href="#">Home</a>
                        <a class="nav-link" href="#">Features</a>
                        <a class="nav-link" href="#">Contact</a>
                        <a class="nav-link" href="submit.php">Submit Code</a>
                    </nav>
                </div>
            </div>

            <div class="inner cover">
                <h1 class="cover-heading">Peer Review Your Code</h1>
                <form name="submit-code" action="">
                    <textarea id="submit-code"></textarea>
                    <br>
                    <input type="submit" class="lead btn btn-lg btn-secondary"/>
                </form>
            </div>

            <div class="mastfoot">
                <div class="inner">
                    <p>Cover template for <a href="http://getbootstrap.com">Bootstrap</a>, by <a href="https://twitter.com/mdo">@mdo</a>.</p>
                </div>
            </div>

        </div>

    </div>

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
