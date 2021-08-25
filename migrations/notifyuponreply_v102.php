<?php
/**
*
* @package phpBB Extension - Notify upon reply
* @copyright (c) 2021 dmzx - https://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\notifyuponreply\migrations;

use phpbb\db\migration\migration;

class notifyuponreply_v102 extends migration
{
	static public function depends_on()
	{
		return [
			'\dmzx\notifyuponreply\migrations\notifyuponreply_v101',
		];
	}

	public function update_data()
	{
		return [
			['config.update', ['notifyuponreply_version', '1.0.2']],
		];
	}
}
