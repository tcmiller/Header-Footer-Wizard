<?php

require_once 'MDB2.php';

$dsn = 'mysqli://tmplgen_tst_user:DSZ5F73aCdedSmvy@ovid.u.washington.edu:94582/tmplgen_test';
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