<?php

session_start();

include('includes/auth_page.php');
include('includes/head.html');

$error = "";
$submit = false;

if (isset($_POST['email'])) {
  $_SESSION['email'] = $_POST['email'];

  if (isset($_POST['radio-stacked'])) {
    $_SESSION['language'] = $_POST['radio-stacked'];
    $submit = true;
  } else {
    $error = "Select a language!";
  }

}

function showModal() {
  echo '<div class="row">
      <div id="myModal" class="modal flex-start"> <!-- The Modal -->
          <div class="modal-content start"> <!-- Modal content -->
            <form action="" method="post">
              <div class="form-group">
                  <div class="c-inputs-stacked">
                    <p class="help-block">Select Your Language</p>
                    <p id="error" style="color: red; font-size: 12px;"><?php echo $error ?></p>
                    <label class="c-input c-radio">
                      <input id="radioStacked1" name="radio-stacked" type="radio" value="php">
                      <span class="c-indicator"></span>
                      PHP
                    </label>
                    <label class="c-input c-radio">
                      <input id="radioStacked2" name="radio-stacked" type="radio" value="html">
                      <span class="c-indicator"></span>
                      HTML/CSS
                    </label>
                    <label class="c-input c-radio">
                      <input id="radioStacked3" name="radio-stacked" type="radio" value="javascript">
                      <span class="c-indicator"></span>
                      JavaScript
                    </label>
                  </div>
                  <hr />
                  <label for="email">Enter Your Email</label>
                  <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                </div>
                <input type="submit" class="btn btn-primary submit" value="Confirm" name="submit"></input>
            </form>
          </div> <!-- End of Modal content -->
      </div> <!-- End of The Modal -->
  </div>';
}

?>

    <?php
    include_once('includes/navigation.html');
    ?>

    <div class="container inner cover"> <!-- Main div -->

        <h1 class="cover-heading">Let's Have A Look <br /> At Your Code</h1>
        <form name="submit-code" action="sent.php" method="post" style="text-align: left;">
            <textarea id="code-editor" name="code"></textarea>
            <br>
            <input type="submit" id="submit-button" class="lead btn btn-lg btn-secondary"/>
        </form>

        <?php if (!$submit) showModal(); ?>

    </div> <!-- End of main div -->

<script
        src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>
<script type="text/javascript" src="./codemirror/lib/codemirror.js"></script>
<script>
    $(document).ready(function(){
        //code here...
        var code = document.getElementById("code-editor");
        var editor = CodeMirror.fromTextArea(code, {
            lineNumbers : true,
            mode: "javascript"
        });
    });
</script>
<?php

include('includes/foot.html');

?>
