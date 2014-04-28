<?php

header('Content-type: text/plain');
system('whoami');

system('git pull 2>&1');
echo "\nCompleted!";

?>
