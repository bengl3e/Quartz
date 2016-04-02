<?php
    if(isset($_POST['delete_id'] && !empty($_POST['delete_id']))) {
      $delete_id = mysql_real_escape_string($_POST['delete_id']);
      $result = mysql_query("DELETE FROM KeepScores WHERE `id`=".$delete_id);
      if($result !== false) {
        echo 'true';
      }
    }