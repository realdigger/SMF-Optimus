<?php

/**
 * Settings.php
 *
 * @package SMF Optimus
 * @link https://custom.simplemachines.org/mods/index.php?mod=2659
 * @author Bugo https://dragomano.ru/mods/optimus
 * @copyright 2010-2020 Bugo
 * @license https://opensource.org/licenses/artistic-license-2.0 Artistic-2.0
 *
 * @version 2.6.6
 */

if (!defined('SMF'))
	die('Hacking attempt...');

/**
 * Вызов генерации карты через Диспетчер задач
 *
 * @return void
 */
function scheduled_optimus_sitemap()
{
	global $modSettings, $boarddir, $sourcedir;

	// Удаляем ранее созданные карты, если нужно
	if (!empty($modSettings['optimus_remove_previous_xml_files']))
		array_map("unlink", glob($boarddir . "/sitemap*.xml*"));

	require_once($sourcedir . '/Optimus/Subs.php');
	require_once($sourcedir . '/Optimus/Sitemap.php');

	return \Bugo\Optimus\Sitemap::createXml();
}
