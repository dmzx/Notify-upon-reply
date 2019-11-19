<?php
/**
*
* @package phpBB Extension - Notify upon reply
* @copyright (c) 2016 dmzx - https://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\notifyuponreply\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\auth\auth */
	protected $auth;

	/**
	* Constructor
	*
	* @param \phpbb\user						$user
	* @param \phpbb\request\request 			$request
	* @param \phpbb\template\template			$template
	* @param \phpbb\auth\auth					$auth
	*
	*/
	public function __construct(
		\phpbb\user $user,
		\phpbb\request\request $request,
		\phpbb\template\template $template,
		\phpbb\auth\auth $auth
	)
	{
		$this->user			= $user;
		$this->request 		= $request;
		$this->template		= $template;
		$this->auth 		= $auth;
	}

	static public function getSubscribedEvents()
	{
		return array(
			'core.posting_modify_template_vars'		=> 'modify_template_vars',
			'core.permissions'						=> 'add_permission',
			'core.ucp_prefs_personal_data'			=> 'ucp_prefs_get_data',
			'core.ucp_prefs_personal_update_data'	=> 'ucp_prefs_set_data',
		);
	}

	public function modify_template_vars($event)
	{
		if ($this->user->data['user_notifyuponreply'])
		{
			$page_data = $event['page_data'];
			$checkoff = $page_data['S_NOTIFY_CHECKED'];
			$checkoff = 'checked="checked"';
			$page_data['S_NOTIFY_CHECKED'] = $checkoff;
			$event['page_data'] = $page_data;
		}
	}

	public function add_permission($event)
	{
		$permissions = $event['permissions'];
		$permissions['u_notifyuponreply_switch'] = array('lang' => 'ACL_U_NOTIFYUPONREPLY_SWITCH', 'cat' => 'misc');
		$event['permissions'] = $permissions;
	}

	public function ucp_prefs_get_data($event)
	{
		$this->user->add_lang_ext('dmzx/notifyuponreply', 'common');

		$event['data'] = array_merge($event['data'], array(
			'notifyuponreply'	=> $this->request->variable('notifyuponreply', (int) $this->user->data['user_notifyuponreply']),
		));

		if (!$event['submit'])
		{
			$this->template->assign_vars(array(
				'S_UCP_NOTIFYUPONREPLY'		=> $event['data']['notifyuponreply'],
				'USE_NOTIFYUPONREPLY'	 	=> $this->auth->acl_get('u_notifyuponreply_switch'),
			));
		}
	}

	public function ucp_prefs_set_data($event)
	{
		$event['sql_ary'] = array_merge($event['sql_ary'], array(
			'user_notifyuponreply' 			=> $event['data']['notifyuponreply'],
		));
	}
}
