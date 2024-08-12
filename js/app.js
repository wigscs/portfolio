
// Small screen slide out nav menu
const menuContainer = document.querySelector(".menu-container");
menuContainer.addEventListener('click', function(e) {
  if (e.target.classList.contains('menu-icon')) {
    menuContainer.classList.toggle('menu-container--collapsed');
  }
});

// Contact form validation using the constraint validation API
// https://developer.mozilla.org/en-US/docs/Learn/Forms/Form_validation#the_constraint_validation_api
const contactForm = document.querySelector('.contact__form');
if (contactForm) {
  contactForm.noValidate = true;
  function validateField(field) {
    if (field.checkValidity()) {
      // field is valid - remove class
      field.parentElement.classList.remove('invalid');
    } else {
      // field is invalid - add class
      field.parentElement.classList.add('invalid');
    }
  }

  function changeHandler(e) {
    validateField(e.target);
  }

  function submitHandler(e) {
    const form = e.target;
    const fields = Array.from(form.elements);

    // apply/remove invalid class
    fields.forEach(field => {
      validateField(field);
    });
    if (!form.checkValidity()) {
      // form is invalid - cancel submit
      e.preventDefault();
      e.stopImmediatePropagation();
    }
  }
  contactForm.addEventListener('submit', submitHandler);
  contactForm.addEventListener('focusout', changeHandler);
}