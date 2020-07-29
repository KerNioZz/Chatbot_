<?php 
/* DATABASE Structure
CREATE TABLE `chat` (
	`id` INT NOT NULL AUTO_INCREMENT ,
	`pseudo` VARCHAR(255) NOT NULL ,
	`text` TEXT NOT NULL ,
	PRIMARY KEY  (`id`))
	ENGINE = InnoDB;
*/
include 'class.chatbot.php';
$chatbot = new Chatbot;

$db_host = "";
$db_name = "";
$db_user = "";
$db_pass = "";

$pdo = new PDO("mysql:host={$db_host};dbname={$db_name};charset=utf8", "{db_user}", "{db_pass}");



if (isset($_POST["pseudo"]) && !empty($_POST["pseudo"]) && isset($_POST["message"]) && !empty($_POST["message"])) {

	$pseudo = htmlspecialchars($_POST["pseudo"]);

	$message = nl2br(htmlspecialchars($_POST["message"]));

	$insmsg = $pdo->prepare("INSERT INTO chat(pseudo, message) VALUES (:pseudo, :message)");
	$insmsg->execute(array(
		"pseudo" => $pseudo,
		"message" => $message
	));
	$message = $chatbot->sayHello($message);
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Chat avec Chatbot</title>
</head>
<body>
	<div>
		<h1>Chat avec Chatbot</h1>
		<form method="POST" action="">
			<fieldset>
				<legend>Coordonnées</legend>
				<label for="pseudo">Pseudo</label><br />
				<input type="text" name="pseudo" /><br />
				<label for="message">Message</label><br />
				<textarea name="message"></textarea><br />
				<input type="submit" name="submit">
			</fieldset>
		</form>
	</div>
	<div>
		<h2>Messages</h2>
		<p>
			<?php $req_msgs = $pdo->query("SELECT * FROM chat ORDER BY id DESC");
			while ($show_msgs = $req_msgs->fetch()) { ?>
			 	<b><?= $show_msgs["pseudo"]?> :</b> <?= $show_msgs["message"]?><br />
			<?php } ?>
		</p>
	</div>
</body>
</html>
