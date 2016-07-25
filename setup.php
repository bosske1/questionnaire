<?php

//echo shell_exec('./setup.sh');

//echo shell_exec('./setup.sh ');
/*
php app/console cache:clear --env=prod --no-debug
php app/console assetic:dump --env=prod --no-debug
*/

$dir = getcwd();

echo $dir;

var_dump(shell_exec('/usr/bin/php ' . $dir . '/../app/console cache:clear --env=prod --no-debug 2>&1'));
var_dump(shell_exec('/usr/bin/php ' . $dir . '/../app/console assetic:dump --env=prod --no-debug 2>&1'));

// Queries:

/**
 * UPDATE `questionnaire`.`question` SET `content`='Antworten Sie noch oder manipulieren Sie schon?' WHERE `id`='37';
 */

$queries = array(
	"UPDATE `question` SET `content`='Antworten Sie noch oder manipulieren Sie schon?' WHERE `id`='37';",
	"INSERT INTO `question_potential_answer` (`question_id`, `answer`, `created_at`, `next_question_id`, `real_answer`) VALUES ('177', 'today', NOW(), '', 'today');
"
);

$dbh = new PDO('mysql:host=localhost;dbname=usr_web4_5', 'web', 'jptr249689x');
foreach ($queries as $query) {
	$stmt = $dbh->query($query);
}