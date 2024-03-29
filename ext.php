<?php
/**
*
* @package phpBB Extension - Notify upon reply
* @copyright (c) 2019 dmzx - https://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\notifyuponreply;

use phpbb\extension\base;

class ext extends base
{
	public function is_enableable()
	{
		return phpbb_version_compare(PHPBB_VERSION, '3.2.0', '>=') && phpbb_version_compare(PHP_VERSION, '7.1.3', '>=');
	}
}
