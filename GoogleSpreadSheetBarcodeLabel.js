//----------------------------------------------------------------------------
//
//  $Id: GoogleSpreadSheetBarcodeLabel.js 12287 2010-06-17 03:47:32Z vbuzuev $ 
//
// Project -------------------------------------------------------------------
//
//  DYMO Label Framework
//
// Content -------------------------------------------------------------------
//
//  DYMO Label Framework JavaScript Library Samples: 
//    Print mulltiple labels using Google Spreadsheet as a data source
//
//----------------------------------------------------------------------------
//
//  Copyright (c), 2010, Sanford, L.P. All Rights Reserved.
//
//----------------------------------------------------------------------------



(function ()
{
    var label;
    var labelSet;

    function onload()
    {
        var printButton = document.getElementById('printButton');
        var printersSelect = document.getElementById('printersSelect');
        var $_GET = {};

        document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function () {
            function decode(s) {
                return decodeURIComponent(s.split("+").join(" "));
            }

            $_GET[decode(arguments[1])] = decode(arguments[2]);
        });
        //window.alert($_GET['productdesc']);

        labelSet = "<LabelSet><LabelRecord><ObjectData Name='Description'>" + $_GET['productdesc'] + "</ObjectData><ObjectData Name='ItemCode'>" + $_GET['barcode'] + "</ObjectData></LabelRecord></LabelSet>";

        window._loadBarcodeDataCallback = labelSet;

        function loadBarcodeData()
        {
            removeOldJSONScriptNodes();

            var script = document.createElement('script');

            script.setAttribute('src', 'printlabel.php?&callback=window._loadBarcodeDataCallback');
            script.setAttribute('id', 'printScript');
            script.setAttribute('type', 'text/javascript');
            document.documentElement.firstChild.appendChild(script);
        }
        ;

        function removeOldJSONScriptNodes()
        {
            var jsonScript = document.getElementById('printScript');
            if (jsonScript)
                jsonScript.parentNode.removeChild(jsonScript);
        }
        ;

        function loadLabel()
        {
            // use jQuery API to load label
            $.get("Barcode.label", function (labelXml)
            {
                label = dymo.label.framework.openLabelXml(labelXml);
            }, "text");
        }

        // loads all supported printers into a combo box 
        function loadPrinters()
        {
            var printers = dymo.label.framework.getLabelWriterPrinters();
            if (printers.length == 0)
            {
                alert("No DYMO LabelWriter printers are installed. Install DYMO LabelWriter printers.");
                return;
            }

            for (var i = 0; i < printers.length; ++i)
            {
                var printer = printers[i];
                var printerName = printer.name;

                var option = document.createElement('option');
                option.value = printerName;
                option.appendChild(document.createTextNode(printerName));
                printersSelect.appendChild(option);
            }
        }

        // prints the label
        printButton.onclick = function ()
        {
            try
            {
                if (!label)
                    throw "Label is not loaded";

                if (!labelSet)
                    throw "Label data is not loaded";

                label.print(printersSelect.value, '', labelSet);

//                var records = labelSet.getRecords();
//                for (var i = 0; i < records.length; ++i)
//                {
//                    label.setObjectText("Description", records[i]["Description"]);
//                    label.setObjectText("ItemCode", records[i]["ItemCode"]);
//                    var pngData = label.render();
//
//                    var labelImage = document.getElementById('img' + (i + 1));
//                    labelImage.src = "data:image/png;base64," + pngData;
//                }
            }
            catch (e)
            {
                alert(e.message || e);
            }
        };

        loadLabel();
        loadBarcodeData();
        loadPrinters();

    }
    ;

    // register onload event
    if (window.addEventListener)
        window.addEventListener("load", onload, false);
    else if (window.attachEvent)
        window.attachEvent("onload", onload);
    else
        window.onload = onload;

}());
