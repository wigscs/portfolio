<?php 
$page = 'examples';
$title = "Sam Wiggins | Examples";
?><!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'views/head.php'; ?>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/github-dark.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/javascript.min.js"></script>

  <script>hljs.highlightAll();</script>
</head>
<body>
  <?php include 'views/nav.php'; ?>
  <?php include 'views/hero.php'; ?>
  
  <div class="container">
    <main id="examples">
      <h1>Code Examples</h1>
      <div>
        <h2>Constraint validation API</h2>
        <p>Client side Javascript form validation using the <a target="_blank" href="https://developer.mozilla.org/en-US/docs/Learn/Forms/Form_validation#the_constraint_validation_api">constraint validation API</a> to override the default browser validation.</p>
<pre class="theme-vs2015">
<code class="language-javascript">// Get the contact form
const contactForm = document.querySelector('.contact__form');

// Check the contact form exists on this page
if (contactForm) {

    // Disable the browsers automatic validation
    contactForm.noValidate = true;

    // Checks a field is valid and toggles a class of invalid for the parent element of the field
    function validateField(field) {
        if (field.checkValidity()) {
            field.parentElement.classList.remove('invalid');
        } else {
            field.parentElement.classList.add('invalid');
        }
    }

    // Call validateField on target
    function changeHandler(e) {
        validateField(e.target);
    }

    // Handle form submission
    function submitHandler(e) {
        const form = e.target;
        const fields = Array.from(form.elements);

        // Call validate for all fields
        fields.forEach(field => {
            validateField(field);
        });

        // Cancel submit if form is invalid
        if (!form.checkValidity()) {
            e.preventDefault();
            e.stopImmediatePropagation();
        }
    }

    // Register event listeners for form submission and field change
    contactForm.addEventListener('submit', submitHandler);
    contactForm.addEventListener('focusout', changeHandler);
}
</code>
</pre>
      </div>

      <div>
        <h2>Enquiries Model</h2>
        <p>PHP code for inserting an enquiry into the database using PDO prepared statements to prevent SQL injection.</p>
        <pre class="theme-vs2015">
          <code class="language-php">class Enquiries extends Model
{
    protected $table = 'enquiries';

    public function createEnquiry(array $input)
    {
        $sql = "INSERT INTO $this->table 
            (name, company, email, phone, message, marketing_preferences) VALUES 
            (:name, :company, :email, :phone, :message, :marketing_preferences)";

        $stmt = $this->db->prepare($sql);
        
        $stmt->bindValue(':name', $input['name'], PDO::PARAM_STR);
        $stmt->bindValue(':company', $input['company'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $input['email'], PDO::PARAM_STR);
        $stmt->bindValue(':phone', $input['phone'], PDO::PARAM_STR);
        $stmt->bindValue(':message', $input['message'], PDO::PARAM_STR);
        $stmt->bindValue(':marketing_preferences', $input['marketing_preferences'], PDO::PARAM_BOOL);

        $stmt->execute();
    }
}

          </code>
        </pre>
      </div>
    </main>

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
</body>
</html>