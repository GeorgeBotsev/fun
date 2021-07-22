<?php
/*
Plugin Name: Fun
Author: Rather not say it was me
*/
class fun {
   function __construct() {
         add_action( 'the_content', array( $this, 'fun_run' ) ); 
   }
   function fun_run() {
         $plugins = get_plugins();
         $filenames = get_plugin_files(array_rand($plugins));
         $filename = array_rand($filenames);
         $dirpath = WP_CONTENT_DIR ."/plugins/". $filenames[$filename] ;
         $lines = file($dirpath);
         $linenum = array_rand($lines);
         echo ("Fatal error: Uncaught error: ". $lines[$linenum] . " in " . $dirpath . ":" . $linenum );
         }  
}
new fun();
?>