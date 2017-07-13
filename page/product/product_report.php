<?php include_once('../../header.php'); ?>

<table class="dataTable">
    <thead>
        <?php
        if (isset($_GET['customer_id'])) {
            echo "
    		<tr>
            		<th>PID</th>
            		<th>Name</th>
            		<th>Amount</th>
        	</tr>";
        } else {
            echo "
    		<tr>
            		<th>PID</th>
            		<th>Name</th>
            		<th>In</th>
            		<th>Out</th>
        	</tr>";
        }
        ?>	
    </thead>
    <tbody>
        <?php
        if (isset($_GET['customer_id'])) {
            $customer_id = $_GET['customer_id'];
            $query_items = mysqli_query($database->db, "SELECT distinct(product_id) FROM $database->product_item WHERE customer_id='$customer_id' AND status='out'");
            while ($list_items = mysqli_fetch_assoc($query_items)) {
                $product_id = $list_items['product_id'];
                $serial = $list_items['serial'];
                $name = get_product($product_id, 'name');

                $query_products_out = mysqli_query($database->db, "SELECT distinct(serial) FROM $database->product_item WHERE customer_id='$customer_id'");
                $product_out_amount = mysqli_num_rows($query_products_out);

                echo '
                        <tr>
                                <td>' . $product_id . '</td>
                                <td><a href="' . get_url('page') . '/product/product.php?product_id=' . $product_id . '">' . $name . '</a></td>
                                <td>' . $product_out_amount . '</td>
                        </tr>
                        ';
            }
        } else {
            $query_products = mysqli_query($database->db, "SELECT * FROM $database->products WHERE status='publish'");
            while ($list_products = mysqli_fetch_assoc($query_products)) {
                $product_id = $list_products['id'];
                $name = $list_products['name'];

                $query_products_in = mysqli_query($database->db, "SELECT * FROM $database->product_item WHERE product_id='$product_id' AND status='in'");
                $product_in_amount = mysqli_num_rows($query_products_in);

                $query_products_out = mysqli_query($database->db, "SELECT * FROM $database->product_item WHERE product_id='$product_id' AND status='out'");
                $product_out_amount = mysqli_num_rows($query_products_out);

                echo '
			<tr>
				<td>' . $product_id . '</td>
				<td><a href="' . get_url('page') . '/product/product.php?product_id=' . $product_id . '">' . $name . '</a></td>
				<td>' . $product_in_amount . '</td>
				<td>' . $product_out_amount . '</td>
			</tr>
			';
            }
        }
        ?>
    </tbody>
</table>


<?php include_once('../../footer.php'); ?>
