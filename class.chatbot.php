<?php 
/**
* @author Kévin BENTO, 17-year-old student
* @param string db_host, db_name, db_user, db_pass Connection parameters to your Database
*/
class Chatbot {

	public function sayHello() {
		$db_host = "";
		$db_name = "";
		$db_user = "";
		$db_pass = "";
		$pdo = new PDO("mysql:host={$db_host};dbname={$db_name};charset=utf8", "{db_user}", "{db_pass}");
		$hello = preg_match("#Hello bot!#", $_POST['message']);
		if ($hello) {
			$pseudo_bot = "Bot";
			$message_bot = "Hello!";

			$ins_bot = $pdo->prepare("INSERT INTO chat(pseudo, message) VALUES(:pseudo_bot, :message_bot)");
			$ins_bot->execute(array(
				"pseudo_bot" => $pseudo_bot,
				"message_bot" => $message_bot
			));
		}
	}

	/* 
	public function chatBot() {
		$pdo = new PDO("mysql:host={$db_host};dbname={$db_name};charset=utf8", "{db_user}", "{db_pass}");
		$place = preg_match("#String to search#", $_POST['message']);
		if ($place) {
			$pseudo_bot = "Bot";
			$message_bot = "String to print";

			$ins_bot = $pdo->prepare("INSERT INTO chat(pseudo, message) VALUES(:pseudo_bot, :message_bot)");
			$ins_bot->execute(array(
				"pseudo_bot" => $pseudo_bot,
				"message_bot" => $message_bot
			));
		}
	}
	*/
}


?>
