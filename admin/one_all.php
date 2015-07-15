<?php
echo "hi friend <br />";
echo "<br />";
echo <<<EOT
THIS IS FOR MAKING CONSTANT ALWAYS RANDOM ALWAYS.
EOT;
$command = escapeshellcmd('python housekeeping/one_all.py');
$output = shell_exec($command);
echo "<br>it should have worked. go check the site.";


?>
