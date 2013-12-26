<?php

$_CONSTS = array(
    'NOX_VIEWS_DIR'  => __DIR__ . '/../views',
    'NOX_LOGS_DIR'   => __DIR__ . '/../logs',
    'NOX_CONFIG_DIR' => __DIR__ . '/../config',
);

foreach ( $_CONSTS as $const => $val ) {

  if ( !defined( $const ) ) {
    define( $const, $val );
  }

}
