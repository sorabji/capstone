<?php




class messages {
    var $userid = '';
    var $messages = array();
    var $dateformat = '';

    //Cuntstructor
    function __construct($user,$date="m.d.Y - H:i") {
        $this->userid = $user; 
        $this->dateformat = $date;
    }
    
    //git dose messages vato
    function getmessages($type=0) {
        
        switch($type) {
            case "0": $sql = "SELECT * FROM emails WHERE `recipient` = '".$this->userid."' && `to_viewed` = '0' && `to_deleted` = '0' ORDER BY `created` DESC"; break; // New messages
            case "1": $sql = "SELECT * FROM emails WHERE `recipient` = '".$this->userid."' && `to_viewed` = '1' && `to_deleted` = '0' ORDER BY `to_vdate` DESC"; break; // Read messages
            case "2": $sql = "SELECT * FROM emails WHERE `sender` = '".$this->userid."' ORDER BY `created` DESC"; break; // Sent messages
            case "3": $sql = "SELECT * FROM emails WHERE `recipient` = '".$this->userid."' && `to_deleted` = '1' ORDER BY `to_ddate` DESC"; break; // Deleted messages
            default: $sql = "SELECT * FROM emails WHERE `recipient` = '".$this->userid."' && `to_viewed` = '0' ORDER BY `created` DESC"; break; // New messages
        }
	
        $result= mysql_query($sql);
		
    
        if(mysql_num_rows($result)) {
            $i=0;
            // reset the array
            $this->messages = array();
            // if yes, fetch ALL of them!
            while($row = mysql_fetch_assoc($result)) {
                $this->messages[$i]['id'] = $row['id'];
                $this->messages[$i]['subject'] = $row['subject'];
                $this->messages[$i]['message'] = $row['message'];
                $this->messages[$i]['fromid'] = $row['sender'];
                $this->messages[$i]['toid'] = $row['recipient'];
                $this->messages[$i]['sender'] = $this->getusername($row['sender']);
                $this->messages[$i]['recipient'] = $this->getusername($row['recipient']);
                $this->messages[$i]['from_viewed'] = $row['from_viewed'];
                $this->messages[$i]['to_viewed'] = $row['to_viewed'];
                $this->messages[$i]['from_deleted'] = $row['from_deleted'];
                $this->messages[$i]['to_deleted'] = $row['to_deleted'];
                $this->messages[$i]['from_vdate'] = date($this->dateformat, strtotime($row['from_vdate']));
                $this->messages[$i]['to_vdate'] = date($this->dateformat, strtotime($row['to_vdate']));
                $this->messages[$i]['from_ddate'] = date($this->dateformat, strtotime($row['from_ddate']));
                $this->messages[$i]['to_ddate'] = date($this->dateformat, strtotime($row['to_ddate']));
                $this->messages[$i]['created'] = date($this->dateformat, strtotime($row['created']));
                $i++;
            }
        } else {
            return false;
        }
    }
    
    
    function getusername($userid) {
	
        $sql = "SELECT username FROM people WHERE `id` = ".$userid." LIMIT 1";
        $result = mysql_query($sql);
        // Check the ID
        if(mysql_num_rows($result)) {     
            $row = mysql_fetch_row($result);
            return $row[0];
        } else {
            return "MissingNo";
        }
    }
    
    // Get a specified message
    function getmessage($message) {
	
        $sql = "SELECT * FROM emails WHERE `id` = '".$message."' && (`sender` = '".$this->userid."' || `recipient` = '".$this->userid."') LIMIT 1";
        $result = mysql_query($sql);
        if(mysql_num_rows($result)) {
            //reset
            $this->messages = array();
            //GOGOGO!
            $row = mysql_fetch_assoc($result);
            $this->messages[0]['id'] = $row['id'];
            $this->messages[0]['subject'] = $row['subject'];
            $this->messages[0]['message'] = $row['message'];
            $this->messages[0]['fromid'] = $row['sender'];
            $this->messages[0]['toid'] = $row['recipient'];
            $this->messages[0]['sender'] = $this->getusername($row['sender']);
            $this->messages[0]['recipient'] = $this->getusername($row['recipient']);
            $this->messages[0]['from_viewed'] = $row['from_viewed'];
            $this->messages[0]['to_viewed'] = $row['to_viewed'];
            $this->messages[0]['from_deleted'] = $row['from_deleted'];
            $this->messages[0]['to_deleted'] = $row['to_deleted'];
            $this->messages[0]['from_vdate'] = date($this->dateformat, strtotime($row['from_vdate']));
            $this->messages[0]['to_vdate'] = date($this->dateformat, strtotime($row['to_vdate']));
            $this->messages[0]['from_ddate'] = date($this->dateformat, strtotime($row['from_ddate']));
            $this->messages[0]['to_ddate'] = date($this->dateformat, strtotime($row['to_ddate']));
            $this->messages[0]['created'] = date($this->dateformat, strtotime($row['created']));
        } else {
            return false;
        }
    }
    

    function getuserid($username) {
        $sql = "SELECT id FROM people WHERE username = '".$username."' LIMIT 1";
        $result = mysql_query($sql);
		//echo($sql);
        if(mysql_num_rows($result)) {
            $row = mysql_fetch_row($result);
			//var_dump($row);
            return $row[0];
			//echo mysql_error;
        } else {
            return false;
        }
    }
    
    // Set message as viewed
    function viewed($message) {
        $sql = "UPDATE emails SET `to_viewed` = '1', `to_vdate` = NOW() WHERE `id` = '".$message."' LIMIT 1";
        return (@mysql_query($sql)) ? true:false;
    }
    
    // Delete
    function deleted($message) {
        $sql = "UPDATE emails SET `to_deleted` = '1', `to_ddate` = NOW() WHERE `id` = '".$message."' LIMIT 1";
		//echo $sql;
        return (@mysql_query($sql)) ? true:false;
    }
    
    // Add a new PM
    function sendmessage($to,$title,$message) {
        $to = $this->getuserid($to);
        $sql = "INSERT INTO emails SET `recipient` = '".$to."', `sender` = '"
			.$this->userid."', `subject` = '".$title."', `message` = '".$message."', `created` = NOW()";
		return (@mysql_query($sql)) ? true:false;
    }
    
    // Text rendering
    function render($message) {
        $message = strip_tags($message, '');
        $message = stripslashes($message); 
        $message = nl2br($message);
        return $message;
    }

}

?>