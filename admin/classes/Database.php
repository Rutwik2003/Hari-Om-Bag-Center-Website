<?php
$conShop = mysqli_connect("localhost","root","","olxpersonnalshop");
class Database
{
	private $con;
	public function connect(){
		$this->con = new Mysqli("localhost", "root" , "" , "olx");
		return $this->con;
	}
}
?>