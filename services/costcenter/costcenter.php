<?php
function get_costcenter_name($id) {
	
   $conn = db_connect();
   $query = "select name from costcenter where id = '".$conn->real_escape_string($id)."'";
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

function insert_costcenter($name) {
	$conn = db_connect();   
    $query = "select id from costcenter where name='".$conn->real_escape_string($name)."'";
    $result = $conn->query($query);
    if ((!$result) || ($result->num_rows!=0)) {
        return false;
    }
	
	$query = "INSERT INTO `costcenter` (`id`, `name`) VALUES (NULL, '".$conn->real_escape_string($name)."')";
    $result = $conn->query($query);
    if (!$result) {
        return false;
    } else {
        return true;
    }
}

function get_costcenters() {
   $conn = db_connect();
   $query = "select id, name from costcenter";
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

function delete_costcenter($id) {
	
	$conn = db_connect();   
    $query = "select costcenter_id from user where costcenter_id='".$conn->real_escape_string($id)."'";

    $result = @$conn->query($query);
    if ((!$result) || (@$result->num_rows > 0)) {
        return false;
    }

    $query = "delete from costcenter where id='".$conn->real_escape_string($id)."'";
    $result = @$conn->query($query);
    if (!$result) {
        return false;
    } else {
        return true;
    }
}

function update_costcenter($id, $name) {
	
	$conn = db_connect();

    $query = "update costcenter set name='".$conn->real_escape_string($name) ."' where id='".$conn->real_escape_string($id) ."'";
    $result = @$conn->query($query);
    if (!$result) {
        return false;
    } else {
        return true;
    }
}

function get_department_costcenter($id) {
	$conn = db_connect();
   
    $query = "
    SELECT department.id,
           department.name as name,
           costcenter.name as costcenter
    FROM department
    INNER JOIN costcenter ON costcenter.id = department.costcenter_id
	where costcenter_id='".$conn->real_escape_string($id)."'";
   
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
?>
