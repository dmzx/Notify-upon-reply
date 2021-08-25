<?php
/**
*
* @package phpBB Extension - Notify upon reply
* @copyright (c) 2019 dmzx - https://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\notifyuponreply\migrations;

use phpbb\db\migration\migration;

class notifyuponreply_v101 extends migration
{
	static public function depends_on()
	{
		return [
			'\dmzx\notifyuponreply\migrations\notifyuponreply_install',
		];
	}

	public function update_data()
	{
		return [
			['config.add', ['notifyuponreply_version', '1.0.1']],
		];
	}
}
