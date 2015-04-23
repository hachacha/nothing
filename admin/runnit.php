<?php
echo "hi friend <br />";
echo "<br />";
echo <<<EOT
<pre> 
                          (####)
                        (#######)
                      (#########)
                     (#########)
                    (#########)
                   (#########)
   __&__          (#########)
  /     \        (#########)   |\/\/\/|     /\ /\  /\               /\
 |       |      (#########)    |      |     | V  \/  \---.    .----/  \----.
 |  (o)(o)       (o)(o)(##)    |      |      \_        /       \          /
 C   .---_)    ,_C     (##)    | (o)(o)       (o)(o)  <__.   .--\ (o)(o) /__.
  | |.___|    /___,   (##)     C      _)     _C         /     \     ()     /
  |  \__/       \     (#)       | ,___|     /____,   )  \      >   (C_)   <
  /_____\        |    |         |   /         \     /----'    /___\____/___\
 /_____/ \       OOOOOO        /____\          ooooo             /|    |\
/         \     /      \      /      \        /     \           /        \
 
                           The Whole Damn Family
 </pre>
EOT;
$command = escapeshellcmd('python housekeeping/populate.py');
$output = shell_exec($command);
echo "<br>it should have worked. go check the site.";


?>
