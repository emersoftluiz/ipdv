<?php
function get_department_details($id) {
	if ((!$id) || ($id=='')) {
		return false;
    }
    $conn = db_connect();
    $query = "select * from department where id='".$conn->real_escape_string($id)."'";
    $result = @$conn->query($query);
    if (!$result) {
        return false;
    }
    $result = @$result->fetch_assoc();
    return $result;
}

function insert_department($name, $costcenter_id) {
	$conn = db_connect();  
	
	$query = "
	INSERT INTO `department` (`costcenter_id`, `name`)
	VALUES(
	'".$conn->real_escape_string($costcenter_id)."',
	'".$conn->real_escape_string($name)."')";
	
	//print $query;
		
    $result = $conn->query($query);
    if (!$result) {
        return false;
    } else {
        return true;
    }
}

function get_departments() {
	$conn = db_connect();
   
    $query = "
    SELECT department.id,
           department.name as name,
           costcenter.name as costcenter
    FROM department
    INNER JOIN costcenter ON costcenter.id = department.costcenter_id";
   
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

function delete_department($id) {
	
	$conn = db_connect(); 
    $query = "delete from department where id='".$conn->real_escape_string($id)."'";
    $result = @$conn->query($query);
    if (!$result) {
        return false;
    } else {
        return true;
    }
}

function update_department($id, $name, $costcenter_id) {
	
	$conn = db_connect();
		
	$query = "update department
			  set costcenter_id = '".$conn->real_escape_string($costcenter_id)."',
				  name = '".$conn->real_escape_string($name)."'
			  where id = '".$conn->real_escape_string($id)."'";
			  
	//var_dump($query);exit;

    $result = @$conn->query($query);
    if (!$result) {
        return false;
    } else {
        return true;
    }
}

function get_department_name($id) {
	
   $conn = db_connect();
   $query = "select name from department where id = '".$conn->real_escape_string($id)."'";
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

function get_users_department($id) {
	$conn = db_connect();
   
    $query = "
    SELECT user.id,
           user.name as name,
		   user.email as email,
           department.name as departamento
    FROM user
    INNER JOIN department ON department.id = user.department_id
	where department_id='".$conn->real_escape_string($id)."'";
   
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