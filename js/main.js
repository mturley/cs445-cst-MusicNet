$(document).ready(function() {

  window.loaders = 0;

  var page = urlParam('page');
  if(page == '') page = 'home';
  if(page != 'home') $(".navbar-brand").addClass('nothome');

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
    Util.startLoader(); // show loading indicator
    $.ajax({
      type: 'POST',
      url: 'backend.php',
      data: postdata,
      success: function(response) {
        Util.stopLoader(); // hide loading indicator
        var r = $.parseJSON(response);
        bootbox.alert(r.message, function() {
          document.location = 'musicnet.php?page=user&user_id='+r.user_id;
        });
      },
      error: function(response) {
        Util.stopLoader(); // hide loading indicator
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
    Util.startLoader();
    $.ajax({
      type: 'POST',
      url: 'backend.php',
      data: postdata,
      success: function(response) {
        Util.stopLoader();
        document.location = 'musicnet.php'; // reload
      },
      error: function(response) {
        Util.stopLoader();
        bootbox.alert($.parseJSON(response.responseText).message);
      }
    });
  });


  var Util = {
    startLoader: function() {
      window.loaders++;
      $(".please-wait").show();
    },
    stopLoader: function() {
      window.loaders--;
      if(window.loaders == 0) $(".please-wait").hide();
    },
    searchAjax: function(searchType, term, page, resultsElement) {
      Util.startLoader();
      $.ajax({
        type: 'GET',
        url: 'backend.php',
        data: {
          fn: 'search',
          searchType: searchType,
          term: term,
          page: page
        },
        success: function(response) {
          Util.stopLoader();
          Util.renderResultsTable(response, $(resultsElement));
          $("#search-results").show();
        },
        error: function(response) {
          Util.stopLoader();
          $(".press-enter").html('Search Failed!  Check PHP error logs...').show();
          console.log("AJAX ERROR: ",response);
        }
      });
    },
    renderResultsTable : function(response, table, nopaging) {
      var r = $.parseJSON(response);
      if(r.hasOwnProperty('type') && r.hasOwnProperty('term')) {
        $(".search-type").html(toTitleCase(r.type));
        $(".search-term").html(r.term);
      }
      clearTimeout(window.enterTimer);
      $(".press-enter").hide();
      $results = $(table);
      $results.data('page',r.page);
      $results.empty();
      var page_row_html = '<tr><th class="center" colspan="'+Object.keys(r.results[0]).length+'">';
      if(r.page != 0) page_row_html += '<a href="#" class="search-prev">&laquo; Prev</a>&nbsp;|&nbsp;';
      page_row_html += '<strong>Page '+(r.page - (-1))+'</strong>';
      if(r.results.length >= 50) page_row_html += '&nbsp;|&nbsp;<a href="#" class="search-next">Next &raquo;</a>';
      page_row_html += '</th></tr>';
      if(!nopaging && (r.page != 0 || r.results.length >= 50)) $(page_row_html).appendTo($results);
      var $th_row = $("<tr>");
      $.each(Object.keys(r.results[0]), function(idx, key) {
        if(isNaN(key) && key.indexOf('_id') == -1) {
          var niceKey = toTitleCase(key.replace('_',' '));
          $("<th>"+niceKey+"</th>").appendTo($th_row);
        }
      });
      $th_row.appendTo($results);
      $tbody = $("<tbody>").appendTo($results);
      $.each(r.results, function(idx, result) {
        var $result_row = $("<tr>");
        $.each(Object.keys(result), function(idx, key) {
          if(isNaN(key) && key.indexOf('_id') == -1) {
            $("<td data-key="+key+">"+result[key]+"</td>").appendTo($result_row);
          }
        });
        $result_row.appendTo($tbody);
        Util.linkify($result_row, result);
      });
      if(!nopaging && (r.page != 0 || r.results.length >= 50)) $(page_row_html).appendTo($tbody);
      $(table).show();
      $("#search-results").show();
      if($("#search-results").length != 0) {
        $("body").stop(); // stop scrolling if already scrolling
        $.scrollTo($("#search-results"), 200, { offset: -60 });
      }
    },
    repageSearch : function(pgdiff) {
      $(".press-enter").hide();
      clearTimeout(window.enterTimer);
      var type = $("#search-type").find('.btn-primary').data('searchType');
      var term = $("#searchinput").val();
      var page = $('#search-results').find('table').data('page')
      page += pgdiff;
      Util.searchAjax(type, term, page, $('#search-results').find('table'));
    },
    albumSongsAjax: function(album_id, page) {
      Util.startLoader();
      $.ajax({
        type: 'GET',
        url: 'backend.php',
        data: {
          fn: 'get_songs_by_album',
          album_id: album_id,
          page: page
        },
        success: function(response) {
          Util.stopLoader();
          Util.renderResultsTable(response, "#album-songs");
        },
        error: function(response) {
          Util.stopLoader();
          console.log("ERROR: ", response);
        }
      });
    },
    repageAlbumSongs: function(pgdiff) {
      $(".press-enter").hide();
      clearTimeout(window.enterTimer);
      var page = $("#album-songs").data('page');
      page += pgdiff;
      Util.albumSongsAjax(urlParam('album_id'), page, '#album-songs');
    },
    artistAlbumsAjax: function(artist_id, page) {
      Util.startLoader();
      $.ajax({
        type: 'GET',
        url: 'backend.php',
        data: {
          fn: 'get_albums_by_artist',
          artist_id: artist_id,
          page: page
        },
        success: function(response) {
          Util.stopLoader();
          Util.renderResultsTable(response, "#artist-albums");
        },
        error: function(response) {
          Util.stopLoader();
          console.log("ERROR: ", response);
        }
      });
    },
    repageArtistAlbums: function(pgdiff) {
      $(".press-enter").hide();
      clearTimeout(window.enterTimer);
      var page = $("#artist-albums").data('page');
      page += pgdiff;
      Util.artistAlbumsAjax(urlParam('artist_id'), page, '#artist-albums');
    },
    linkify: function(element, result) {
      $(element).find('[data-key*=_name], [data-key=title]').each(function() {
        var $t = $(this);
        var key = $t.data('key');
        var idkey = key.replace('_name','_id');
        if(key == 'title') idkey = 'song_id';
        if(result.hasOwnProperty(idkey)) {
          var id = result[idkey];
          var page = idkey.replace('_id','');
          var value = $t.html();
          $t.html('<a href="musicnet.php?page='+page+'&'+idkey+'='+id+'">'+value+'</a>');
        }
      });
    }
  };

  // page-specific scripts below:

  if(page == 'home') {

    Util.startLoader();
    $.ajax({
      type: 'GET',
      url: 'backend.php',
      data: {
        fn: 'get_suggested_songs',
        num_songs: 5
      },
      success: function(response) {
        Util.stopLoader();
        $("#relsongs").empty();
        var r = $.parseJSON(response);
        $ul = $("<ul>").appendTo($('#relsongs'));
        $.each(r.results, function(idx, song) {
          $('<li>The song <strong>'+song.title+'</strong> by the Artist <strong>'+song.artist_name
          + '</strong> on the Album <strong>'+song.album_name+'</strong></li>').appendTo($ul);
        });
      },
      error: function(error) {
        Util.stopLoader();
        console.log("ERROR: ", error);
      }
    });


  } else if(page == 'user') {


    Util.startLoader();
    $.ajax({
      type: 'GET',
      url: 'backend.php',
      data: {
        fn: 'get_object_by_id',
        type: 'user',
        user_id: urlParam('user_id')
      },
      success: function(response) {
        Util.stopLoader();
        var r = $.parseJSON(response);
        $("#user-info").empty();
        $.each(Object.keys(r), function(idx, key) {
          var niceKey = toTitleCase(key.replace('_',' '));
          $("<h4>"+key+":&nbsp;"+r[key]+"</h4>").appendTo("#user-info");
        });
      },
      error: function(response) {
        Util.stopLoader();
        bootbox.alert("Failed to load user data!  Error Message: "+$.parseJSON(response.responseText).message);
      }
    });


  } else if(page == 'logout') {

    Util.startLoader();
    $.ajax({
      type: 'POST',
      url: 'backend.php',
      data: {
        fn: 'user_logout'
      },
      success: function(response) {
        Util.stopLoader();
        document.location = 'musicnet.php'; // reload
      },
      error: function(response) {
        Util.stopLoader();
        document.location = 'musicnet.php';
      }
    });


  } else if(page == 'search') {

    $(".clear-search").click(function(e) {
      e.preventDefault();
      $("#search-results").slideUp();
      $("#searchinput").val('').focus();
      $.scrollTo(0, 200);
    });

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
      $("#search-results").hide();
      $(".press-enter").html('Searching...').show();
      var type = $("#search-type").find('.btn-primary').data('searchType');
      var term = $("#searchinput").val();
      var resultsPage = 0;
      Util.searchAjax(type, term, resultsPage, $('#search-results').find('table'));
    });

    $("body").on('click', '.search-prev', function(e) {
      e.preventDefault();
      var $table = $(this).closest('table');
      if($table.is('#search-results')) Util.repageSearch(-1);
      if($table.is('#album-songs')) Util.repageAlbumSongs(-1);
    });

    $("body").on('click', '.search-next', function(e) {
      e.preventDefault();
      var $table = $(this).closest('table');
      if($table.is('#search-results')) Util.repageSearch(1);
      if($table.is('#album-songs')) Util.repageAlbumSongs(1);
    });

    window.enterTimer = setTimeout(function() {
      $(".press-enter").fadeIn();
    }, 5000);


  } else if(page == 'concerts') {

    Util.startLoader();
    $.ajax({
      type: 'GET',
      url: 'backend.php',
      data: {
        fn: 'get_suggested_concerts',
        num_concerts: 5
      },
      success: function(response) {
        Util.stopLoader();
        $("#sugConcerts").empty();
        var r = $.parseJSON(response);
        $ul = $("<ul>").appendTo($('#sugConcerts'));
        $.each(r.results, function(idx, c) {
          $('<li><strong>'+c.name+'</strong> performing on '+c.date
          + ' at '+c.venue+' in ' +c.location+ ' </li>').appendTo($ul);
        });
      },
      error: function(error) {
        Util.stopLoader();
        console.log("ERROR: ", error);
      }
    });


    $("#search-type").find('button').click(function() {
      $(this).siblings().removeClass('btn-primary').addClass('btn-default');
      $(this).removeClass('btn-default').addClass('btn-primary');
      var type = $(this).data('searchType');
      if(type == "concert-artist") {
        $("#searchinput").attr('placeholder','Search by Artist');
      } else if(type == "concert-location") {
        $("#searchinput").attr('placeholder','Search by Location');
      } else if(type == "concert-date") {
        $("#searchinput").attr('placeholder','Search by Date');
      }
      $("#searchinput").val('').focus();
    });

    // SEARCH SUBMIT FUNCTION
    $("#search-form").on('submit', function(e) {
      e.preventDefault();
      $(".press-enter").html('Searching...').show();
      var type = $("#search-type").find('.btn-primary').data('searchType');
      var term = $("#searchinput").val();
      var resultsPage = 0;
      Util.searchAjax(type, term, resultsPage, $('#search-results').find('table'));
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


  } else if(page == 'friends') {

    Util.startLoader();
    $.ajax({
      type: 'GET',
      url: 'backend.php',
      data: {
        fn: 'get_suggested_friends',
        num_friends: 5
      },
      success: function(response) {
        Util.stopLoader();
        $("#sugFriends").empty();
        var r = $.parseJSON(response);
        $ul = $("<ul>").appendTo($('#sugFriends'));
        $.each(r.results, function(idx, friend) {
          $li = $('<li>');
          $('<a>').appendTo($li).attr('href','musicnet.php?page=user&user_id='+friend.user_id).html(friend.username);
          $('<span>').appendTo($li).html(', '+friend.age+' years old from '+friend.location);
          $li.appendTo($ul);
        });
      },
      error: function(error) {
        Util.stopLoader();
        console.log("ERROR: ", error);
      }
    });


    $("#search-type").find('button').click(function() {
      $(this).siblings().removeClass('btn-primary').addClass('btn-default');
      $(this).removeClass('btn-default').addClass('btn-primary');
      var type = $(this).data('searchType');
      if(type == "friends-username") {
        $("#searchinput").attr('placeholder','Search by Username');
      } else if(type == "friends-location") {
        $("#searchinput").attr('placeholder','Search by Location');
      }
      $("#searchinput").val('').focus();
    });

    // SEARCH SUBMIT FUNCTION
    $("#search-form").on('submit', function(e) {
      e.preventDefault();
      $(".press-enter").html('Searching...').show();
      var type = $("#search-type").find('.btn-primary').data('searchType');
      var term = $("#searchinput").val();
      var resultsPage = 0;
      Util.searchAjax(type, term, resultsPage, $('#search-results').find('table'));
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
    }, 3000);

  } else if(page == 'song') {

    Util.startLoader();
    $.ajax({
      type: 'GET',
      url: 'backend.php',
      data: {
        fn: 'get_object_by_id',
        type: 'song',
        song_id: urlParam('song_id')
      },
      success: function(response) {
        Util.stopLoader();
        var r = $.parseJSON(response);
        $("#song-info").empty();
        $.each(Object.keys(r), function(idx, key) {
          var niceKey = toTitleCase(key.replace('_',' '));
          $('<h4 data-key="'+key+'">'+niceKey+':&nbsp;'+r[key]+'</h4>').appendTo("#song-info");
        });
        console.log("song title", r.title, r);
        $(".song-title").html(r.title);
        Util.linkify('#song-info', r);
      },
      error: function(response) {
        Util.stopLoader();
        console.log("ERROR: ", response);
      }
    });

  } else if(page == 'album') {

    // get the album object itself.
    Util.startLoader();
    $.ajax({
      type: 'GET',
      url: 'backend.php',
      data: {
        fn: 'get_object_by_id',
        type: 'album',
        album_id: urlParam('album_id')
      },
      success: function(response) {
        Util.stopLoader();
        var r = $.parseJSON(response);
        $("#album-info").empty();
        $.each(Object.keys(r), function(idx, key) {
          var niceKey = toTitleCase(key.replace('_',' '));
          $('<h4 data-key="'+key+'">'+niceKey+':&nbsp;'+r[key]+'</h4>').appendTo("#album-info");
        });
        $(".album_name").html(r.album_name);
        $(".artist_link").html(r.artist_name);
        $(".artist_link").attr('href','musicnet.php?page=artist&artist_id='+r.artist_id);
        Util.linkify('#album-info', r);
      },
      error: function(response) {
        Util.stopLoader();
        console.log("ERROR: ", response);
      }
    });

    // get the songs in the album.
    Util.albumSongsAjax(urlParam('album_id'), 0);

  } else if(page == 'artist') {

    Util.startLoader();
    $.ajax({
      type: 'GET',
      url: 'backend.php',
      data: {
        fn: 'get_object_by_id',
        type: 'artist',
        artist_id: urlParam('artist_id')
      },
      success: function(response) {
        Util.stopLoader();
        var r = $.parseJSON(response);
        $("#artist-info").empty();
        $.each(Object.keys(r), function(idx, key) {
          var niceKey = toTitleCase(key.replace('_',' '));
          $('<h4 data-key="'+key+'">'+niceKey+':&nbsp;'+r[key]+'</h4>').appendTo("#artist-info");
        });
        $(".artist_name").html(r.artist_name);
        Util.linkify('#artist-info', r);
      },
      error: function(response) {
        Util.stopLoader();
        console.log("ERROR: ", response);
      }
    });

    // get the albums by this artist.
    Util.artistAlbumsAjax(urlParam('artist_id'), 0);

  }
  else if(page == 'sql') {

    $("#sql-form").on('submit', function(e) {
      e.preventDefault();
      $("#sql-results").hide();
      var rawSql = $("#rawsql").val();
      var resultsPage = 0;
      Util.startLoader();
      $.ajax({
        type: 'POST',
        url: 'backend.php',
        data: {
          fn: 'sql',
          sql: rawSql
        },
        success: function(response) {
          Util.stopLoader();
          Util.renderResultsTable(response, '#sql-results', true);
        },
        error: function(response) {
          Util.stopLoader();
          console.log("ERROR: ", response);
        }
      });
    });
  }// end of page-specific scripts

  Util.startLoader();
  // get the state of the current user and load ads.
  $.ajax({
    type: 'GET',
    url: 'backend.php',
    data: {
      fn: 'get_current_user'
    },
    success: function(response) {
      Util.stopLoader();
      var r = $.parseJSON(response);
      window.logged_in = r.logged_in;
      if(logged_in) {
        $(".data-username").html(r.user.username);
        // Load user-targeted ads
        Util.startLoader();
        $.ajax({
          type: 'GET',
          url: 'backend.php',
          data: {
            fn: 'get_ads',
            num_ads: 3
          },
          success: function(response) {
            Util.stopLoader();
            $("#ads").empty();
            var r = $.parseJSON(response);
            $.each(r.results, function(idx, ad) {
              $('<a href="'+ad.ad_link_href+'" target="_blank">'
               +'<img class="ad" src="'+ad.ad_img_src+'" />'
               +'</a>').appendTo($('#ads'));
            });
          },
          error: function(error) {
            Util.stopLoader();
            console.log("ERROR: ", error);
          }
        });
      }
    },
    error: function(response) {
      Util.stopLoader();
      bootbox.alert("Failed to load user data!  Error Message: "+$.parseJSON(response.responseText).message);
    }
  });

});
