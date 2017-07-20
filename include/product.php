<?php

/* ----------------------------------------------
  ADD PRODUCT
  ---------------------------------------------- */

function add_product($code, $name, $description, $instruction, $purchase_price, $sale_price) {
    global $database;
    $code = safety_filter($code);
    $name = safety_filter($name);
    $description = safety_filter($description);
    $instruction = safety_filter($instruction);
    $purchase_price = safety_filter($purchase_price);
    $sale_price = safety_filter($sale_price);

    if (!is_money_format($purchase_price)) {
        alert_box('alert', get_lang('Price not available'));
        return false;
    }
    if (!is_money_format($sale_price)) {
        alert_box('alert', get_lang('Price not available'));
        return false;
    }
    mysqli_query($database->db, "INSERT INTO product 
	(status, code, name, description, instruction, purchase_price, sale_price)
	VALUES
	('publish', '$code', '$name', '$description', '$instruction', '$purchase_price', '$sale_price')
	");
    if (mysqli_affected_rows($database->db) > 0) {
        $product_id = mysqli_insert_id($database->db);
        add_log(get_the_current_user('id'), $product_id, '', 'input', 'PRODUCT-IN');
        return $product_id;
    } else {
        return false;
    }
}

/* ----------------------------------------------
  UPDATE PRODUCT
  ---------------------------------------------- */

function update_product($id, $status, $code, $name, $description, $instruction, $purchase_price, $sale_price) {
    global $database;
    $id = safety_filter($id);
    $status = safety_filter($status);
    $code = safety_filter($code);
    $name = safety_filter($name);
    $description = safety_filter($description);
    $instruction = safety_filter($instruction);
    $purchase_price = safety_filter($purchase_price);
    $sale_price = safety_filter($sale_price);

    if (!is_money_format($purchase_price)) {
        alert_box('alert', get_lang('Price not available'));
        return false;
    }
    if (!is_money_format($sale_price)) {
        alert_box('alert', get_lang('Price not available'));
        return false;
    }

    $update = mysqli_query($database->db, "UPDATE $database->products SET
	status='$status', 
	code='$code', 
	name='$name',
	description='$description',
	instruction='$instruction',
	purchase_price='$purchase_price', 
	sale_price='$sale_price'
	WHERE
	id='$id'
	");
    if (mysqli_affected_rows($database->db) > 0) {
        add_log(get_the_current_user('id'), $id, '', 'update', "UPDATE $database->products SET
        	status='$status', 
        	code='$code', 
        	name='$name',
        	description='$description',
        	instruction='$instruction',
        	purchase_price='$purchase_price', 
        	sale_price='$sale_price'
        	WHERE
        	id='$id'
        	");
        return true;
    } else {
        if ($update == true) {
            return true;
        } else {
            echo mysqli_error($database->db);
            return false;
        }
    }
}

function update_product_item($id, $status, $serial, $expire_date, $shelf) {
    global $database;
    $id = safety_filter($id);
    $status = safety_filter($status);
    $serial = safety_filter($serial);
    $expire_date = safety_filter($expire_date);
    $shelf = safety_filter($shelf);

    $update = mysqli_query($database->db, "UPDATE $database->product_item SET
        status='$status', 
        serial='$serial', 
        expire_date='$expire_date',
        shelf='$shelf'
        WHERE
        id='$id'
        ");
    if (mysqli_affected_rows($database->db) > 0) {
        add_log(get_the_current_user('id'), '', $serial, 'update', "UPDATE $database->product_item SET
        	status='$status', 
        	serial='$serial', 
        	expire_date='$expire_date',
        	shelf='$shelf'
        	WHERE
        	id='$id'
        	");
        return true;
    } else {
        if ($update == true) {
            return true;
        } else {
            echo mysqli_error($database->db);
            return false;
        }
    }
}

/* ----------------------------------------------
  GET THE PRODUCT
  ---------------------------------------------- */
if (isset($_GET['product_id']) or isset($_POST['product_id'])) {
    if (isset($_GET['product_id'])) {
        $product_id = safety_filter($_GET['product_id']);
    } else if (isset($_POST['product_id'])) {
        $product_id = safety_filter($_POST['product_id']);
    }

    $query_product = mysqli_query($database->db, "SELECT * FROM $database->products WHERE id='$product_id'");
    while ($list_product = mysqli_fetch_assoc($query_product)) {
        $product['id'] = $list_product['id'];
        $product['status'] = $list_product['status'];
        $product['code'] = $list_product['code'];
        $product['name'] = $list_product['name'];
        $product['description'] = $list_product['description'];
        $product['instruction'] = $list_product['instruction'];
        $product['purchase_price'] = $list_product['purchase_price'];
        $product['sale_price'] = $list_product['sale_price'];
    }

    function get_the_product($value) {
        global $product;
        return $product[$value];
    }

    function the_product($value) {
        echo get_the_product($value);
    }

}

/* ----------------------------------------------
  GET THE PRODUCT ITEM
  ---------------------------------------------- */
if (isset($_GET['item_id']) or isset($_POST['item_id'])) {
    if (isset($_GET['item_id'])) {
        $item_id = safety_filter($_GET['item_id']);
    } else if (isset($_POST['item_id'])) {
        $item_id = safety_filter($_POST['item_id']);
    }

    $query_item = mysqli_query($database->db, "SELECT * FROM $database->product_item WHERE id='$item_id'");
    while ($list_item = mysqli_fetch_assoc($query_item)) {
        $item['id'] = $list_item['id'];
        $item['product_id'] = $list_item['product_id'];
        $item['serial'] = $list_item['serial'];
        $item['expire_date'] = $list_item['expire_date'];
        $item['shelf'] = $list_item['shelf'];
        $item['status'] = $list_item['status'];
    }

    function get_the_product_item($value) {
        global $item;
        return $item[$value];
    }

    function the_product_item($value) {
        echo get_the_product_item($value);
    }

}


/* ----------------------------------------------
  GET PRODUCT
  ---------------------------------------------- */

function get_product($product_id, $value) {
    global $database;
    $query_product = mysqli_query($database->db, "SELECT * FROM $database->products WHERE id='$product_id'");
    while ($list_product = mysqli_fetch_assoc($query_product)) {
        $product['id'] = $list_product['id'];
        $product['status'] = $list_product['status'];
        $product['code'] = $list_product['code'];
        $product['name'] = $list_product['name'];
        $product['description'] = $list_product['description'];
        $product['instruction'] = $list_product['instruction'];
        $product['purchase_price'] = $list_product['purchase_price'];
        $product['sale_price'] = $list_product['sale_price'];
    }

    return $product[$value];
}

function get_product_item($item_id, $value) {
    global $database;
    $query_item = mysqli_query($database->db, "SELECT * FROM $database->item WHERE id='$item_id'");
    while ($list_item = mysqli_fetch_assoc($query_item)) {
        $item['id'] = $list_item['id'];
        $item['product_id'] = $list_item['product_id'];
        $item['serial'] = $list_item['serial'];
        $item['expire_date'] = $list_item['expire_date'];
        $item['shelf'] = $list_item['shelf'];
        $item['status'] = $list_item['status'];
    }

    return $item[$value];
}

function product($product_id, $value) {
    echo get_product($product_id, $value);
}

function item($item_id, $value) {
    echo get_product_item($item_id, $value);
}

/* ----------------------------------------------
  PRODUCT BOX
  ---------------------------------------------- */

function box_product_list($product_id, $product_code) {
    global $database;
    $array_product = array();

    echo '<div id="box_product_list" class="reveal-modal large">
	<table class="dataTable">
	<thead>
    	<tr>
            <th>' . get_lang("PID") . '</th>
            <th>' . get_lang("Code") . '</th>
            <th>' . get_lang("Name") . '</th>
            <th>' . get_lang("Description") . '</th>
            <th>' . get_lang("Instruction") . '</th>
            <th class="text-right">' . get_lang("Purchase Price") . '</th>
            <th class="text-right">' . get_lang("Sale Price") . '</th>
        </tr>
	</thead>
    <tbody>
	';

    $query_products = mysqli_query($database->db, "SELECT * FROM $database->products WHERE status='publish'");
    while ($list_products = mysqli_fetch_assoc($query_products)) {
        $products['id'] = $list_products['id'];
        $products['status'] = $list_products['status'];
        $products['code'] = $list_products['code'];
        $products['name'] = $list_products['name'];
        $products['description'] = $list_products['description'];
        $products['instruction'] = $list_products['instruction'];
        $products['purchase_price'] = $list_products['purchase_price'];
        $products['sale_price'] = $list_products['sale_price'];

        echo '
		<tr>
			<td>' . $products['id'] . '</td>
			<td><a href="#" class="fnc close-reveal-modal" onClick="product_select(\'' . $products['id'] . '\', \'' . $products['code'] . '\');">' . $products['code'] . '</a></td>
			<td>' . $products['name'] . '</td>
			<td>' . $products['description'] . '</td>
			<td>' . $products['instruction'] . '</td>
			<td class="text-right">' . get_money($products['purchase_price']) . '</td>
			<td class="text-right">' . get_money($products['sale_price']) . '</td>
		</tr>
		';
    }

    echo '
		</tbody>
	</table>
	<a class="x close-reveal-modal">&#215;</a></div>';

    echo '
	<script>
		function product_select(id, code)
		{
			document.getElementById("' . $product_id . '").value = id;
			document.getElementById("' . $product_code . '").value = code;
		}
	</script>
	';
}

/* ----------------------------------------------
  PRODUCT AMOUNT
  ---------------------------------------------- */

function product_amount($input_output, $product_id, $serial, $expire_date, $shelf, $amount) {
    global $database;
    $input_output = safety_filter($input_output);
    $product_id = safety_filter($product_id);
    $serial = safety_filter($serial);
    $expire_date = safety_filter($expire_date);
    $shelf = safety_filter($shelf);
    $amount = safety_filter($amount);

    if ($input_output == 'input') {
        $query_amount = mysqli_query($database->db, "SELECT * FROM $database->product_item WHERE product_id='$product_id' AND serial='$serial'");
        if (mysqli_num_rows($query_amount) > 0) {
            alert_box('alert', get_lang('Product item exists'));
            return false;
        } else {
            mysqli_query($database->db, "INSERT INTO $database->product_item (product_id, serial, expire_date, shelf, status) VALUES ('$product_id', '$serial', '$expire_date', '$shelf', 'in')");
            if (mysqli_affected_rows($database->db) > 0) {
                $query_item = mysqli_query($database->db, "SELECT * FROM $database->product_item WHERE serial='$serial'");
                while ($list_products = mysqli_fetch_assoc($query_item)) {
                    add_log(get_the_current_user('id'), $list_products['id'], $serial, $input_output, "ITEM-IN");
                }
                return true;
            } else {
                return false;
            }
        }
    } else if ($input_output == 'output') {
        $query_amount = mysqli_query($database->db, "SELECT * FROM $database->product_item WHERE serial='$serial'");
        if (mysqli_num_rows($query_amount) > 0) {
            $item_query = mysqli_query($database->db, "SELECT * FROM $database->product_item WHERE serial='$serial' AND status = 'out'");
            if (mysqli_num_rows($item_query) > 0) {
                alert_box('alert', get_lang('Product item has removed already'));
                return false;
            }
            $item_query = mysqli_query($database->db, "SELECT * FROM $database->product_item WHERE serial='$serial' AND status = 'in' AND expire_date !='0000-00-00' AND expire_date < current_date()");
            if (mysqli_num_rows($item_query) > 0) {
                add_log(get_the_current_user('id'), $product_id, $serial, $input_output, "EXPIRED");
                alert_box('alert', get_lang('Product item was expired'));
                mysqli_query($database->db, "UPDATE $database->product_item SET status='out' WHERE serial='$serial'");
                return false;
            }
            mysqli_query($database->db, "UPDATE $database->product_item SET status='out' WHERE serial='$serial'");
            if (mysqli_affected_rows($database->db) > 0) {
                add_log(get_the_current_user('id'), $product_id, $serial, $input_output, "ITEM-OUT");
                return true;
            } else {
                return false;
            }
        } else {
            add_log(get_the_current_user('id'), $product_id, $serial, $input_output, "Product item [$serial] does not exist");
            alert_box('alert', get_lang('Product item does not exist'));
            return false;
        }
    }
}

/* ----------------------------------------------
  PRODUCT CALCULATE THE AMOUNT
  ---------------------------------------------- */

function get_calc_amount($product_id) {
    global $database;

    $amount = 0;
    $query_product_amount = mysqli_query($database->db, "SELECT * FROM $database->product_item WHERE product_id='$product_id' AND status='in'");
    while ($list_product_amount = mysqli_fetch_assoc($query_product_amount)) {
        $amount = $amount + 1;
    }

    return $amount;
}

function calc_amount($product_id) {
    echo get_calc_amount($product_id);
}

?>
