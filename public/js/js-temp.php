<?php if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start(); ?>
<?php
header('Content-type: text/javascript');
readfile('jquery-1.12.4.js');
readfile('datepicker.js');
readfile('jquery-ui.js');
readfile('jquery.nicescroll.js');
readfile('bootstrap.js');
readfile('bootstrap-select.js');
readfile('bootstrap-country-code.js');
readfile('bootstrap-add-remove.js');
readfile('bootstrap-filestyle.js');
readfile('bootstrap-richtext.js');
readfile('jquery.tokeninput.js');
readfile('chosen.js');
readfile('check-radio.js');
readfile('gritter.js');
readfile('common.js');
readfile('validation.js');
readfile('select2.js');
readfile('picker.js');
readfile('picker.date.js');
readfile('picker.time.js');
readfile('legacy.js');
readfile('DataTables/datatables.js');
?>
