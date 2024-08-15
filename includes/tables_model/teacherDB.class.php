<?php defined('SYC') || exit;

/**
 * @Description Este modelo se encarga de administrar la tabla Teachers (profesores)
 *
 */


class TeacherDB extends Models
{
	public function __construct()
	{
		parent::__construct();
		$this->set_table("profesores");
	}


	function __destruct()
	{
	}
}
