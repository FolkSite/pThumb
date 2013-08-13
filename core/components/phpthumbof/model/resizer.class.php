<?php
/**
 * Resizer
 * Copyright 2013 Jason Grant
 * Please see the GitHub page for documentation or to report bugs:
 * https://github.com/oo12/phpThumbOf
 *
 * Resizer is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 2 of the License, or (at your option) any
 * later version.
 *
 * Resizer is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * Resizer; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 **/

define('RL_BASEPATH', dirname(__FILE__) . '/');
function resizerLoader($class) {
	include_once RL_BASEPATH . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
}
spl_autoload_register('\resizerLoader');



class Resizer {


public $debugmessages = array('Resizer v0.1');
public $debug = FALSE;

private $imagine;

public function __construct($graphicsLib) {
	// Decide which graphics library to use and create the appropriate Imagine object
	if (class_exists('Gmagick', FALSE) && $graphicsLib > 1) {
		$this->debugmessages[] = 'Using Gmagick';
		set_time_limit(0);
		$this->imagine = new \Imagine\Gmagick\Imagine();
	}
	elseif (class_exists('Imagick', FALSE) && $graphicsLib) {
		$this->debugmessages[] = 'Using Imagick';
		set_time_limit(0);  // execution time accounting seems strange on some systems. Maybe because of multi-threading?
		$this->imagine = new \Imagine\Imagick\Imagine();
	}
	else {  // good ol' GD
		$this->debugmessages[] = 'Using GD';
		$this->imagine = new \Imagine\Gd\Imagine();
	}
}

/* Cut off all image-specific debug messages */
public function resetDebug() {
	$this->debugmessages = array_slice($this->debugmessages, 0, 2);
}

/*
 * @param  string  $input    filename of input image
 * @param  string  $output   filename to write output image to
 * @param  array   $options  options, phpThumb style
 */
public function writeResized($input, $output, $options = array()) {
	$image = $this->imagine->open($input);
	$filter = new \Resizer\Filter\phpThumb($image, $options, $this->debug);
	$outputOpts = isset($options['q']) ? array('quality' => $options['q']) : array();

	try  { $filter->apply($image)->save($output, $outputOpts); }
	catch(Imagine\Exception\RuntimeException $e) {
		if ($this->debug) {
			$this->debugmessages = array_merge($this->debugmessages, $filter->debugmessages);
			$this->debugmessages[] = $e->getMessage();
		}
		return FALSE;
	}

	if ($this->debug) {
		$this->debugmessages = array_merge($this->debugmessages, $filter->debugmessages);
		$this->debugmessages[] = "Wrote $output";
	}
	return TRUE;
}


}