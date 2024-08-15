<?php defined('SYC') || exit;

/**
 * @Description Este modelo se encarga de administrar la tabla Enrollments (Inscripciones)
 */


class EnrollmentDB extends Models
{
	public function __construct()
	{
		parent::__construct();
		$this->set_table("inscripciones_periodo");
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
	public function getAllEnrollments($data = null)
	{
		$WHERE = isset($data['periodo_id']) ? 'AND periodo_id = ' . $data['periodo_id'] : '';
		$select = $this->db->query('SELECT * FROM `' . $this->get_table() . '` WHERE 1 ' . $WHERE);

		if ($select and $select->num_rows > 0)
		{
			$row = [];
			while ($periods = $select->fetch_assoc())
			{
				$row[] = $periods;
			}
			return $row;
		}
		return false;
	}
}
