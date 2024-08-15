<?php defined('SYC') || exit;

/**
 * @Description Este modelo se encarga de administrar la tabla Clases
 *
 */


class ClassDB extends Models
{
	public function __construct()
	{
		parent::__construct();
		$this->set_table("classes");
	}
	function __destruct()
	{
	}
}
