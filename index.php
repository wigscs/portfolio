<?php

use App\ContactForm;
use App\ContactMailer;
use App\Enquiry;
use PHPMailer\PHPMailer\Exception;

$page = 'portfolio';
$title = "Sam Wiggins | Portfolio";

require 'src/bootstrap.php';

$form = $dbError = $dbConsoleError = null;
if (!empty($_POST)) {
    $form = new ContactForm($_POST);
    if ($form->validate()) { // form is valid so create DB entry and send email
        try {
            $enquiry = new Enquiry($db);
            $enquiry->createEnquiry($form->getInput());
        } catch (PDOException $e) {
            $dbError = 'Error saving message to DB.';
            $dbConsoleError = $e->getMessage();
        }

        // Send email
        try {
            $mail = new ContactMailer();
            $mail->send($form->getInput());
        } catch (Exception $e) {
            $dbError = 'Error sending email.';
            $dbConsoleError = $e->getMessage();
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'views/head.php'; ?>
</head>

<body>
    <?php include 'views/nav.php'; ?>
    <?php include 'views/hero.php'; ?>

    <div class="container">
        <main id="portfolio">
            <h1>Projects</h1>
            <div class="project-list">

                <div class="project-list__item">
                    <img class="project-image" src="img/portfolio/nmhp.jpg" alt="Netmatters Homepage">
                    <h1 class="project-title">Netmatters Homepage</h1>
                    <p>Rebuild of the Netmatters home and contact pages.</p>
                    <div class="project-links">
                        <span class="view-project-link"><a target="_blank" href="https://netmatters.samuel-wiggins.netmatters-scs.co.uk/">Demo</a></span>
                        <span class="view-project-link"><a target="_blank" href="https://github.com/wigscs/netmatters">Code</a></span>
                    </div>
                </div>
                
                <div class="project-list__item">
                    <img class="project-image" src="img/portfolio/jsarray.jpg" alt="JS Array">
                    <h1 class="project-title">JS Array</h1>
                    <p>Javascript using localstorage to create a collection of images associated to an email address</p>
                    <div class="project-links">
                        <span class="view-project-link"><a target="_blank" href="https://js-array.samuel-wiggins.netmatters-scs.co.uk/">Demo</a></span>
                        <span class="view-project-link"><a target="_blank" href="https://github.com/wigscs/jsarray">Code</a></span>
                    </div>
                </div>

                <div class="project-list__item">
                    <img class="project-image" src="img/portfolio/laravel.jpg" alt="Laravel Company Manager">
                    <h1 class="project-title">Company Manager</h1>
                    <p>Admin panel made with Laravel, login with <br>Email: admin@admin.com <br>Password: password</p>
                    <div class="project-links">
                        <span class="view-project-link"><a target="_blank" href="https://laravel.samuel-wiggins.netmatters-scs.co.uk/">Demo</a></span>
                        <span class="view-project-link"><a target="_blank" href="https://github.com/wigscs/laravelassessment">Code</a></span>
                    </div>
                </div>

            </div>
        </main>

        <section id="contact" class="contact">
            <div class="contact__details">
                <h1>Get In Touch</h1>
                <p>If you'd like to collaborate with me please use the contact form.</p>
            </div>

            <form class="contact__form" action="index.php#contact" method="post">
                <?php if (!$dbError && $form && !$form->hasErrors()) { ?>
                    <div class="success-message">
                        <p>Message sent successfully!</p>
                    </div>
                <?php } else if ($dbError) { ?>
                    <div class="error-message">
                        <p><?php echo $dbError; ?></p>
                    </div>
                <?php } ?>
                <div class="first <?php echo $form && $form->getError('first_name') ? ' invalid' : ''; ?>">
                    <input class="contact__form-input" type="text" name="first_name" id="first_name" value="<?php echo $form && $form->hasErrors() ? $form->getInput('first_name') : ''; ?>" placeholder="First Name" required>
                    <span class="error" aria-live="polite">Please enter your first name</span>
                </div>
                <div class="second <?php echo $form && $form->getError('last_name') ? ' invalid' : ''; ?>">
                    <input class="contact__form-input" type="text" name="last_name" id="last_name" value="<?php echo $form && $form->hasErrors() ? $form->getInput('last_name') : ''; ?>" placeholder="Last Name" required>
                    <span class="error" aria-live="polite">Please enter your last name</span>
                </div>
                <div <?php echo $form && $form->getError('email') ? ' class="invalid"' : ''; ?>>
                    <input class="contact__form-input" type="email" name="email" id="email" value="<?php echo $form && $form->hasErrors() ? $form->getInput('email') : ''; ?>" placeholder="Email Address" required pattern="^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$">
                    <span class="error" aria-live="polite">Please enter a valid email address</span>
                </div>
                <div <?php echo $form && $form->getError('phone') ? ' class="invalid"' : ''; ?>>
                    <input class="contact__form-input" type="tel" name="phone" id="phone" value="<?php echo $form && $form->hasErrors() ? $form->getInput('phone') : ''; ?>" placeholder="Phone Number" required pattern="^(((\+44\s?\d{4}|\(?0\d{4}\)?)\s?\d{3}\s?\d{3})|((\+44\s?\d{3}|\(?0\d{3}\)?)\s?\d{3}\s?\d{4})|((\+44\s?\d{2}|\(?0\d{2}\)?)\s?\d{4}\s?\d{4}))(\s?#(\d{4}|\d{3}))?$">
                    <span class="error" aria-live="polite">Please enter a valid phone number</span>
                </div>
                <div <?php echo $form && $form->getError('subject') ? ' class="invalid"' : ''; ?>>
                    <input class="contact__form-input" type="text" name="subject" id="subject" value="<?php echo $form && $form->hasErrors() ? $form->getInput('subject') : ''; ?>" placeholder="Subject" required>
                    <span class="error" aria-live="polite">Please enter a subject</span>
                </div>
                <div <?php echo $form && $form->getError('message') ? ' class="invalid"' : ''; ?>>
                    <textarea class="contact__form-textarea" name="message" id="message" placeholder="Message" required><?php echo $form && $form->hasErrors() ? $form->getInput('message') : ''; ?></textarea>
                    <span class="error" aria-live="polite">Please enter a message</span>
                </div>
                <div>
                    <button class="contact__form-submit" type="submit">Submit</button>
                </div>
            </form>
        </section>
        <div class="to-top">
            <a href="#">
                <i class="up-arrow"></i>
                <p>Back to Top</p>
            </a>
        </div>
    </div>
    <footer class="main-footer">
        <p>Sam Wiggins 2024</p>
    </footer>

    <script src="js/app.js"></script>
    <?php if ($dbConsoleError) {
        echo "<script>console.log('".str_replace("'", "\'", $dbConsoleError)."');</script>";
    } ?>
</body>

</html>