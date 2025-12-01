$(document).ready(function() {
  $('#registrationForm').on('submit', function(e){
    e.preventDefault(); // Prevent default form submission

    // Simple front-end validation
    if($('#fname').val() == '' || $('#email').val() == '' || $('#phone').val() == ''){
      $('#message').html('<p style="color:red;">Please fill all required fields.</p>');
      return;
    }

    // Submit the form using AJAX to PHP
    $.ajax({
      url: 'process.php',
      type: 'POST',
      data: $(this).serialize(),
      success: function(response){
        $('#message').html(response);
        $('#registrationForm')[0].reset();
      },
      error: function(){
        $('#message').html('<p style="color:red;">Error submitting form.</p>');
      }
    });
  });
});
