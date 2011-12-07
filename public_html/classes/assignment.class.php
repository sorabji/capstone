<?php
	class Assignment extends Table
	{
		
		private $list_headers = array
		(
			"ID",
			"Section",
			"Assignment",
			"Points"
		);
		
		private $list_table_cols = array
		(
			"id", "sec_id", "title", "points_poss"
		);
		
		private $new_labels = array 
		(
			/*"Id",
			"Section ID",
			"Assignment Title",
			"Points Possible"*/
			
			"Section ID",
			"Assignment Title",
			"Points Possible"
			
		);
		
		private $new_post_vars = array
		(
			"ass_id",
			"section_id",
			"ass_title",
			"pts"
		);
		
		private $ID = "id"; // what's the id field of this table?
		
		public function __construct($ed_flag)
		{
			$this->ed_flag = $ed_flag;
		}

		
		public function list_display($resource) 
		{
			echo("<table border='1' >\n<tr>");
			
			foreach($this->list_headers as $head)
			{
				echo("<th>$head</th>\n");
			}
			
			if($this->ed_flag)
			{
				echo("<th colspan='2'>Admin</th>\n");
			}
			
			echo("</tr>");

			while($row = mysql_fetch_array($resource))
			{
			  echo("<tr>\n");
			  
			  foreach($row as $key => $value)
				{
					$row[$key] = stripslashes($value);
				}
				foreach($this->list_table_cols as $val) 
				{
					echo("<td valign='top'>$row[$val]</td>");
				}
				if($this->ed_flag)
				{
					echo("<td valign='top'><a href=assignment_edit.php?id={$row[$this->ID]}>Edit</a></td>\n");
					echo("<td valign='top'><a href=assignment_delete.php?id={$row[$this->ID]}>Delete</a></td>\n");
				}

			}
			echo("</tr>\n</table>");
		}
		public function new_display()
		{
			echo "<form id='form' name='form' action='' method='POST'>\n";
			echo "<p>All fields are required</p>\n";
			echo "<fieldset><legend>Assignment Info</legend>\n";
			echo "<div class='notes'>\n";
			echo "<h4>notes</h4>\n";
			echo "<p class='last'>This stuff needs to be filled in...so do it.</p>\n</div>\n";
			
			
			//Dropbox for sections?
			foreach($this->new_labels as $key => $val)
			{
				  echo "<div class='required'>\n";
				  echo "<label for='{$this->new_post_vars[$key]}'>";
				  echo $this->new_labels[$key];
				  echo "</label>\n";
			
					echo "<input class='inputText' type='text' name='{$this->new_post_vars[$key]}' id='{$this->new_post_vars[$key]}' />\n";
			}
			echo "<div class='submit'>\n";
			echo "<div><input type='submit' id='submit' name='submit' class='inputSubmit' value='Add assignment' />\n";
			echo "</div>\n</div>\n</fieldset>\n</form>";
			//echo($ret);
			
			
		}
		public function edit_display($id) 
		{
			
		}
		public function get_update_qry($vals) 
		{
			foreach($_POST AS $key => $value)
			{
				$_POST[$key] = $this->prep_sql($value);
			}
			
			//$base = "INSERT INTO `assignments` ( `id` ,  `sec_id` ,  `title` , `points_poss`)";
			//$fmt_str = "VALUES( '%s', '%s', '%s', '%s');";
			
			$base = "INSERT INTO assignments (sec_id, title, points_poss)";
						
			$fmt_str = "VALUES( '%s', '%s', '%s');";
			/*$res = sprintf($fmt_str, // can't just unpack?...hrm
				$vals[$this->new_post_vars[0]],
				$vals[$this->new_post_vars[1]],
				$vals[$this->new_post_vars[2]],
				$vals[$this->new_post_vars[3]]
				);*/
			$res = sprintf($fmt_str, $vals[$this->new_post_vars[0]], $vals[$this->new_post_vars[1]], $vals[$this->new_post_vars[2]]);
			$fin = $base . $res;

			return $fin;
		}
	}
?>