$(document).ready(function() {
  function isValidPassword(password) {
    const minLength = 8;
    const hasLetter = /[a-zA-Z]/.test(password);
    const hasNumber = /[0-9]/.test(password);
    const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);
    
    return password.length >= minLength && hasLetter && hasNumber && hasSpecialChar;
  }

  $('#password').on('input', function() {
    const password = $(this).val();
    if (password.length == 0) {
      $('#passwordMessage').hide();
      $('#submit').prop('disabled', false);
      $('#submit').css('background-color', '#5cb85c');
    }
    else if (isValidPassword(password)) {
      $('#passwordMessage').show();
      $('#passwordMessage').text('Password is valid').css('color', 'green');
      $('#submit').prop('disabled', false);
      $('#submit').css('background-color', '#5cb85c');
    } 
    else {
      $('#passwordMessage').show();
      $('#passwordMessage').text('Password must be at least 8 characters long and include at least one letter, one number, and one special character').css('color', 'red');
      $('#submit').prop('disabled', true);
      $('#submit').css('background-color', 'gray');
    }
  });
});
