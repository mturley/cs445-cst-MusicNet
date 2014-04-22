<?php
  require 'Slim/Slim.php';
  \Slim\Slim::registerAutoloader();
  $app = new \Slim\Slim();
  
?>

<html>
<head></head>
<body>
<?php
  for($i=1; $i<=6; $i++) {
    echo "<h$i>Hello World!</h$i>";
  }
?>
</body>
</html>
