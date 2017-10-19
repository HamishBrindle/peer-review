<?php

session_start();

include('includes/head.html');

?>

    <?php
    include_once('includes/navigation.html');
    ?>

    <div class="container inner cover"> <!-- Main div -->

        <h1 class="cover-heading">Let's Have A Look <br /> At Your Code</h1>
        <form name="submit-code" action="sent.php" method="post" style="text-align: left;">
            <textarea id="submit-code"></textarea>
            <br>
            <input type="submit" id="submit-button" class="lead btn btn-lg btn-secondary"/>
        </form>

        <div class="row">
            <div id="myModal" class="modal flex-start"> <!-- The Modal -->
                <div class="modal-content start"> <!-- Modal content -->

                <form action="" method="post">
                  <div class="form-group">
                      <div class="c-inputs-stacked">
                        <p class="help-block">Select Your Language</p>

                        <label class="c-input c-radio">
                          <input id="radioStacked2" name="radio-stacked" type="radio">
                          <span class="c-indicator"></span>
                          PHP
                        </label>
                        <label class="c-input c-radio">
                          <input id="radioStacked1" name="radio-stacked" type="radio">
                          <span class="c-indicator"></span>
                          HTML/CSS
                        </label>
                        <label class="c-input c-radio">
                          <input id="radioStacked1" name="radio-stacked" type="radio">
                          <span class="c-indicator"></span>
                          JavaScript
                        </label>

                      </div>
                      <hr />
                      <label for="email">Enter Your Email</label>
                      <input type="email" class="form-control" id="email" placeholder="Email">
                    </div>
                    <button class="btn btn-primary submit">Submit</span>
                </form>

                </div> <!-- End of Modal content -->

            </div> <!-- End of The Modal -->
        </div>
    </div> <!-- End of main div -->

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
