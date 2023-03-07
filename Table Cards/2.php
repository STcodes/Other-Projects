<?php

    require __DIR__.'/vendor/autoload.php';

    use vendor\Spipu\Html2Pdf\Html2Pdf;

    $html2pdf = new Html2Pdf('P', 'A4', 'fr');
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML("<h1>Hello World !</h1> Wie geht's es dir ?");
    $html2pdf->output();

?> 