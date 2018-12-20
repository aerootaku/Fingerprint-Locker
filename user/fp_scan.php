<?php

// Outputs all the result of shellcommand "ls", and returns
// the last output line into $last_line. Stores the return value
// of the shell command in $retval.

$last_line = system('sudo python search_fp.py');// Printing additional info

?>
