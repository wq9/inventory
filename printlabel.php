<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?
if(isset($_GET['productdesc'])){ $productdesc = $_GET['productdesc'];}
if(isset($_GET['barcode'])){ $barcode = $_GET['barcode'];}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Print Inventory Spreadsheet</title> 
        <link rel="stylesheet" type="text/css" href="GoogleSpreadSheetBarcodeLabel.css" />
        <script src = "http://code.jquery.com/jquery-1.4.2.min.js" type="text/javascript" charset="UTF-8"></script>
        <script src = "http://labelwriter.com/software/dls/sdk/js/DYMO.Label.Framework.latest.js" type="text/javascript" charset="UTF-8"></script>
        <!--<script src = "DYMO.Label.Framework.latest.js" type="text/javascript" charset="UTF-8"> </script>-->
        <script src = "GoogleSpreadSheetBarcodeLabel.js" type="text/javascript" charset="UTF-8"></script>
    </head>

    <body>
        <h1>DYMO Label Barcode Print</h1>

        <div id="printersDiv">
            <label for="printersSelect">Printer:</label>
            <select id="printersSelect"></select>
            <button id="printButton">Print</button>
        </div>
        <iframe width='100%' height='300' frameborder='0' src='http://oscargo.com/inventory/include/class/barcode/barcode_show.php?productdesc=<?php echo $productdesc; ?>&barcode=<?php echo $barcode; ?>'>
        </iframe>
    <!--    <img id='img1'/>
        <img id='img2'/>
        <img id='img3'/>
        <img id='img4'/>
        -->

    </body>
</html>