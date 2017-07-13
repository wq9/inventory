<?php

/* ----------------------------------------------
  META
  ---------------------------------------------- */

/* ----- ADD META ----- */

function add_meta($ref_id, $title, $meta_key, $meta_value) {
    global $database;
    $ref_id = safety_filter($ref_id);
    $title = safety_filter($title);
    $key = safety_filter($meta_key);
    $value = safety_filter($meta_value);

    mysqli_query($database->db, "INSERT INTO $database->meta
		(ref_id, title, meta_key, meta_value)
		VALUES
		('$ref_id', '$title', '$meta_key', '$meta_value')");
    if (mysqli_affected_rows($database->db) > 0) {
        return true;
    } else {
        echo mysqli_error($database->db);
        return false;
    }
}

/* ----- UPDATE META ----- */

function update_meta($id, $ref_id, $title, $meta_key, $meta_value) {
    global $database;
    $id = trim(mysqli_real_escape_string($database->db, strip_tags($id)));
    $ref_id = trim(mysqli_real_escape_string($database->db, strip_tags($ref_id)));
    $title = trim(mysqli_real_escape_string($database->db, strip_tags($title)));
    $meta_key = trim(mysqli_real_escape_string($database->db, strip_tags($meta_key)));
    $meta_value = trim(mysqli_real_escape_string($database->db, strip_tags($meta_value)));

    if ($id == '') {
        if (mysqli_num_rows(mysqli_query($database->db, "SELECT * FROM $database->meta WHERE ref_id='$ref_id' AND title='$title' AND meta_key='$meta_key'")) > 0) {
            $update = mysqli_query($database->db, "UPDATE $database->meta SET
					ref_id='$ref_id',
					title='$title',
					meta_key='$meta_key',
					meta_value='$meta_value'
					WHERE
					ref_id='$ref_id' AND title='$title' AND meta_key='$meta_key'");
            if (mysqli_affected_rows($database->db) > 0) {
                return true;
            } else {
                if ($update) {
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            return add_meta($ref_id, $title, $meta_key, $meta_value);
        }
    } else {
        $update = mysqli_query($database->db, "UPDATE $database->meta SET
				ref_id='$ref_id',
				title='$title',
				meta_key='$meta_key',
				meta_value='$meta_value'
				WHERE id='$id'");
        if (mysqli_affected_rows($database->db) > 0) {
            return true;
        } else {
            if ($update) {
                return true;
            } else {
                return false;
            }
        }
    }
}

/* ----- DELETE META ----- */

function delete_meta($id, $title, $meta_key) {
    global $database;
    $id = trim(mysqli_real_escape_string($database->db, strip_tags($id)));
    $title = trim(mysqli_real_escape_string($database->db, strip_tags($title)));
    $meta_key = trim(mysqli_real_escape_string($database->db, strip_tags($meta_key)));

    if ($id == '') {
        mysqli_query($database->db, "DELETE FROM $database->meta WHERE title='$title' AND meta_key='$meta_key'");
        if (mysqli_affected_rows($database->db) > 0) {
            return true;
        } else {
            return false;
        }
    } else {
        mysqli_query($database->db, "DELETE FROM $database->meta WHERE id='$id'");
        if (mysqli_affected_rows($database->db) > 0) {
            return true;
        } else {
            return false;
        }
    }
}

/* ----- GET META ----- */

function get_meta($id, $ref_id, $title, $meta_key) {
    global $database;
    $id = safety_filter($id);
    $ref_id = safety_filter($ref_id);
    $title = safety_filter($title);
    $meta_key = safety_filter($meta_key);
    $meta['meta_value'] = '';

    if ($id == '') {
        $query = mysqli_query($database->db, "SELECT * FROM $database->meta WHERE ref_id='$ref_id' AND title='$title' AND meta_key='$meta_key'");
    } else {
        $query = mysqli_query($database->db, "SELECT * FROM $database->meta WHERE id='$id'");
    }
    while ($list = mysqli_fetch_assoc($query)) {
        $meta['meta_value'] = $list['meta_value'];
    }

    return $meta['meta_value'];
}

function meta($id, $ref_id, $title, $meta_key) {
    echo get_meta($id, $ref_id, $title, $meta_key);
}

?>