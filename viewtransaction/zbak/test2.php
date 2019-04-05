<?php

echo 'Hello World <br>';

$text = '("21.0282 105.825986" , "21.0282 105.831168" , "21.023103 105.835782" , "21.02144 105.829366" , "21.024645 105.824323")';

$pat = '/"[^"]+"/';
//preg_match($pat , $text , $matches);

preg_match_all($pat , $text , $matches);

echo $matches[0][2];
?>