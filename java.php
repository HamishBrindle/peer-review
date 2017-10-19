<!-- CODE MIRROR PAGE -->
<?php

session_start();

include('includes/head.html');

?>

<section id="contact" class="content-section text-center">
        <div class="contact-section">
            <div class="container">
              <h2>Post Your Question</h2>
              <p>Feel free to shout us by feeling the contact form or visiting our social network sites like Fackebook,Whatsapp,Twitter.</p>
              <div class="row">
                <div class="col-lg-8 center">
                  <form class="form-horizontal">
                    <div class="form-group">
                      <input type="text" class="form-control" id="exampleInputName2" placeholder="Name">
                    </div>
                    <div class="form-group">
                      <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Email">
                    </div>
                    <div class="form-group ">
                     <textarea  class="form-control" placeholder="Your code"></textarea>
                    </div>
                    <button type="submit" class="btn btn-default">Send Message</button>
                  </form>

                  <hr>
                    <h3>Our Social Sites</h3>
                  <ul class="list-inline banner-social-buttons">
                    <li><a href="#" class="btn btn-default btn-lg"><i class="fa fa-twitter"> <span class="network-name">Twitter</span></i></a></li>
                    <li><a href="#" class="btn btn-default btn-lg"><i class="fa fa-facebook"> <span class="network-name">Facebook</span></i></a></li>
                    <li><a href="#" class="btn btn-default btn-lg"><i class="fa fa-youtube-play"> <span class="network-name">Youtube</span></i></a></li>
                  </ul>
                </div>
              </div>
            </div>
        </div>
      </section>

<?php

include('includes/foot.html');

?>
