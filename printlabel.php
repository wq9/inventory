<?
if(isset($_GET['productdesc'])){ $productdesc = $_GET['productdesc'];}
if(isset($_GET['barcode'])){ $barcode = $_GET['barcode'];}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Print Inventory Spreadsheet</title> 
        <link rel="stylesheet" type="text/css" href="GoogleSpreadSheetBarcodeLabel.css" />
        <script src = "//code.jquery.com/jquery-1.4.2.min.js" type="text/javascript" charset="UTF-8"></script>
        <script src = "DYMO.Label.Framework.latest.js" type="text/javascript" charset="UTF-8"></script>
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
        <iframe width='100%' height='300' frameborder='0' src='include/class/barcode/barcode_show.php?productdesc=<?php echo $productdesc; ?>&barcode=<?php echo $barcode; ?>'>
        </iframe>
    <!--    <img id='img1'/>
        <img id='img2'/>
        <img id='img3'/>
        <img id='img4'/>
        -->

    </body>
</html>