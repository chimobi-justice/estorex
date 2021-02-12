  <?php include('template/header.php'); ?>


<main>
  <div class="contact_container">
    <div id="contact_img_holder">
      <h4 id="contact_content">How can we help you</h4>
      <div id="contact_img"><img src="assets/images/contact.png" alt="contact"></div>
    </div>
    <div>
      <form method="POST" id="contact">
        <label for="firstname">Firstname</label>
        <input type="text" name="firstname" id="firstname" placeholder="firstname">
        <p id="firstNameFeedBack"></p>
        <label for="lastname">Lastname</label>
        <input type="text" name="lastname" id="lastname"placeholder="lastname">
        <p id="lastNameFeedBack"></p>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="email address">
        <p id="emailFeedBack"></p>
        <label for="msg">Message</label>
        <textarea name="message" id="msg" cols="30" rows="10"></textarea>
        <p id="msgFeedBack"></p>
        <button type="submit">Submit</button><br>
      </form>
    </div>
  </div>
  </main>

  <?php include('template/footer.php'); ?>
