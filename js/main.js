$(document).ready(function() {

  var page = urlParam('page');

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
        document.location = 'musicnet.php'; // reload
      },
      error: function(response) {
        $(".please-wait").hide();
        bootbox.alert($.parseJSON(response.responseText).message);
      }
    });
  });

  if(page == 'user') {

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
        var r = $.parseJSON(response);
        if($("#user-info").is(':visible')) {
          $("#user-info").empty();
          for(var key in r) $("<h4><strong>"+key+":&nbsp;</strong>&nbsp;"+r[key]+"</h4>").appendTo("#user-info");
        }
      },
      error: function(response) {
        $(".please-wait").hide();
        bootbox.alert("Failed to load user data!  Error Message: "+$.parseJSON(response.responseText).message);
      }
    });

  } else if(page == 'logout') {

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

  } else if(page == 'search') {

    $("#search-type").find('button').click(function() {
      $(this).siblings().removeClass('btn-primary').addClass('btn-default');
      $(this).removeClass('btn-default').addClass('btn-primary');
      var type = $(this).data('searchType');
      if(type == "songs") {
        $("#searchinput").attr('placeholder','Search for a Song');
      } else if(type == "artists") {
        $("#searchinput").attr('placeholder','Search for an Artist');
      } else if(type == "albums") {
        $("#searchinput").attr('placeholder','Search for an Album');
      }
      $("#searchinput").focus();
    });

    // SEARCH SUBMIT FUNCTION
    $("#search-form").on('submit', function(e) {
      e.preventDefault();
      var term = $("#searchinput").val();
      $(".please-wait").show();
      $(".search-margin").animate({ height: 0 }, { complete: function() {
        $(".search-margin").addClass('hidden');
      } });
      $("#search-results").find('.term').html(term);
      $("#search-results").find('.results').html('Results Go Here<br>Results Go Here<br>Results Go Here<br>Results Go Here<br>Results Go Here<br>Results Go Here');
      $("#search-results").slideDown();
    });

    setTimeout(function() {
      $(".press-enter").fadeIn();
    }, 5000);

  }

});
