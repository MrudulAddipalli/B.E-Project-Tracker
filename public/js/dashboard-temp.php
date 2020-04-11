<?php if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start(); ?>
<?php
header('Content-type: text/javascript');
readfile('jquery.js');
readfile('jquery-ui.js');
readfile('jquery.nicescroll.js');
readfile('bootstrap.js');
readfile('data.js');
readfile('jquery.calendario.js');
readfile('perfect-scrollbar.js');
readfile('jquery.touch-punch.min.js');
readfile('jquery.shapeshift.js');//Remove This After Restructuring 
readfile('common.js');
readfile('DataTables/datatables.js');
?>