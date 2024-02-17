<?php

$routes = \Config\Services::routes();
include APPPATH . 'Config/Routes/APIRoutes.php';
include APPPATH . 'Config/Routes/AuthRoutes.php';
include APPPATH . 'Config/Routes/KantorPusatRoutes.php';
include APPPATH . 'Config/Routes/ITKantorPusatRoutes.php';
include APPPATH . 'Config/Routes/ITKantorCabangRoutes.php';
include APPPATH . 'Config/Routes/PICGudangRoutes.php';
include APPPATH . 'Config/Routes/BulogRoutes.php';
include APPPATH . 'Config/Routes/PinpinanCabangBulogRoutes.php';
include APPPATH . 'Config/Routes/POSINDRoutes.php';

return $routes;
