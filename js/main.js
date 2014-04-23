$(document).ready(function() {

  $("#register-submit").click(function(e) {
    // submit the registration form data via ajax
    e.preventDefault();
    var postdata = $("#registration-form").serializeObject();
    postdata.fn = 'register_new_user';
    $(".please-wait").show(); // show loading indicator
    $.ajax({
      type: 'POST',
      url: 'backend.php',
      data: postdata,
      success: function(response) {
        console.log(arguments);
        $(".please-wait").hide(); // hide loading indicator
      },
      error: function(response) {
        console.log(arguments);
        $(".please-wait").hide(); // hide loading indicator
      }
    });
  });

  $("#register-cancel").click(function(e) {
    e.preventDefault();
    document.location = 'musicnet.php'; // go home
  });

});
