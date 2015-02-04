<?php include_once('../../header.php'); ?>


<?php
if (isset($_GET['item_id'])) {
    $item_id = safety_filter($_GET['item_id']);
} else {
    alert_box('alert', get_lang('No Item ID'));
}
?>

<?php
if (isset($_GET['success'])) {
    alert_box('success', get_lang('Successful'));
}

if (isset($_POST['btn_update_product'])) {
    $serial = safety_filter($_POST['serial']);
    $expire_date = safety_filter($_POST['expire_date']);
    $status = safety_filter($_POST['status']);
    $shelf = safety_filter($_POST['shelf']);
    $status = safety_filter($_POST['status']);

    if (update_product_item(get_the_product_item('id'), $status, $serial, $expire_date, $shelf)) {
        echo '<script> window.location = "product_item.php?item_id=' . get_the_product_item('id') . '&success"; </script>';
    } else {
        alert_box('alert', get_lang('Error'));
    }
}
?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<script>
    $(function () {
        $("#expire_date").datepicker({dateFormat: 'yy-mm-dd'});
    });
</script>

<form name="form_update" id="form_update" action="?item_id=<?php the_product_item('id'); ?>" method="POST">
    <div class="row">
        <div class="four columns">
            <fieldset>
                <legend><?php lang('Update Product Item'); ?></legend>

                <label for="serial"><?php lang('Product Serial'); ?></label>
                <input type="text" name="serial" id="serial" class="required" maxlength="50" minlength="3" value="<?php the_product_item('serial'); ?>" />

                <label for="expire_date"><?php lang('Product Expire Date'); ?></label>
                <input type="text" name="expire_date" id="expire_date" class="required" maxlength="50" minlength="3" value="<?php the_product_item('expire_date'); ?>" />

                <label for="shelf"><?php lang('Shelf'); ?></label>
                <input type="text" name="shelf" id="shelf" class="required" maxlength="50" minlength="3" value="<?php the_product_item('shelf'); ?>" />

                <label for="customer_id"><?php lang('Customer ID'); ?></label>
                <input type="text" name="customer_id" id="customer_id" class="" maxlength="50" minlength="3" value="<?php the_product_item('customer_id'); ?>" />

                <label for="status"><?php lang('Status'); ?></label>
                <select name="status" id="status">
                    <option value="in" <?php
                    if (get_the_product_item('status') == 'in') {
                        echo 'selected';
                    }
                    ?>><?php lang('in'); ?></option>
                    <option value="out" <?php
                    if (get_the_product_item('status') == 'out') {
                        echo 'selected';
                    }
                    ?>><?php lang('out'); ?></option>
                </select>

                <p></p>
            </fieldset>    
        </div> <!-- /.four columns -->
    </div> <!-- /.four columns -->
</div> <!-- /.row -->

<div class="row">
    <div class="four columns">
        <input type="submit" name="btn_update_product" id="btn_update_product" class="button secondary" value="<?php lang('Update'); ?>" />
    </div> <!-- /.four columns -->
    <div class="eight columns">
        <div style="float:right;">
            <ul class="button-group">
                <li><a href="log.php?product_id=<?php the_product_item('id'); ?>" class="button secondary"><?php lang('Log'); ?></a></li>
            </ul>
        </div>
    </div>
</div> <!-- /.row -->

</form>


<?php include_once('../../footer.php'); ?>
