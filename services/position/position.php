<?php
function get_position_name($id) {
	
   $conn = db_connect();
   $query = "select name from position where id = '".$conn->real_escape_string($id)."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $row = $result->fetch_object();
   return $row->name;
}

function insert_position($name) {
	$conn = db_connect();   
    $query = "select id from position where name='".$conn->real_escape_string($name)."'";
    $result = $conn->query($query);
    if ((!$result) || ($result->num_rows!=0)) {
        return false;
    }
	
	$query = "INSERT INTO `position` (`id`, `name`) VALUES (NULL, '".$conn->real_escape_string($name)."')";
    $result = $conn->query($query);
    if (!$result) {
        return false;
    } else {
        return true;
    }
}

function get_positions() {
   $conn = db_connect();
   $query = "select id, name from position";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function delete_position($id) {
	
	$conn = db_connect();   
    $query = "select position_id from user where position_id='".$conn->real_escape_string($id)."'";

    $result = @$conn->query($query);
    if ((!$result) || (@$result->num_rows > 0)) {
        return false;
    }

    $query = "delete from position where id='".$conn->real_escape_string($id)."'";
    $result = @$conn->query($query);
    if (!$result) {
        return false;
    } else {
        return true;
    }
}

function update_position($id, $name) {
	
	$conn = db_connect();

    $query = "update position set name='".$conn->real_escape_string($name) ."' where id='".$conn->real_escape_string($id) ."'";
    $result = @$conn->query($query);
    if (!$result) {
        return false;
    } else {
        return true;
    }
}
?>
