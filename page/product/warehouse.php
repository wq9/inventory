<?php include_once('../../header.php'); ?>

<?php
if (isset($_GET['product_id'])) {
    $product_id = safety_filter($_GET['product_id']);
}
?>

<table class="dataTable">
    <thead>
        <tr>
            <th width="1"></th>
            <th><?php lang('Product Name'); ?></th>
            <th><?php lang('Shelf'); ?></th>
            <th class="text-right"><?php lang('Amount'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $amount_total = 0;
        if (isset($_GET['the_shelf'])) {
            $shelf = $_GET['the_shelf'];
            $query_product_amount = mysql_query("SELECT distinct(product_id) FROM $database->product_item WHERE shelf='$shelf'AND status='in'");
            while ($list_products = mysql_fetch_assoc($query_product_amount)) {
                $product_id = $list_products['product_id'];
                $query_items = mysql_query("SELECT * FROM $database->product_item WHERE product_id='$product_id' AND shelf='$shelf' AND status='in'");
                $amount = mysql_num_rows($query_items);
                echo '
			<tr>
				<td></td>
				<td><a href="' . get_url('page') . '/product/product.php?product_id=' . $product_id . '">' . get_product($product_id, 'name') . '</a></td>
				<td><a href="' . get_url('page') . '/product/warehouse.php?the_shelf=' . $shelf . '">' . $shelf . '</a></td>
				<td class="text-right">' . $amount . '</td>
			</tr>
			';
                $amount_total = $amount_total + $amount;
            }
        } else if (isset($_GET['product_id'])) {
            $product_id = $_GET['product_id'];
            $query_product_amount = mysql_query("SELECT distinct(shelf) FROM $database->product_item WHERE product_id='$product_id' AND status='in'");
            while ($list_products = mysql_fetch_assoc($query_product_amount)) {
                $shelf = $list_products['shelf'];
                $query_items = mysql_query("SELECT * FROM $database->product_item WHERE product_id='$product_id' AND shelf='$shelf'AND status='in'");
                $amount = mysql_num_rows($query_items);
                echo '
		<tr>
			<td></td>
			<td><a href="' . get_url('page') . '/product/product.php?product_id=' . $product_id . '">' . get_product($product_id, 'name') . '</a></td>
			<td>' . $shelf . '</td>
			<td class="text-right">' . $amount . '</td>
		</tr>
		';
                $amount_total = $amount_total + $amount;
            }
        } else {
            $query_shelf = mysql_query("SELECT distinct(shelf) FROM $database->product_item WHERE status='in'");
            while ($list_shelfs = mysql_fetch_assoc($query_shelf)) {
                $shelf = $list_shelfs['shelf'];
                //echo $shelf .'</br>';
                $query_shelf_product = mysql_query("SELECT distinct(product_id) FROM $database->product_item WHERE shelf='$shelf'AND status='in'");
                while ($list_products = mysql_fetch_assoc($query_shelf_product)) {

                    $product_id = $list_products['product_id'];
                    //echo $product_id + ' '.$shelf.'</br>';
                    $query_items = mysql_query("SELECT * FROM $database->product_item WHERE product_id='$product_id' AND shelf='$shelf'AND status='in'");
                    $amount = mysql_num_rows($query_items);
                    echo '
		<tr>
			<td></td>
			<td><a href="' . get_url('page') . '/product/product.php?product_id=' . $product_id . '">' . get_product($product_id, 'name') . '</a></td>
			<td><a href="' . get_url('page') . '/product/warehouse.php?the_shelf=' . $shelf . '">' . $shelf . '</a></td>
			<td class="text-right">' . $amount . '</td>
		</tr>
		';
                }
            }
        }
        ?>
    </tbody>
    <?php if (isset($_GET['the_shelf']) || isset($_GET['product_id'])) : ?>
        <tfoot>
            <tr>
                <th width="1"></th>
                <th></th>
                <th></th>
                <th class="text-right">Total items of <? echo $_GET['the_shelf'];?> : <?php echo $amount_total; ?></th>
            </tr>
        </tfoot>
    <?php endif; ?>
</table>


<?php include_once('../../footer.php'); ?>
