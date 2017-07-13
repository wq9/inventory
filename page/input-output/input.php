<?php include_once('../../header.php'); ?>

<?php
if (isset($_GET['input'])) {
    $input_output = 'input';
} else if (isset($_GET['output'])) {
    $input_output = 'output';
} else {
    alert_box('alert', get_lang('No Input-Output Value'));
    exit;
}
?>



<?php
$shelf = '';
if (isset($_POST['btn_submit'])) {
    $continue = true;
    $product_id = safety_filter($_POST['product_id']);
    $product_code = safety_filter($_POST['product_code']);
    $serial = safety_filter($_POST['serial']);
    $expire_date = safety_filter($_POST['expire_date']);
    $shelf = safety_filter($_POST['shelf']);
    $amount = safety_filter($_POST['amount']);

    if ($product_id == '') {
        $query_product = mysqli_query($database->db, "SELECT * FROM $database->products WHERE status='publish' AND code='$product_code'");
        while ($list_product = mysqli_fetch_assoc($query_product)) {
            $product_id = $list_product['id'];
        }
    }

    if ($product_id == '') {
        $query_product = mysqli_query($database->db, "SELECT * FROM $database->product_item WHERE serial='$serial' AND status='in'");
        while ($list_product = mysqli_fetch_assoc($query_product)) {
            $product_id = $list_product['id'];
        }
    }

    if ($product_id == '') {
        $continue = false;
        if ($input_output == 'input') {
            alert_box('warn', get_lang('Please select a product'));
        } else {
            alert_box('alert', get_lang('Item not found'));
        }
    }

    if ($continue == true) {
        if (product_amount($input_output, $product_id, $serial, $expire_date, $shelf, $amount)) {
            alert_box('success', get_lang('Succesful'));
        }
    }
}
?>

<style>
    #product_code			{ 	font-size:36px; height:60px;	}
    #product_code:focus		{	border:1px solid #f00;			}
    #shelf:focus			{	border:1px solid #f00;			}
    #amount					{ 	font-size:36px; height:60px;	}
    #amount:focus			{	border:1px solid #f00;			}
</style>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<script>
    $(function () {
        $("#expire_date").datepicker({dateFormat: 'yy-mm-dd'});
    });
</script>

<form name="form_add" id="form_add" action="" method="POST">
    <div class="row">
        <div class="ten columns">
            <fieldset>
                <legend><?php lang('Input-Output'); ?></legend>

                <div class="row">
                    <?php if ($input_output == 'input') { ?>
                        <div class="ten columns">
                            <?php box_product_list('product_id', 'product_code'); ?>
                            <a href="#" class="button secondary small " data-reveal-id="box_product_list" data-animation="fadeAndPop" ><?php lang('Product List'); ?></a>
                        </div>
                        <div class="ten columns">
                            <p></p>
                        </div>

                        <div class="ten columns">
                            <label for="product_code"><?php lang('Product Code'); ?></label>
                            <input type="hidden" name="copmany_name" id="company_name" class="" maxlength="50" minlength="3" value="<?php echo $company; ?>"/>
                            <input type="text" name="product_code" id="product_code" class="required" maxlength="50" minlength="3" placeholder="<?php lang('Product Code'); ?>" disabled />
                        </div>
                    <?php } ?>

                    <div class="ten columns">
                        <label for="serial"><?php lang('Product Serial'); ?></label>
                        <div class="row collapse">
                            <div class="ten mobile-three columns">
                                <input type="text" name="serial" id="serial" class="required" maxlength="50" minlength="3" placeholder="<?php lang('Product Serial'); ?>" />
                            </div>
                            <div class="two mobile-one columns">
                                <script>
                                    function popup_barcode_print()
                                    {
                                        var serial = document.getElementById('serial').value;
                                        var product_code = document.getElementById('product_code').value;
                                        var company_name = document.getElementById('company_name').value;
                                        if (product_code == '') {
                                            alert("Please select a product");
                                        } else {
                                            if (serial == '') {
                                                var uid = new Date().getTime().toString(36).toUpperCase()
                                                document.getElementById('serial').value = uid;
                                                window.open('<?php echo url(''); ?>/printlabel.php?barcode=' + uid + '&productdesc=' + company_name + '');
                                            } else {
                                                window.open('<?php echo url(''); ?>/printlabel.php?barcode=' + serial + '&productdesc=' + company_name + '');
                                            }
                                        }
                                    }
                                </script>
                                <span class="prefix"><a href="#" onClick="popup_barcode_print();"><img src="<?php url('theme'); ?>/images/icon/16/print.png" title="<?php lang('Print'); ?>" style="margin-top:5px;" /></a></span>
                            </div>
                        </div> <!-- /.row collapse -->
                    </div>

                    <div class="ten columns">
                        <script>
                            $(function () {
                                $("#expire_date").datepicker("option", "dateFormat", "yy-mm-dd");
                            });
                        </script>
                        <label for="expire_date"><?php lang('Product Expire Date'); ?></label>
                        <input type="text" name="expire_date" id="expire_date" class="" maxlength="50" minlength="3" placeholder="<?php lang('Product Expire Date'); ?>" <?php
                        if ($input_output == 'output') {
                            echo "disabled";
                        }
                        ?>/>
                    </div>

                    <div class="ten columns">
                        <label for="shelf"><?php lang('Product Shelf'); ?></label>
                        <input type="text" name="shelf" id="shelf" class="" maxlength="50" placeholder="<?php lang('Shelf'); ?>" value="<?php echo $shelf; ?>" <?php
                        if ($input_output == 'output') {
                            echo "disabled";
                        }
                        ?> />
                    </div>

                    <div class="two columns">
                        <label for="amount"><?php lang('Amount'); ?></label>
                        <input type="text" name="amount" id="amount" class="required number just_money" maxlength="11" minlength="1" phaceholder="<?php lang('Amont'); ?>" value="1" /disabled >
                    </div>
                </div>

                <div class="row">
                    <div class="ten columns">
                        <div class="text-center">
                            <img src="<?php url('theme'); ?>/images/barcode_scaner.png" />
                        </div>
                    </div>
                    <div class="two columns">
                        <input type="hidden" name="product_id" id="product_id" value="" />
                        <?php if ($input_output == 'input') : ?>
                            <input type="submit" name="btn_submit" id="btn_submit" class="button large full-width" value="&laquo; <?php lang('Input'); ?>" />
                        <?php elseif ($input_output == 'output') : ?>
                            <input type="submit" name="btn_submit" id="btn_submit" class="button large full-width" value="<?php lang('Output'); ?> &raquo;" />
                        <?php endif; ?>
                    </div>
                </div>
                <p></p>
            </fieldset>    
        </div> <!-- /.four columns -->
    </div> <!-- /.row -->


</form>

<script>
    document.getElementById('product_code').focus();
</script>

<?php include_once('../../footer.php'); ?>
