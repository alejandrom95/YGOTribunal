<?php
class DBConn
{
	public function connect()
	{
		$mysqli = mysqli_connect('localhost', 'root', '', 'ygo_t');
		
		return $mysqli;
	}
}
?>