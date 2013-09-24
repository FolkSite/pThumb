<?php
/**
 * systemSettings transport file for pThumb extra
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
/* @var xPDOObject[] $systemSettings */


$systemSettings = array();

$ssIdx = 1;

$systemSettings[$ssIdx] = $modx->newObject('modSystemSetting');
$systemSettings[$ssIdx++]->fromArray(array (
	'key' => 'phpthumbof.use_resizer',
	'value' => FALSE,
	'xtype' => 'combo-boolean',
	'namespace' => 'phpthumbof',
	'area' => 'Images',
), '', true, true);

$systemSettings[$ssIdx] = $modx->newObject('modSystemSetting');
$systemSettings[$ssIdx++]->fromArray(array (
	'key' => 'phpthumbof.jpeg_quality',
	'value' => 75,
	'xtype' => 'textfield',
	'namespace' => 'phpthumbof',
	'area' => 'Images',
), '', true, true);

$systemSettings[$ssIdx] = $modx->newObject('modSystemSetting');
$systemSettings[$ssIdx++]->fromArray(array (
	'key' => 'phpthumbof.remote_timeout',
	'value' => 5,
	'xtype' => 'textfield',
	'namespace' => 'phpthumbof',
	'area' => 'Other',
), '', true, true);

$systemSettings[$ssIdx] = $modx->newObject('modSystemSetting');
$systemSettings[$ssIdx++]->fromArray(array (
	'key' => 'phpthumbof.postfix_property_hash',
	'value' => TRUE,
	'xtype' => 'combo-boolean',
	'namespace' => 'phpthumbof',
	'area' => 'phpThumbOf Cache',
), '', true, true);

$systemSettings[$ssIdx] = $modx->newObject('modSystemSetting');
$systemSettings[$ssIdx++]->fromArray(array (
	'key' => 'phpthumbof.cache_path',
	'value' => '',
	'xtype' => 'textfield',
	'namespace' => 'phpthumbof',
	'area' => 'phpThumbOf Cache',
), '', true, true);

$systemSettings[$ssIdx] = $modx->newObject('modSystemSetting');
$systemSettings[$ssIdx++]->fromArray(array (
	'key' => 'pthumb.use_ptcache',
	'value' => FALSE,
	'xtype' => 'combo-boolean',
	'namespace' => 'phpthumbof',
	'area' => 'pThumb Cache',
), '', true, true);

$systemSettings[$ssIdx] = $modx->newObject('modSystemSetting');
$systemSettings[$ssIdx++]->fromArray(array (
	'key' => 'pthumb.ptcache_location',
	'value' => 'assets/image-cache',
	'xtype' => 'textfield',
	'namespace' => 'phpthumbof',
	'area' => 'pThumb Cache',
), '', true, true);

$systemSettings[$ssIdx] = $modx->newObject('modSystemSetting');
$systemSettings[$ssIdx++]->fromArray(array (
	'key' => 'pthumb.ptcache_images_basedir',
	'value' => 'assets',
	'xtype' => 'textfield',
	'namespace' => 'phpthumbof',
	'area' => 'pThumb Cache',
), '', true, true);

$systemSettings[$ssIdx] = $modx->newObject('modSystemSetting');
$systemSettings[$ssIdx++]->fromArray(array (
	'key' => 'phpthumbof.check_mod_time',
	'value' => FALSE,
	'xtype' => 'combo-boolean',
	'namespace' => 'phpthumbof',
	'area' => 'pThumb Cache',
), '', true, true);

return $systemSettings;