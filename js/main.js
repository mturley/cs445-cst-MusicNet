$(document).ready(function() {

  $("#registration-form").submit(function(e) {
    // submit the registration form data via ajax
    e.preventDefault();
    var postdata = $("#registration-form").serializeObject();

    // validate inputs
    if(postdata.password != postdata.password_confirm) {
      bootbox.alert("Your passwords don't match.");
      return;
    }

    postdata.fn = 'register_new_user';
    $(".please-wait").show(); // show loading indicator
    $.ajax({
      type: 'POST',
      url: 'backend.php',
      data: postdata,
      success: function(response) {
        $(".please-wait").hide(); // hide loading indicator
        var r = $.parseJSON(response);
        bootbox.alert(r.message, function() {
          document.location = 'musicnet.php?page=user&user_id='+r.user_id;
        });
      },
      error: function(response) {
        $(".please-wait").hide(); // hide loading indicator
        bootbox.alert($.parseJSON(response.responseText).message);
      }
    });
  });

  $("#register-cancel").click(function(e) {
    e.preventDefault();
    document.location = 'musicnet.php'; // go home
  });

});
