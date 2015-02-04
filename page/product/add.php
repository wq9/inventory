<?php include_once('../../header.php'); ?>

<?php
if (isset($_POST['btn_add_product'])) {
    $code = safety_filter($_POST['code']);
    $name = safety_filter($_POST['name']);
    $description = safety_filter($_POST['description']);
    $instruction = safety_filter($_POST['instruction']);
    $purchase_price = safety_filter($_POST['purchase_price']);
    $sale_price = safety_filter($_POST['sale_price']);

    $product_id = 0;
    $product_id = add_product($code, $name, $description, $instruction, $purchase_price, $sale_price);
    if ($product_id > 0) {
        echo '<script> window.location = "product.php?product_id=' . $product_id . '"; </script>';
    } else {
        alert_box('alert', get_lang('Error'));
    }
}
?>

<form name="form_add" id="form_add" action="" method="POST">
    <div class="row">
        <div class="six columns">
            <fieldset>
                <legend><?php lang('Add Product'); ?></legend>

                <label for="code"><?php lang('Product Code'); ?></label>
                <input type="text" name="code" id="code" class="required" maxlength="50" minlength="3" />

                <label for="name"><?php lang('Product Name'); ?></label>
                <input type="text" name="name" id="name" class="required" maxlength="50" minlength="3" />

                <label for="description"><?php lang('Product Description'); ?></label>
                <input type="text" name="description" id="description" class="" maxlength="50" minlength="3" />

                <label for="instruction"><?php lang('Product Instruction'); ?></label>
                <input type="text" name="instruction" id="instruction" class="" maxlength="50" minlength="3" />

                <div class="row">
                    <div class="six columns">
                        <label for="purchase_price"><?php lang('Purchase Price'); ?></label>
                        <input type="text" name="purchase_price" id="purchase_price" class="number just_money" placeholder="0.00" />
                    </div> <!-- /.six columns -->
                    <div class="six columns">
                        <label for="sale_price"><?php lang('Sale Price'); ?></label>
                        <input type="text" name="sale_price" id="sale_price" class="number just_money" placeholder="0.00" />
                    </div> <!-- /.six columns -->
                </div> <!-- /.row -->

                <div class="row">
                    <div class="four columns">
                        <input type="submit" name="btn_add_product" id="btn_add_product" class="button" value="<?php lang('Add'); ?> &raquo;" />
                    </div> <!-- /.four columns -->
                </div> <!-- /.row -->
                <p></p>
            </fieldset>    
        </div> <!-- /.four columns -->
    </div> <!-- /.row -->


</form>

<?php include_once('../../footer.php'); ?>
