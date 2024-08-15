<?php defined('SYC') || exit;

/**
 * @Description Este modelo se encarga de administrar la tabla class_room
 *
 */


class WorkspaceDB extends Models
{
	public function __construct()
	{
		parent::__construct();
		$this->set_table("members_workspace");
	}
	function __destruct()
	{
	}


	public function getWorkspace($id, $member_id)
	{

		$id = $this->db->real_escape_string($id);

		$query = $this->db->query('SELECT * FROM `' . $this->get_table() . '` WHERE `id` = ' . $id . ' AND member_id = ' . $member_id);


		if ($query == true)
		{
			$result['data'] = $query->fetch_assoc();
			$result['rows'] = $query->num_rows;

			return $result;
		}

		return false;
	}

	public function saveWorkspace($data)
	{
		$updates = Core::model('extra', 'core')->getIUP($data, '', 'update');

		$query = $this->db->query('UPDATE `' . $this->get_table() . '` SET ' . $updates . '');

		if ($query == true)
		{
			return true;
		}

		return false;
	}
}
