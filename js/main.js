$(document).ready(function() {

  var page = urlParam('page');
  if(page == '') page = 'home';

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


  var Util = {
      searchAjax: function(type, term, page, resultsElement) {
        $.ajax({
          type: 'GET',
          url: 'backend.php',
          data: {
            fn: 'search_'+type,
            term: term,
            page: page
          },
          success: function(response) {
            var r = $.parseJSON(response);
            var $results = $(resultsElement).find('.results');
            $results.empty();
            $(resultsElement).find('.term').html(term);
            if(r.results.length == 0) {
              $(".press-enter").html('No '+type+' found matching "'+term+'"').show();
            } else {
              $(".press-enter").hide();
              clearTimeout(window.enterTimer);
              $(resultsElement).data('page', page);
              var page_row_html = '<tr><th class="center" colspan="'+Object.keys(r.results[0]).length+'">';
              if(page != 0) page_row_html += '<a href="#" class="search-prev">&laquo; Prev</a>&nbsp;|&nbsp;';
              page_row_html += '<strong>Page '+(page - (-1))+'</strong>';
              if(r.results.length >= 50) page_row_html += '&nbsp;|&nbsp;<a href="#" class="search-next">Next &raquo;</a>';
              page_row_html += '</th></tr>';
              $(page_row_html).appendTo($results);
              var $th_row = $("<tr>");
              $.each(Object.keys(r.results[0]), function(idx, key) {
                if(isNaN(key)) $("<th>"+key+"</th>").appendTo($th_row);
              });
              $th_row.appendTo($results);
              $tbody = $("<tbody>").appendTo($results);
              $.each(r.results, function(idx, result) {
                var $result_row = $("<tr>");
                $.each(Object.keys(result), function(idx, key) {
                  if(isNaN(key)) $("<td>"+result[key]+"</td>").appendTo($result_row);
                });
                $result_row.appendTo($tbody);
              });
              $(page_row_html).appendTo($tbody);
              $("#search-results").slideDown();
            }
            $(".please-wait").hide();
          },
          error: function(response) {
            $(".press-enter").html('Search Failed!  Check PHP error logs...').show();
            console.log("AJAX ERROR: ",response);
          }
        });
      },
      repageSearch : function(pgdiff) {
        $(".please-wait").show();
        $(".press-enter").hide();
        clearTimeout(window.enterTimeout);
        var type = $("#search-type").find('.btn-primary').data('searchType');
        var term = $("#searchinput").val();
        var page = $("#search-results").data('page');
        page += pgdiff;
        if(term != "") Util.searchAjax(type, term, page, '#search-results');
      }
    };

  if(page == 'home') {
    // Recommended Songs for every page?
    $.ajax({
      type: 'GET',
      url: 'backend.php',
      data: {
        fn: 'get_suggested_songs',
        num_songs: 5
      },
      success: function(response) {
        $("#relsongs").empty();
        var r = $.parseJSON(response);
        $ul = $("<ul>").appendTo($('#relsongs'));
        $.each(r.results, function(idx, song) {
          $('<li>The song <strong>'+song.title+'</strong> by the Artist <strong>'+song.artist_name
          + '</strong> on the Album <strong>'+song.album_name+'</strong></li>').appendTo($ul);
        });
      },
      error: function(error) {
        console.log("ERROR: ", error);
      }
    });


  } else if(page == 'user') {


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
      $("#searchinput").val('').focus();
    });

    // SEARCH SUBMIT FUNCTION
    $("#search-form").on('submit', function(e) {
      e.preventDefault();
      $(".please-wait").show();
      $(".press-enter").html('Searching...').show();
      var type = $("#search-type").find('.btn-primary').data('searchType');
      var term = $("#searchinput").val();
      var page = 0;
      if(term != "") Util.searchAjax(type, term, page, '#search-results');
    });

    $("body").on('click', '.search-prev', function(e) {
      e.preventDefault();
      Util.repageSearch(-1);
    });

    $("body").on('click', '.search-next', function(e) {
      e.preventDefault();
      Util.repageSearch(1);
    });

    window.enterTimer = setTimeout(function() {
      $(".press-enter").fadeIn();
    }, 5000);


  } else if(page == 'concerts') {


    $("#search-type").find('button').click(function() {
      $(this).siblings().removeClass('btn-primary').addClass('btn-default');
      $(this).removeClass('btn-default').addClass('btn-primary');
      var type = $(this).data('searchType');
      if(type == "artist") {
        $("#searchinput").attr('placeholder','Search by Artist');
      } else if(type == "location") {
        $("#searchinput").attr('placeholder','Search by Location');
      } else if(type == "date") {
        $("#searchinput").attr('placeholder','Search by Date');
      }
      $("#searchinput").val('').focus();
    });


  } else if(page == 'friends') {


    $("#search-type").find('button').click(function() {
      $(this).siblings().removeClass('btn-primary').addClass('btn-default');
      $(this).removeClass('btn-default').addClass('btn-primary');
      var type = $(this).data('searchType');
      if(type == "username") {
        $("#searchinput").attr('placeholder','Search by Username');
      } else if(type == "location") {
        $("#searchinput").attr('placeholder','Search by Location');
      }
      $("#searchinput").val('').focus();
    });


  } // end of page-specific scripts

  // Ads for every page
  $.ajax({
    type: 'GET',
    url: 'backend.php',
    data: {
      fn: 'get_ads',
      num_ads: 2
    },
    success: function(response) {
      $("#ads").empty();
      var r = $.parseJSON(response);
      $.each(r.results, function(ad) {
        $('<a href="'+ad.ad_link_href+'" target="_blank">'
         +'<img class="ad" src="'+this.ad_img_src+'" />'
         +'</a>').appendTo($('#ads'));
      });
    },
    error: function(error) {
      console.log("ERROR: ", error);
    }
  });

});
