<?php

header('Content-type: text/plain');
system('whoami');

system('git pull 2>&1');

system('ssh-keygen 2>%1')
echo "\nCompleted!";

?>
