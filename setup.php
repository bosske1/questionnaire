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
	"INSERT INTO `question_potential_answer` (`question_id`, `answer`, `created_at`, `next_question_id`, `real_answer`) VALUES ('177', 'today', NOW(), '', 'today');",
	"INSERT INTO `question` (`created_by`, `questionnaire_id`, `title`, `description`, `content`, `type`, `created_at`, `next_question_id`, `tick_length`) VALUES ('1', '1', 'Before Stuff', 'Before', 'Einweisung', 'howto', '', '7', '60');",
	"update question q1
join question q2 on q2.type='howto'
 set q1.next_question_id=q2.id WHERE q1.type='registration';",
	"UPDATE `question` SET `type`='groupJobs' WHERE `id`='142';",
	"UPDATE `question` SET `next_question_id`='142' WHERE `id`='139';",
	"UPDATE `question_potential_answer` SET `real_answer`='1' WHERE `id`='580';",
	"UPDATE `question_potential_answer` SET `real_answer`='2' WHERE `id`='581';",
	"UPDATE `question_potential_answer` SET `real_answer`='3' WHERE `id`='582';",
	"UPDATE `question_potential_answer` SET `real_answer`='4' WHERE `id`='583';",
	"UPDATE `question_potential_answer` SET `real_answer`='5' WHERE `id`='584';",
	"UPDATE `question_potential_answer` SET `real_answer`='6' WHERE `id`='585';",
	"UPDATE `question_potential_answer` SET `real_answer`='7' WHERE `id`='586';",
	"UPDATE `question_potential_answer` SET `real_answer`='8' WHERE `id`='587';",
);

$dbh = new PDO('mysql:host=localhost;dbname=usr_web4_5', 'web', 'jptr249689x');
foreach ($queries as $query) {
	$stmt = $dbh->query($query);
}