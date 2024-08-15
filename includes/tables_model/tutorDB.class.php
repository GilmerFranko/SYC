<?php defined('SYC') || exit;

/**
 * @Description Este modelo se encarga de administrar la tabla Clients
 *
 *
 */
/** Como esta actualmente se requeriran/incluiran todos los archivos encargador de administrar los modulos y por lo tanto puede crear lentitud al cargar tantos archivos, se podria cargar solo el archivo necesario como en laravel con la instrucción "use";*/

class TutorDB extends Models
{
	public function __construct()
	{
		//parent::__construct();
		//$this->set_table("students")
	}

	function __destruct()
	{
	}

	public function getTutor()
	{
		return 'antonio';
	}
}
