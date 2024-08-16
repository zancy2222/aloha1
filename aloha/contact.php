<!-- contact -->



<section class="contact-w3ls" id="contact">
    <div class="container">
        <div class="col-lg-6 col-md-6 col-sm-6 contact-w3-agile2" data-aos="flip-left">
            <div class="contact-agileits">
                <h4>Contact Us</h4>

                <form method="post" name="sentMessage" id="contactForm" onsubmit="openGmail(); return false;">
                    <div class="control-group form-group">
                        <label class="contact-p1">Full Name:</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                        <p class="help-block"></p>
                    </div>    
                    <div class="control-group form-group">
                        <label class="contact-p1">Phone Number:</label>
                        <input type="tel" class="form-control" name="phone" id="phone" required>
                        <p class="help-block"></p>
                    </div>                  
                    <div class="control-group form-group">
                        <label class="contact-p1">Email Address:</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                        <p class="help-block"></p>
                    </div>
                    <div class="control-group form-group">
                        <label class="contact-p1">Subject:</label>
                        <input type="text" class="form-control" name="subject" id="subject" required>
                        <p class="help-block"></p>
                    </div>
                    <div class="control-group form-group">
                        <label class="contact-p1">Message:</label>
                        <textarea class="form-control" name="message" id="message" required></textarea>
                        <p class="help-block"></p>
                    </div>
                    <input type="submit" name="sub" value="Send Now" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</section>
<div class="clearfix"></div>
</div>
</section>

<script>
function openGmail() {
    var fullName = document.getElementById("name").value;
    var phoneNumber = document.getElementById("phone").value;
    var emailAddress = document.getElementById("email").value;
    var subject = document.getElementById("subject").value;
    var message = document.getElementById("message").value;
    
  // Construct the Gmail compose URL with pre-filled data
  var gmailUrl = "https://mail.google.com/mail/?view=cm&fs=1&to=tlqdevera.ccit@unp.edu.ph&su=" + encodeURIComponent(subject) + "&body=Full%20Name:%20" + encodeURIComponent(fullName) + "%0APhone%20Number:%20" + encodeURIComponent(phoneNumber) + "%0AEmail%20Address:%20" + encodeURIComponent(emailAddress) + "%0ASubject:%20" + encodeURIComponent(subject) + "%0AMessage:%20" + encodeURIComponent(message);
    
    // Open Gmail website in a new tab
    window.open(gmailUrl, '_blank');
    
    return false; // Prevent default form submission
}
</script>