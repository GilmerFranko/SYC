<?php defined('SYC') || exit;

/**
 * @Description Este modelo se encarga de administrar la tabla Courses (Materias)
 *
 */


class CourseDB extends Models
{
	public function __construct()
	{
		parent::__construct();
		$this->set_table("materias");
	}

	function __destruct()
	{
	}

	public function getCourseName()
	{
		$select = $this->db->query('SELECT `nombre` FROM ' . $this->get_table());

		if ($select and $select->num_rows > 0)
		{
			$row = '';
			while ($class = $select->fetch_assoc())
			{
				$row .= '\'' . $class['nombre'] . '\': null,';
			}
			return $row;
		}
	}
}
