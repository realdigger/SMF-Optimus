<?php declare(strict_types=1);

/**
 * Prime.php
 *
 * @package Optimus
 * @link https://custom.simplemachines.org/mods/index.php?mod=2659
 * @author Bugo https://dragomano.ru/mods/optimus
 * @copyright 2010-2024 Bugo
 * @license https://opensource.org/licenses/artistic-license-2.0 Artistic-2.0
 *
 * @version 3.0 Beta
 */

namespace Bugo\Optimus;

use Bugo\Optimus\Addons\AddonInterface;
use Bugo\Optimus\Events\AddonEvent;
use Bugo\Optimus\Events\DispatcherFactory;
use Bugo\Optimus\Handlers\HandlerLoader;
use Bugo\Optimus\Utils\Copyright;

if (! defined('SMF'))
	die('No direct access...');

final class Prime
{
	public function __construct()
	{
		new HandlerLoader();
	}

	public function __invoke(): void
	{
		add_integration_function('integrate_load_theme', self::class . '::loadTheme#', false, __FILE__);
		add_integration_function('integrate_credits', self::class . '::credits#', false, __FILE__);

		(new DispatcherFactory())()->dispatch(new AddonEvent(AddonInterface::HOOK_EVENT, $this));
	}

	public function loadTheme(): void
	{
		loadLanguage('Optimus/Optimus');
	}

	public function credits(): void
	{
		global $context;

		$context['credits_modifications'][] = Copyright::getLink() . Copyright::getYears();
	}
}
