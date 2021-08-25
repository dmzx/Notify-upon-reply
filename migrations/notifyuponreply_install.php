<?php
/**
*
* @package phpBB Extension - Notify upon reply
* @copyright (c) 2016 dmzx - https://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\notifyuponreply\migrations;

use phpbb\db\migration\migration;

class notifyuponreply_install extends migration
{
	public function update_data()
	{
		return [

			// Add permissions
			['permission.add', ['u_notifyuponreply_switch', true]],

			// Set permissions
			['permission.permission_set', ['ADMINISTRATORS', 'u_notifyuponreply_switch', 'group']],
		];
	}

	public function update_schema()
	{
		return [
			'add_columns'	=> [
				$this->table_prefix . 'users' => [
					'user_notifyuponreply'	=> ['BOOL', 1],
				],
			],
		];
	}

	public function revert_schema()
	{
		return 	[
			'drop_columns' => [
				$this->table_prefix . 'users'	=> [
					'user_notifyuponreply',
				],
			],
		];
	}
}
