<?php

//echo shell_exec('./setup.sh');

//echo shell_exec('./setup.sh ');
/*
php app/console cache:clear --env=prod --no-debug
php app/console assetic:dump --env=prod --no-debug
*/

$dir = getcwd();

echo $dir;

var_dump(shell_exec('/usr/bin/php ' . $dir . '/app/console cache:clear --env=prod --no-debug 2>&1'));
var_dump(shell_exec('/usr/bin/php ' . $dir . '/app/console assetic:dump --env=prod --no-debug 2>&1'));