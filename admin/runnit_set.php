<?php
echo "hi friend <br />";
echo "<br />";
echo "THIS IS FOR THE SETS";
echo <<<EOT
<pre> 
IT'S FOR DAMN SETS
NOT CONSTANTS.
                           The Whole Damn Family
 </pre>
EOT;
$command = escapeshellcmd('python housekeeping/populate_set.py');
$output = shell_exec($command);
echo "<br>it should have worked. go check the site.";


?>
