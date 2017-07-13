<?php

/* ----------------------------------------------
  ADD LOG
  ---------------------------------------------- */

function add_log($user_id, $product_id, $serial, $type, $text) {
    global $database;
    $user_id = safety_filter($user_id);
    $product_id = safety_filter($product_id);
    $serial = safety_filter($serial);
    $type = safety_filter($type);
    $text = safety_filter($text);
    $date = date("Y-m-d H:i:s");

    mysqli_query($database->db, "INSERT INTO $database->log 
	(date, user_id, product_id, serial, type, text)
	VALUES
	('$date', '$user_id', '$product_id', '$serial',  '$type', '$text')");
    if (mysqli_affected_rows($database->db) > 0) {
        return true;
    } else {
        echo mysqli_error($database->db);
        return false;
    }
}

?>
