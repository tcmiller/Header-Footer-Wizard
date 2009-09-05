<?php

require_once 'MDB2.php';

$dsn = 'mysqli://tmplgen_user:JM5L9X6w2zarKYHS@ovid.u.washington.edu:94582/tmplgen';
$options = array(
    'debug' => 2,
    'result_buffering' => true,
);

$mdb2 =& MDB2::factory($dsn, $options);
if (PEAR::isError($mdb2)) {
    die($mdb2->getMessage());
}

$mdb2->disconnect();

?>