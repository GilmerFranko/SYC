<?php defined('SYC') || exit;

/**
 * @Description Este modelo se encarga de administrar la tabla Members (Miembros)
 *
 */
/** Como esta actualmente se requeriran/incluiran todos los archivos encargador de administrar los modulos y por lo tanto puede crear lentitud al cargar tantos archivos, se podria cargar solo el archivo necesario como en laravel con la instrucción "use";*/

class MemberDB extends Models
{
	public function __construct()
	{
		parent::__construct();
		$this->set_table("miembros");
		$this->id = 'member_id';
	}

	function __destruct()
	{
	}

	/**
	 * Obtiene cantidad de usuarios conectados
	 *
	 * @param int $min Minutos
	 * @return int
	 */
	function getOnlines($min = 5)
	{
		$time = (string) time() - (60 * $min);
		//$query = $this->db->query('SELECT COUNT(`member_id`) FROM `members` WHERE `last_activity` > '. $time . ' LIMIT 1');
		return $this->count($this->id)->where('last_activity', '>', $time)->get();
	}
}
