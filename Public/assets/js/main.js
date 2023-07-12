$(document).ready(function(){
  $('#carousel').find('.carousel-item img').css('height', $('#carousel').css('height'))
});

// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
  'use strict';

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation');

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms).forEach((form) => {
    form.addEventListener('submit', (event) => {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
    }, false);
  });
})();

$('a[data-bs-toggle="list"]').on('shown.bs.tab', function (e) {
  $('#page-title').html(e.target.text);
});

$(window).on('load', function () {
  
    $('#error-dialog').modal('show');
});

$(':radio').change(function () {
  document.getElementById('rate').value = this.value;
});