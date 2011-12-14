<?php
include('../header.php');
$a = new Access(1,$root);
$a->do_eet();

$sql = "select * from quiz_grades where student_id = '".$a->get_user_name()."'";
$total_fmt = "select title, points_poss from quizzes where id = %d";
$course_fmt = "select course_id from sections where id = %d";
$res = mysql_query($sql);

echo "<p>Behold, the grades for quizzes that you have taken.</p>";


echo "<table border='1' id='grades'>";
echo "<thead><tr>";
echo "<th>Course</th>";
echo "<th>Quiz</th>";
echo "<th>Correct</th>";
echo "<th>Out Of</th>";
echo "<thead></tr>";
while($row = mysql_fetch_assoc($res)){
  $tmp = mysql_fetch_assoc(mysql_query(sprintf($total_fmt,$row['quiz_id'])));
  $course = mysql_fetch_assoc(mysql_query(sprintf($course_fmt,$row['sec_id'])));
  $total = $tmp['points_poss'];
  $course = $course['course_id'];
  echo "<tr><td>$course</td>";
  echo "<td>{$tmp['title']}</td>";
  echo "<td>{$row['points_received']}</td>";
  echo "<td>$total</td></tr>";
}
echo "</table>";
include('../footer.php');
?>