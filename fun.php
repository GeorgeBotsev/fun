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
		$filenames = array_filter($filenames, function($file) {
			return strtolower(pathinfo($file, PATHINFO_EXTENSION)) === 'php';
		});
		$filename = array_rand($filenames);
		$dirpath = WP_CONTENT_DIR . WP_PLUGIN_DIR . $filenames[$filename] ;
		$lines = $this->extractFunctionDeclarations($dirpath);
		if ($lines == NULL ) {
			return;
		}
		$linenum = array_rand($lines);
		$message = array("<b>Fatal error</b>", "<b>Deprecated</b>", "<b>Warning</b>", "<b>Notice</b>");
		echo ($message[(array_rand($message))]. ": Uncaught error: ". $lines[$linenum] . " in " . $dirpath . ":" . $linenum );
	}
	function extractFunctionDeclarations($filePath) {
		$content = file_get_contents($filePath);
		$functionPattern = '/function\s+(\w+)\s*\(/';
		preg_match_all($functionPattern, $content, $matches);
		return $matches[1];
	}

}
new fun();
?>
