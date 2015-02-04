<?php
/* ----------------------------------------------
  DATABASE
  ---------------------------------------------- */

class database {

    public $prefix; // herkese açık değer

    function database($prefix) {
        $this->users = $prefix . 'users';
        $this->meta = $prefix . 'meta';
        $this->products = $prefix . 'product';
        $this->product_item = $prefix . 'product_item';
        $this->product_amount = $prefix . 'product_amount';
        $this->log = $prefix . 'log';
    }

}

$database = new database($prefix);


/* ----------------------------------------------
  CONFIG
  ---------------------------------------------- */

function get_config($value) {
    if ($value == 'name') {
        return 'Inventory Tracking';
    }
}

function config($value) {
    echo get_config($value);
}

/* ----------------------------------------------
  URL
  ---------------------------------------------- */

function get_url($value) {
    global $url;
    if ($value == '') {
        return $url;
    } else {
        return $url . '/' . $value;
    }
}

function url($value) {
    echo get_url($value);
}

/* ----------------------------------------------
  OTHER
  ---------------------------------------------- */

/* ----- ALERT BOX ----- */

function alert_box($type, $message) {
    echo '
	<div class="alert-box ' . $type . '">
		' . $message . '
		<a href="" class="close">&times;</a>
	</div>
	';
}

/* ----- SAFETY FILTER ----- */

function safety_filter($value) {
    return trim(mysql_real_escape_string(strip_tags($value)));
}

/* ----------------------------------------------
  PAGE LOAD TIME
  ---------------------------------------------- */

class page_load_time {

    function start() {
        global $starting;
        $mtime = microtime();
        $mtime = explode(' ', $mtime);
        $mtime = $mtime[1] + $mtime[0];
        $starting = $mtime;
    }

    function stop() {
        global $starting;
        $mtime = microtime();
        $mtime = explode(' ', $mtime);
        $mtime = $mtime[1] + $mtime[0];
        $stop = $mtime;
        $total = round(($stop - $starting), 5);
        return $total;
    }

}

$page_load_time = new page_load_time;
$page_load_time->start();
?>
<?php
/* ----------------------------------------------
  MONEY FORMAT
  ---------------------------------------------- */

function get_money($value) {
    return number_format($value, 2);
}

function money($value) {
    echo get_money($value);
}

function is_money_format($value) {
    if (empty($value)) {
        return true;
    } else {
        if (preg_match('/^[0-9]*\.?[0-9]+$/', $value)) {
            return true;
        } else {
            return false;
        }
    }
}
?>
<script>
    function popup_barcode(barcode, printing)
    {
        window.open('<?php echo url(''); ?>/include/class/barcode/barcode_show.php?barcode=' + barcode + '&print=' + printing + '', 'mywindow', 'menubar=0,resizable=0,width=<?php echo (get_config('barcode_width') + 20); ?>,height=<?php config('barcode_width'); ?>');
    }

    function popup(url, width, height)
    {
        window.open(url, 'mywindow', 'menubar=0,resizable=0,width=' + width + ',height=' + height + '');
    }
</script>
