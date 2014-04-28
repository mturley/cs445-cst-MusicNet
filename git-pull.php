<?php

header('Content-type: text/plain');
system('whoami');

system('git -c user.name=mturley pull 2>&1');
echo "\nCompleted!";

?>
