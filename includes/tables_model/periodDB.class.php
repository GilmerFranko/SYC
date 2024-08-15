<?php defined('SYC') || exit;

/**
 * @Description Este modelo se encarga de administrar la tabla Periods (Periodo Estudiantil)
 *
 */


class PeriodDB extends Models
{
	public function __construct()
	{
		parent::__construct();
		$this->set_table("periodos");
	}

	function __destruct()
	{
	}

	public function getPeriods()
	{
		$select = $this->db->query('SELECT `nombres` FROM `' . $this->get_table() . '`');

		if ($select and $select->num_rows > 0)
		{
			$row = '';
			while ($periods = $select->fetch_assoc())
			{
				$row .= '\'' . $periods['nombres'] . '\': null,';
			}
			return $row;
		}
	}

	public function getAllPeriods()
	{
		$select = $this->db->query('SELECT * FROM `' . $this->get_table() . '`');

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

	public function getPeriodId($name = null)
	{
		$result = $this->where('name', '=', $name)->get();
		if ($result)
		{
			return $result['id'];
		}
		return false;
	}
}
