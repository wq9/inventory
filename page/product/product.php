<?php include_once('../../header.php'); ?>


<?php
if (isset($_GET['product_id'])) {
    $product_id = safety_filter($_GET['product_id']);
} else {
    alert_box('alert', get_lang('No Product ID'));
}
?>

<?php
if (isset($_GET['success'])) {
    alert_box('success', get_lang('Successful'));
}

if (isset($_POST['btn_update_product'])) {
    $code = safety_filter($_POST['code']);
    $name = safety_filter($_POST['name']);
    $description = safety_filter($_POST['description']);
    $instruction = safety_filter($_POST['instruction']);
    $purchase_price = safety_filter($_POST['purchase_price']);
    $sale_price = safety_filter($_POST['sale_price']);
    $status = safety_filter($_POST['status']);

    $custom_field_1 = safety_filter($_POST['custom_field_1']);
    $custom_field_2 = safety_filter($_POST['custom_field_2']);
    $custom_field_3 = safety_filter($_POST['custom_field_3']);
    $custom_field_4 = safety_filter($_POST['custom_field_4']);
    $custom_field_5 = safety_filter($_POST['custom_field_5']);

    if (update_product(get_the_product('id'), $status, $code, $name, $description, $instruction, $purchase_price, $sale_price)) {
        update_meta('', get_the_product('id'), 'product', 'custom_field_1', $custom_field_1);
        update_meta('', get_the_product('id'), 'product', 'custom_field_2', $custom_field_2);
        update_meta('', get_the_product('id'), 'product', 'custom_field_3', $custom_field_3);
        update_meta('', get_the_product('id'), 'product', 'custom_field_4', $custom_field_4);
        update_meta('', get_the_product('id'), 'product', 'custom_field_5', $custom_field_5);

        echo '<script> window.location = "product.php?product_id=' . get_the_product('id') . '&success"; </script>';
    } else {
        alert_box('alert', get_lang('Error'));
    }
}
?>



<form name="form_update" id="form_update" action="?product_id=<?php the_product('id'); ?>" method="POST">
    <div class="row">
        <div class="four columns">
            <fieldset>
                <legend><?php lang('Update Product'); ?></legend>

                <label for="code"><?php lang('Product Code'); ?></label>
                <input type="text" name="code" id="code" class="required" maxlength="50" minlength="3" value="<?php the_product('code'); ?>" />

                <label for="name"><?php lang('Product Name'); ?></label>
                <input type="text" name="name" id="name" class="required" maxlength="50" minlength="3" value="<?php the_product('name'); ?>" />

                <label for="description"><?php lang('Product Description'); ?></label>
                <input type="text" name="description" id="description" class="" maxlength="50" minlength="3" value="<?php the_product('description'); ?>" />

                <label for="instruction"><?php lang('Product Instruction'); ?></label>
                <input type="text" name="instruction" id="instruction" class="" maxlength="50" minlength="3" value="<?php the_product('instruction'); ?>" />

                <div class="row">
                    <div class="six columns">
                        <label for="purchase_price"><?php lang('Purchase Price'); ?></label>
                        <input type="text" name="purchase_price" id="purchase_price" class="number just_money" placeholder="0.00" value="<?php money(get_the_product('purchase_price')); ?>" maxlength="20" />
                    </div> <!-- /.six columns -->
                    <div class="six columns">
                        <label for="sale_price"><?php lang('Sale Price'); ?></label>
                        <input type="text" name="sale_price" id="sale_price" class="number just_money" placeholder="0.00" value="<?php money(get_the_product('sale_price')); ?>" maxlength="20" />
                    </div> <!-- /.six columns -->
                </div> <!-- /.row -->

                <label for="status"><?php lang('Status'); ?></label>
                <select name="status" id="status">
                    <option value="publish" <?php
                    if (get_the_product('status') == 'publish') {
                        echo 'selected';
                    }
                    ?>><?php lang('Publish'); ?></option>
                    <option value="delete" <?php
                    if (get_the_product('status') == 'delete') {
                        echo 'selected';
                    }
                    ?>><?php lang('Delete'); ?></option>
                </select>

                <p></p>
            </fieldset>    
        </div> <!-- /.four columns -->
        <div class="four columns">
            <fieldset>
                <legend><?php lang('Product Detail'); ?></legend>

                <label for="custom_field_1"><?php lang('Custom Field'); ?> 1</label>
                <input type="text" name="custom_field_1" id="custom_field_1" class="" maxlength="255" minlength="1" value="<?php meta('', get_the_product('id'), 'product', 'custom_field_1'); ?>" />

                <label for="custom_field_2"><?php lang('Custom Field'); ?> 2</label>
                <input type="text" name="custom_field_2" id="custom_field_2" class="" maxlength="255" minlength="1" value="<?php meta('', get_the_product('id'), 'product', 'custom_field_2'); ?>" />

                <label for="custom_field_3"><?php lang('Custom Field'); ?> 3</label>
                <input type="text" name="custom_field_3" id="custom_field_3" class="" maxlength="255" minlength="1" value="<?php meta('', get_the_product('id'), 'product', 'custom_field_3'); ?>" />

                <label for="custom_field_4"><?php lang('Custom Field'); ?> 4</label>
                <input type="text" name="custom_field_4" id="custom_field_4" class="" maxlength="255" minlength="1" value="<?php meta('', get_the_product('id'), 'product', 'custom_field_4'); ?>" />

                <label for="custom_field_5"><?php lang('Custom Field'); ?> 5</label>
                <input type="text" name="custom_field_5" id="custom_field_5" class="" maxlength="255" minlength="1" value="<?php meta('', get_the_product('id'), 'product', 'custom_field_5'); ?>" />

                <p></p>
            </fieldset> 
        </div> <!-- /.four columns -->
        <div class="four columns">
            <fieldset>
                <legend><?php lang('Amount'); ?></legend>
                <div class="panel text-center">
                    <h1><?php echo $amount = get_calc_amount(get_the_product('id')); ?></h1>
                    <?php if ($amount > 0) : ?><a href="<?php url('page'); ?>/product/warehouse.php?product_id=<?php the_product('id'); ?>"><?php lang('Where in the store'); ?>?</a><?php endif; ?>
                </div>
            </fieldset>
        </div>
    </div> <!-- /.row -->

    <div class="row">
        <div class="four columns">
            <input type="submit" name="btn_update_product" id="btn_update_product" class="button secondary" value="<?php lang('Update'); ?>" />
        </div> <!-- /.four columns -->
        <div class="eight columns">
            <div style="float:right;">
                <script>
                    function popup_barcode_print()
                    {
                        window.open('<?php echo url(''); ?>/include/class/barcode/barcode_show.php?barcode=<?php the_product('code'); ?>&print=' + true + '', 'mywindow', 'menubar=0,resizable=0,width=300,height=300');
                    }
                </script>
                <ul class="button-group">
                    <li><a href="log.php?product_id=<?php the_product('id'); ?>" class="button secondary"><?php lang('Log'); ?></a></li>
                    <li><a href="product_item_list.php?product_id=<?php the_product('id'); ?>" class="button secondary"><?php lang('Items'); ?></a></li>
                </ul>
            </div>
        </div>
    </div> <!-- /.row -->

</form>


<?php include_once('../../footer.php'); ?>
