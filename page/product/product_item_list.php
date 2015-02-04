<?php include_once('../../header.php'); ?>

<table class="dataTable">
    <thead>
        <tr>
            <th><?php lang('PID'); ?></th>
            <th><?php lang('Name'); ?></th>
            <th><?php lang('Serial'); ?></th>
            <th><?php lang('Expire Date'); ?></th>
            <th><?php lang('Shelf'); ?></th>
            <th><?php lang('Sale Price'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query_products = '';
        if (isset($_GET['product_id'])) {
            $product_id = $_GET['product_id'];
            $query_products = mysql_query("SELECT * FROM $database->product_item WHERE product_id='$product_id' AND status='in'");
        } else {
            $query_products = mysql_query("SELECT * FROM $database->product_item WHERE status='in'");
        }
        while ($list_products = mysql_fetch_assoc($query_products)) {
            $products['id'] = $list_products['id'];
            $products['product_id'] = $list_products['product_id'];
            $products['serial'] = $list_products['serial'];
            $products['shelf'] = $list_products['shelf'];
            $products['expire_date'] = $list_products['expire_date'];
            $products['sale_price'] = get_product($products['product_id'], 'sale_price');

            echo '
		<tr>
			<td>' . $products['product_id'] . '</td>
			<td><a href="' . get_url('page') . '/product/product.php?product_id=' . $products['product_id'] . '">' . get_product($products['product_id'], 'name') . '</a></td>
			<td><a href="' . get_url('page') . '/product/product_item.php?item_id=' . $products['id'] . '">' . $products['serial'] . '</a></td>
			<td>' . $products['expire_date'] . '</td>
			<td>' . $products['shelf'] . '</td>
			<td>' . get_money($products['sale_price']) . '</td>
		</tr>
		';
        }
        ?>
    </tbody>
</table>


<?php include_once('../../footer.php'); ?>
