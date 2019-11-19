<?php
/**
*
* @package phpBB Extension - Notify upon reply
* @copyright (c) 2016 dmzx - https://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\notifyuponreply\migrations;

class notifyuponreply_install extends \phpbb\db\migration\migration
{
	public function update_data()
	{
		return array(

			// Add permissions
			array('permission.add', array('u_notifyuponreply_switch', true)),

			// Set permissions
			array('permission.permission_set', array('ADMINISTRATORS', 'u_notifyuponreply_switch', 'group')),
		);
	}

	public function update_schema()
	{
		return array(
			'add_columns'	=> array(
				$this->table_prefix . 'users' => array(
					'user_notifyuponreply'	=> array('BOOL', 1),
				),
			),
		);
	}

	public function revert_schema()
	{
		return 	array(
			'drop_columns' => array(
				$this->table_prefix . 'users'	=> array(
					'user_notifyuponreply',
				),
			),
		);
	}
}
