<?php
include 'database.php';
include 'vsVoteMethods.php';
$stmt = $connection->prepare("SELECT COUNT(id) FROM data");
$stmt->execute();
$stmt->bind_result($rows);
$stmt->fetch();
$stmt->close();
echo var_dump($rows);
for ($i = 0; $i < $rows; $i++) {
	vsUpdateVotes($i);
}