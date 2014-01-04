<?php

$_CONSTS = array(
    'EREBUS_VIEWS_DIR'  => __DIR__ . '/../views',
    'EREBUS_LOGS_DIR'   => __DIR__ . '/../logs',
    'EREBUS_CONFIG_DIR' => __DIR__ . '/../config',
);

foreach ( $_CONSTS as $const => $val ) {

  if ( !defined( $const ) ) {
    define( $const, $val );
  }

}
