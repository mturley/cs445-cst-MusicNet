$(document).ready(function() {
  // this will run on every page
  $("#please-wait").modal({
    keyboard: false,
    show: false
  });

  var body = $(body);

  if(body.hasClass('register-page')) {
    // on the new user registration page

    console.log("WE'RE ON REGISTER PAGE");

    $("#submit").click(function(e) {
      // submit the registration form data via ajax
      e.preventDefault();
      var postdata = $("#registration-form").serializeObject();
      postdata.fn = 'register_new_user';
      $("#please-wait").modal('show');
      $.ajax({
        type: 'POST',
        url: 'backend.php',
        data: postdata,
        success: function(response) {
          console.log(arguments);
          $("#please-wait").modal('hide');
        },
        error: function(response) {
          console.log(arguments);
          $("#please-wait").modal('hide');
        }
      });
    });

    $("#cancel").click(function(e) {
      e.preventDefault();
      document.location = 'musicnet.php'; // go home
    });

  } // body.hasClass('register-page')
});
