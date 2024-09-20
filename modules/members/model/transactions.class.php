<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Este modelo contiene funciones relacionadas a las transacciones de un usuario
 *
 *
 */

class Transactions extends Session
{
	public function __construct()
	{
		parent::__construct();
		$this->session = Core::model('session', 'core');
	}


	function getBalance($member_id = null)
	{
		if ($member_id == null)
		{
			$member_id = $this->memberData['member_id'];
		}

		$query = $this->db->query('SELECT `balance` FROM `member_balance` WHERE member_id = \'' . $member_id . '\'');

		if ($query == true && $query->num_rows > 0)
		{
			$balance = $query->fetch_assoc();

			return floatval($balance['balance']);
		}
		else
		{
			/** Registrar error fatal **/
			loadClass('admin/logactivity')->logActivity($member_id, 'fatalerror', 'Error al obtener balance: En ' . __FILE__ . ' Linea ' . __LINE__);
			exit;
		}
	}

	/**
	 * Comprueba si un usuario tiene suficiente dinero para hacer un pago
	 *
	 * @param int $member_id Identificador del usuario
	 * @param float $amount Monto
	 * @return bool True si el usuario tiene suficiente dinero, false de lo contrario
	 */
	public function checkUserBalance($member_id, $amount)
	{
		$balance = $this->getBalance($member_id);

		if ($balance >= $amount)
		{
			return true;
		}
		return false;
	}


	/**
	 * Actualiza el balance de un usuario
	 *
	 * @param int $member_id Identificador del usuario
	 * @param float $amount Cantidad a sumar o restar al balance
	 * @param bool $isDeposit True si es un ingreso, False si es un egreso
	 * @return bool True si la actualización fue exitosa, false de lo contrario
	 */
	public function updateBalance($member_id, $amount, $isDeposit = true, $reason = null)
	{
		// Determina la operación (sumar o restar) según si es un ingreso o egreso
		$operation = $isDeposit ? '+' : '-';

		// Actualiza el balance del usuario
		$query = $this->db->query("UPDATE `member_balance` SET `balance` = `balance` {$operation} {$amount} WHERE `member_id` = {$member_id}");

		/* Registrar la transacció;n */
		if ($query)
		{
			$this->createTransaction($member_id, $amount, $isDeposit ? '+' : '-', $reason);
		}



		// Devuelve true si la actualización fue exitosa, false de lo contrario
		return $query ? true : false;
	}



	/**
	 * Crea una nueva transacción
	 *
	 * @param int $member_id ID del usuario
	 * @param float $amount Monto de la transacción
	 * @param string $transaction_type Tipo de transacción ('deposit', 'withdrawal', etc.)
	 * @param string $description Descripción de la transacción
	 * @param string|null $timestamp Marca de tiempo de la transacción (opcional)
	 * @return bool True si la transacción se creó correctamente, false en caso contrario
	 */
	public function createTransaction($member_id, $amount, $transaction_type, $reason)
	{
		$timestamp = time();

		$query = $this->db->query("INSERT INTO `members_transactions` (`member_id`, `amount`, `transaction_type`, `reason`, `timestamp`) VALUES ('{$member_id}', '{$amount}', '{$transaction_type}', '{$reason}', '{$timestamp}')");

		return $query ? true : false;
	}


	/**
	 * Obtiene todas mis transacciones
	 *
	 * @param int|null $member_id Identificador del usuario (opcional)
	 * @param int $page Número de página (opcional)
	 * @param int $perPage Cantidad de transacciones por página (opcional)
	 * @return array Arreglo asociativo con las transacciones y el paginador
	 */
	public function getMyTransactions($page = 1, $perPage = 10)
	{

		$member_id = $this->memberData['member_id'];


		$offset = ($page - 1) * $perPage;

		// Obtener el total de transacciones
		$queryTotal = $this->db->query("SELECT COUNT(*) FROM `members_transactions` WHERE `member_id` = '{$member_id}'");
		list($total) = $queryTotal->fetch_row();

		// Calcular el total de páginas y generar el paginador
		$paginator = Core::model('paginator', 'core')->pageIndex(array('wallet', 'my_transactions', null, array('member_id' => $member_id)), $total, $perPage);

		// Obtener las transacciones para la página actual
		$queryTransactions = $this->db->query("SELECT * FROM `members_transactions` WHERE `member_id` = '{$member_id}' ORDER BY `timestamp` DESC LIMIT $offset, $perPage");

		$transactions = [];
		if ($queryTransactions && $queryTransactions->num_rows > 0)
		{
			while ($row = $queryTransactions->fetch_assoc())
			{
				$transactions[] = $row;
			}
		}

		return [
			'transactions' => $transactions,
			'pages' => $paginator
		];
	}
}
