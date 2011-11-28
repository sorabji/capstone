<?php

class message{
	var $userid='';
	var $messages= array();
	var $dateformat='';
	
	//make duh cuntstructor
	
	function message($user, $date="d.m.y - H:i"){
		$this->userid=$user;
		$this->dateformat= $date;
		}
		
	//get messages for user
	function getMessages($type=0){
		$sql = "SELECT * FROM emails WHERE 'to' = '".$this->userid." ORDER BY 'created'";
		$result= mysql_query($sql) or die (mysql_error());
		if(mysql_num_rows($result)){
			$i=0;
			//reset
			$this->messages=array();
			//Are there messages? IF SO, GOGITEM!
			while($row = mysql_fetch_assoc($result)){
				$this->messages[$i]['id']=$row['id'];
				$this->messages[$i]['title']=$row['title'];
				$this->messages[$i]['body']=$row['body']
			 