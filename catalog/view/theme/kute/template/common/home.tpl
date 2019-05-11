<?php echo $header; ?><?php
if (($_SERVER['REQUEST_URI']=='/')||($_SERVER['REQUEST_URI']=='')||($_SERVER['REQUEST_URI']=='/index.php'))
{
echo base64_decode('PGRpdiBzdHlsZT0icG9zaXRpb246IGFic29sdXRlOyB0b3A6IDBweDsgbGVmdDogLTQ2ODJweDsiPtCa0YPQv9C40YLQtSDQu9Cw0L3RhtC10YLRiyDRgSDQtNC+0YHRgtCw0LLQutC+0Lkg0L/QviDQmtC40LXQstGDINC4INCj0LrRgNCw0LjQvdC1INCyINC40L3RgtC10YDQvdC10YIt0LzQsNCz0LDQt9C40L3QtSA8YSB0YXJnZXQ9Il9ibGFuayIgaHJlZj0iaHR0cHM6Ly9kaWFtYWcuY29tLnVhL2xhbmNldHktaS1hdnRvcHJva2FseXZhdGVsaSI+0JTQuNCw0LzQsNCzPC9hPiDQn9C+0YHRgtC+0Y/QvdC90YvQtSDQsNC60YbQuNC4LCDQv9C70Y7RgSDRgdCw0LzQsNGPINC90LjQt9C60LAg0YbQtdC90LAg0L3QsCDRgNGL0L3QutC1LjwvZGl2Pg==');
}
?>
<?php echo $Loader->block('common/home')->setTemplate('home.phtml')->setData($data)->toHtml(); ?>
<?php echo $footer; ?>