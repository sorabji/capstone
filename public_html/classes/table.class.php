<?php
abstract class Table {
  abstract protected function list_display($res);
  abstract protected function new_display();
  abstract protected function edit_display($id);

/* use sprintf(query, values**) to build query */
  abstract protected function get_update_qry($vals);

  protected function prep_sql($value){
    if(get_magic_quotes_gpc()){
      $value = stripslashes($value);
    }
    $value = "'" . mysql_real_escape_string($value) . "'";

    return($value);
  }
}
?>