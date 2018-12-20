<?php
echo '<pre>';
// Outputs all the result of shellcommand "ls", and returns
// the last output line into $last_line. Stores the return value
// of the shell command in $retval.

$last_line = system('python relay.py --pin 21');
// Printing additional info
echo '</pre>';

system('sudo touch enroll.py');
?>
