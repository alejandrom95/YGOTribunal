<?php
/*
This file contains the operations necessary to add the saved card information
*/



	//import contents of file that connects to the database
	require_once('DBConn.php');
	//create new instance of DBConn class
	$db = new DBConn();
	/*
	connect to the database
	assign connection to $dbConn
	*/
	$dbConn = $db->connect();

	//define variables that will be added into the database
	$main_card_type = '';
	$name = '';
	$effect_type = '';
	$card_type = '';
	$primary_type = '';
	$secondary_type = '';
	$attribute = '';
	$type = '';
	$stars = '';
	$attack = '';
	$defense = '';

	/*
	create array with char from a to z and append 'special' to it
	assign array to $json_file_chars
	*/
	$json_file_chars = range('a', 'z');
	array_push($json_file_chars, 'special');

	//traverse through $json_file_chars array for each value
	foreach ($json_file_chars as $replacement_value) {
		/*
		create path to the appropriate json file based on the array value
		assign path string to $file_contents_path
		*/
		$file_contents_path = 'misc/json/card_info_' . $replacement_value . '.json';
		/*
		get contents of the json file as string
		assign string to $file_contents
		*/
		$file_contents = file_get_contents($file_contents_path);
		/*
		decode the json of the $file_contents string into an associative array
		assign array to $json
		*/
		$json = json_decode($file_contents,true);
		//traverse through $json array for each value which represents a card
		foreach ($json as $card) {
			/*
			define $sqlStmt variable which will be used to store the query (string) that will be used to add 
			cards to the database
			*/
			$sqlStmt = '';
			/*
			define $main_card_type which is a string used to determine if a card is a Monster, Spell, or Trap
			*/
			$main_card_type = '';

			//Start: Retrive card information and assign to appropriate values

			if (isset($card['printouts']['Card type'][0]['fulltext'])) {
				$main_card_type = $card['printouts']['Card type'][0]['fulltext'];
			}
			$name = '';
			if (isset($card['printouts']['English name'][0])) {
				$name = $card['printouts']['English name'][0];
			}
			$effect_type = '';
			if (isset($card['printouts']['Effect type'][0]['fulltext'])) {
				foreach ($card['printouts']['Effect type'] as $key => $value) {
					$effect_type = $effect_type . '/' . $value['fulltext'];
				}
				$effect_type = substr($effect_type, 1);
				$effect_type = str_replace('-like', '', $effect_type);
			}
			$card_type = '';
			if (isset($card['printouts']['Card type'][0]['fulltext'])) {
				foreach ($card['printouts']['Card type'] as $key => $value) {
					$card_type = $card_type . '/' . $value['fulltext'];
				}
				$card_type = substr($card_type, 1);
				$card_type = str_replace('-like', '', $card_type);
			}
			$primary_type = '';
			if (isset($card['printouts']['Primary type'][0]['fulltext'])) {
				$primary_type = $card['printouts']['Primary type'][0]['fulltext'];
			}
			$secondary_type = '';
			if (isset($card['printouts']['Secondary type'][0]['fulltext'])) {
				$secondary_type = $card['printouts']['Secondary type'][0]['fulltext'];
			}
			$attribute = '';
			if (isset($card['printouts']['Attribute'][0]['fulltext'])) {
				$attribute = $card['printouts']['Attribute'][0]['fulltext'];
			}
			$type = '';
			if (isset($card['printouts']['Type'][0]['fulltext'])) {
				$type = $card['printouts']['Type'][0]['fulltext'];
			}
			$stars = '';
			if (isset($card['printouts']['Stars'][0])) {
				$stars = $card['printouts']['Stars'][0];
			}
			$attack = '';
			if (isset($card['printouts']['ATK'][0])) {
				$attack = $card['printouts']['ATK'][0];
			}
			$defense = '';
			if (isset($card['printouts']['DEF'][0])) {
				$defense = $card['printouts']['DEF'][0];
			}
			
			//End: Retrive card information and assign to appropriate values

			//if card is Monster, add card info to 'monster' table in db
			if(strpos($main_card_type, 'Monster') !== false) {
				$sqlStmt = "
					INSERT INTO monsters
					VALUES (
						'$name',
						'$effect_type',
						'$card_type',
						'$primary_type',
						'$secondary_type',
						'$attribute',
						'$type',
						'$stars',
						'$attack',
						'$defense'
					)
				";
				$query_result = mysqli_query($dbConn,$sqlStmt);
				mysqli_next_result($dbConn);
			}
			//if card is Spell, add card info to 'spell' table in db
			else if(strpos($main_card_type, 'Spell') !== false/*$main_card_type === 'Spell Card'*/) {
				$sqlStmt = "
					INSERT INTO spells
					VALUES (
						'$name',
						'$effect_type',
						'$card_type'
					)
				";
				$query_result = mysqli_query($dbConn,$sqlStmt);
				mysqli_next_result($dbConn);
			}
			//if card is Trap, add card info to 'trap table in db
			else if(strpos($main_card_type, 'Trap') !== false/*$main_card_type === 'Trap Card'*/) {
				$sqlStmt = "
					INSERT INTO traps
					VALUES (
						'$name',
						'$effect_type',
						'$card_type'
					)
				";
				$query_result = mysqli_query($dbConn,$sqlStmt);
				mysqli_next_result($dbConn);
			}
			//if there is an error determining the card, output the card information for debugging
			else {
				echo "////////////////////////<br>";
				echo "Error with card <br>";
				print_r($card);
				echo "////////////////////////<br>";
			}
		}//end foreach ($json as $card)
	}//end foreach ($json_file_chars as $replacement_value)
?>