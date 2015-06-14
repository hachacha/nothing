<?php
echo "hi friend <br />";
echo "<br />";
echo "THIS IS FOR THE SETS";
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
 |       |      (##(o)(o)#######)    |      |     | V  \/  \---.    .----/  \----.
 |   (##)          |      |      \(o)(o)_        /       \          /
 C   .-(o)(o)--_)    ,_C     (##)    |    (o)(o)       <__.   .--\ /(o)(o)__.
  | |.___|    /___,   (##)     C      _)     _C         /     \     ()     /
  |  \__/       \     (#)       | ,___|     /____,   )  \      >   (C_)   <
  /_____\        |    |         |   /         \     /----'    /___\____/___\
 /_____/ \       OOOOOO        /____\          ooooo             /|    |\
/         \     /      \      /      \        /     \           /        \
 
                           The Whole Damn Family
 </pre>
EOT;
$command = escapeshellcmd('python housekeeping/populate_set.py');
$output = shell_exec($command);
echo "<br>it should have worked. go check the site.";


?>
