<?php
if (isset($_GET['barcode'])) {
    $barcode = $_GET['barcode'];
    $print = $_GET['print'];
    $productdesc = $_GET['productdesc'];
} else {
    exit;
}
?>
<table border="0" cellpadding="0" cellspacing="0"> 
    <tbody>
        <tr align="center">
            <td>
                <font size="5"><?php echo $productdesc; ?></font>
            </td>
        </tr>
        <tr align="center">
            <td><img src="barcode.php?barcode=<?php echo $barcode; ?>" /></td>
        </tr>
    </tbody>
</table>
