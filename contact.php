<?php include('template/header.php'); ?>

  <section id="contact-container">
      <div>
          <div class="contact-content">
              <h3>Contact Us</h3>
              <p>Fill up the form and our team will get back to you within 24 hours</p>
              <div>
                <p>+234 8021185592</p>
                <p><a href="mailto:estorex@gmail.com">estorex@gmail.com</a></p>
                <p>Lagos State, Nigeria</p>
              </div>
          </div>
          <div class="contact-img">
            <img src="assets/images/IMG_20210119_124917.png" alt="contact">
          </div>
      </div>
      <div>
        <form action="" method="POST" id="contact-form-control">
          <div class="form-container">
             <div class="form-group-container">
                <label for="name">Your name</label>
                <input type="text" id="name" placeholder="Your Name">
             </div>
             <div class="form-group-container">
                <label for="email">Mail</label>
                <input type="email" id="email" placeholder="Enter Email">
             </div>
             <div class="form-group-container">
                <label for="message">Message</label>
                <textarea id="message" cols="20" rows="5" placeholder="Message"></textarea>
             </div>
             <div class="buttonHolder">
                  <button type="submit">Contact Us</button>
             </div>
          </div>
        </form>
      </div>
  </section>

  <?php include('newsletter.php'); ?>

<?php include('template/footer.php'); ?>