<div id="ads">Loading Ads...</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php echo RES_PATH; ?>/js/vendor/jquery-1.11.0.min.js"><\/script>')</script>

<script src="<?php echo RES_PATH; ?>/js/vendor/bootstrap.min.js"></script>

<script src="<?php echo RES_PATH; ?>/js/plugins.js"></script>
<script src="<?php echo RES_PATH; ?>/js/main.js"></script>

<?php
  if($logged_in) {
?>
    <script>
      $(document).ready(function() {

        // load the profile data for the logged in user

        $(".please-wait").show();

        $.ajax({
          type: 'GET',
          url: 'backend.php',
          data: {
            fn: 'get_user_by_id',
            user_id: '<?php echo $_SESSION['user_id'] ?>'
          },
          success: function(response) {
            $(".please-wait").hide();
            var r = $.parseJSON(response);
            $(".data-username").html(r.username);
          },
          error: function(response) {
            $(".please-wait").hide();
            bootbox.alert("Failed to load user data!  Error Message: "+$.parseJSON(response.responseText).message);
          }
        });

      });
    </script>
<?php
  }
?>

</body>
</html>
