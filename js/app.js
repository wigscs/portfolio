
// Small screen slide out nav menu
const menuContainer = document.querySelector(".menu-container");
menuContainer.addEventListener('click', function(e) {
  if (e.target.classList.contains('menu-icon')) {
    menuContainer.classList.toggle('menu-container--collapsed');
  }
});

// Contact form validation using the constraint validation API
// https://developer.mozilla.org/en-US/docs/Learn/Forms/Form_validation#the_constraint_validation_api
// Get the contact form
const contactForm = document.querySelector('.contact__form');

// Check the contact form exists on this page
if (contactForm) {

  // Disable the browsers automatic validation
  contactForm.noValidate = true;

  // Checks a field is valid and toggles a class of invalid for the parent element of the field
  function validateField(field) {
    field.checkValidity() ? field.parentElement.classList.remove('invalid') : field.parentElement.classList.add('invalid');
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

// Typewriter effect
let i = 0;
const txt = 'Web Developer';
const speed = 100;
document.querySelector(".hero-header__subtitle").innerHTML = '';

function typeWriter() {
  if (i < txt.length) {
    document.querySelector(".hero-header__subtitle").innerHTML += txt.charAt(i);
    i++;
    setTimeout(typeWriter, speed);
  }
}
typeWriter();