<?php
namespace Sab\Includes;

if( ! defined( 'ABSPATH' ) ) {
   die;
}

class Activate {
   public static function activate() {
      flush_rewrite_rules();
   }
}
