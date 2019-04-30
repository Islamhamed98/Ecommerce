<?php 
function language($phrase) {
  static $lang = array(
    'HOME_ADMIN' => 'Ecommerce', 
    'friends'    => 'Members',
    'Categories' => 'Categories',
    'items'      => 'Items',
    'stat'       => 'Statstics',
    'Connect'    => 'Contact Us'
  );
 
  return $lang[$phrase];

}
?>