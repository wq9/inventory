<?php include_once('../../header.php'); ?>

<table class="dataTable">
    <thead>
        <tr>
            <th><?php lang('PID'); ?></th>
            <th><?php lang('Code'); ?></th>
            <th><?php lang('Name'); ?></th>
            <th><?php lang('Description'); ?></th>
            <th><?php lang('Instruction'); ?></th>
            <th><?php lang('Amount'); ?></th>
            <th class="text-right"><?php lang('Purchase Price'); ?></th>
            <th class="text-right"><?php lang('Sale Price'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query_products = mysql_query("SELECT * FROM $database->products WHERE status='publish'");
        while ($list_products = mysql_fetch_assoc($query_products)) {
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
			<td>' . $products['code'] . '</td>
			<td><a href="' . get_url('page') . '/product/product.php?product_id=' . $products['id'] . '">' . $products['name'] . '</a></td>
			<td>' . $products['description'] . '</td>
			<td>' . $products['instruction'] . '</td>
			<td><a href="' . get_url('page') . '/product/product_item_list.php?product_id=' . $products['id'] . '">' . get_calc_amount($products['id']) . '</a></td>
			<td class="text-right">' . get_money($products['purchase_price']) . '</td>
			<td class="text-right">' . get_money($products['sale_price']) . '</td>
		</tr>
		';
        }
        ?>
    </tbody>
</table>


<?php include_once('../../footer.php'); ?>
