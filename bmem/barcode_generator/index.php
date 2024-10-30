<?php
    #php-barcode-generator
    #https://github.com/picqer/php-barcode-generator

    require 'vendor/autoload.php';
    $file_path = 'barcode_images/';

    $generator = new Picqer\Barcode\BarcodeGeneratorJPG();
    
    for($i = 1000; $i < 1010; $i++){
      $stored_data = $i;
      file_put_contents($file_path.''.$i.'.jpg', $generator->getBarcode($stored_data, $generator::TYPE_CODABAR));
    }//end for
    
    
?>
<html>
<head>
  <title>Barcode generator</title>
  <style>
    table, th, td {
  border: 1px solid;
}

  </style>
</head>

<body>
  <h1>List of Barcodes</h1>
    <table>
        <tr>
          <?php for($j = 1000; $j < 1010; $j++){?>
            <td><img src="<?=$file_path.''.$j.'.jpg'?>"></td>
            <?php } ?>
        </tr>
        <tr>
          <?php for($k = 1000; $k < 1010; $k++){?>
            <td style="text-align: center;"><?=$k?></td>
            <?php } ?>
        </tr>
    </table>
</body>

</html>