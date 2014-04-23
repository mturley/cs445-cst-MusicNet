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

  $("#login-form").submit(function(e) {
    e.preventDefault();
    var postdata = $("#login-form").serializeObject();
    postdata.fn = 'user_login';
    $(".please-wait").show();
    $.ajax({
      type: 'POST',
      url: 'backend.php',
      data: postdata,
      success: function(response) {
        $(".please-wait").hide();
        console.log("LOGIN SUCCESS!");
        document.location = 'musicnet.php'; // reload
      },
      error: function(response) {
        $(".please-wait").hide();
        bootbox.alert($.parseJSON(response.responseText).message);
      }
    });
  });

  if($("body").hasClass('user-page')) {
    $(".please-wait").show();
    $.ajax({
      type: 'GET',
      url: 'backend.php',
      data: {
        fn: 'get_user_by_id',
        user_id: urlParam('user_id')
      },
      success: function(response) {
        $(".please-wait").hide();
        $("#user-info").empty();
        var r = $.parseJSON(response);
        for(var key in r) $("<h4><strong>"+key+":&nbsp;</strong>&nbsp;"+r[key]+"</h4>").appendTo("#user-info");
      },
      error: function(response) {
        $(".please-wait").hide();
        bootbox.alert("Failed to load user data!  Error Message: "+$.parseJSON(response.responseText).message);
      }
    })
  }

  if($("body").hasClass('logout-page')) {
    $.ajax({
      type: 'POST',
      url: 'backend.php',
      data: {
        fn: 'user_logout'
      },
      success: function(response) {
        $(".please-wait").hide();
        document.location = 'musicnet.php'; // reload
      }
    });
  }

});
