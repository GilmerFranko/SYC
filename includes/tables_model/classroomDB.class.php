<?php defined('SYC') || exit;

/**
 * @Description Este modelo se encarga de administrar la tabla class_room
 *
 */


class ClassRoomDB extends Models
{
	public function __construct()
	{
		parent::__construct();
		$this->set_table("secciones");
	}
	function __destruct()
	{
	}


	/**
	 * Devuelve todas las incripciones
	 * aplicando uno o varios filtros
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	public function getAllClasses($data = null)
	{
		$WHERE = isset($data['periodo_id']) ? 'WHERE periodo_id = ' . $data['periodo_id'] : '';
		$select = $this->db->query('SELECT * FROM `' . $this->get_table() . '` ' . $WHERE);

		if ($select and $select->num_rows > 0)
		{
			$row = [];
			while ($class = $select->fetch_assoc())
			{
				$row[] = $class;
			}
			return $row;
		}
		return false;
	}
}
