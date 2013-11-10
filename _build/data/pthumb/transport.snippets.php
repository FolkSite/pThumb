<?php
/**
 * snippets transport file for pThumb extra
 *
 * Copyright 2013 by Jason Grant
 * Created on 08-25-2013
 *
 * @package phpthumbof
 * @subpackage build
 */

if (! function_exists('stripPhpTags')) {
	function stripPhpTags($filename) {
		$o = file_get_contents($filename);
		$o = str_replace('<' . '?' . 'php', '', $o);
		$o = str_replace('?>', '', $o);
		$o = trim($o);
		return $o;
	}
}
/* @var $modx modX */
/* @var $sources array */
/* @var xPDOObject[] $snippets */


$snippets = array();

$snippets[1] = $modx->newObject('modSnippet');
$snippets[1]->fromArray(array (
	'id' => 1,
	'property_preprocess' => false,
	'name' => 'phpthumbof',
	'description' => "Identical to pthumb. Retained for backwards compatibility.\nDocumentation: https://github.com/oo12/phpThumbOf",
), '', true, true);
$snippets[1]->setContent(file_get_contents($sources['source_core'] . '/elements/snippets/phpthumbof.snippet.php'));

$snippets[2] = $modx->newObject('modSnippet');
$snippets[2]->fromArray(array (
	'id' => 2,
	'property_preprocess' => false,
	'name' => 'pthumb',
	'description' => "Identical to phpthumbof. Better for future compatibility.\nDocumentation: https://github.com/oo12/phpThumbOf",
), '', true, true);
$snippets[2]->setContent(file_get_contents($sources['source_core'] . '/elements/snippets/phpthumbof.snippet.php'));


$properties = include $sources['data'].'properties/properties.phpthumbof.snippet.php';
$snippets[1]->setProperties($properties);
$snippets[2]->setProperties($properties);
unset($properties);

return $snippets;