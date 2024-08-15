<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Modelo para gestionar los depósitos y retiros de los usuarios
 *
 *
 */

class Wallet extends Session
{
	public function __construct()
	{
		parent::__construct();
		$this->session = Core::model('session', 'core');
	}

	/**
	 * Obtiene todos los depósitos pendientes (con paginación)
	 *
	 * @param int $page Número de página
	 * @param int $perPage Cantidad de elementos por página
	 * @return array Arreglo asociativo con los depósitos pendientes y la información de paginación
	 */
	public function getPendingDeposits($page = 1, $perPage = 10)
	{
		$offset = ($page - 1) * $perPage;

		// Consulta para obtener el total de depósitos pendientes
		$queryTotal = $this->db->query("SELECT COUNT(*) FROM `site_deposits` WHERE `status` = 0");
		list($total) = $queryTotal->fetch_row();

		// Calcular el total de páginas y generar el paginador
		$paginator = Core::model('paginator', 'core')->pageIndex(['admin', 'deposits', null, null], $total, $perPage);

		// Consulta para obtener los depósitos pendientes para la página actual
		$queryDeposits = $this->db->query("SELECT * FROM `site_deposits` WHERE `status` = 0 ORDER BY `created_at` DESC LIMIT $offset, $perPage");

		$deposits = [];
		if ($queryDeposits && $queryDeposits->num_rows > 0)
		{
			while ($row = $queryDeposits->fetch_assoc())
			{
				$row['username'] = loadClass('members/member')->getName($row['member_id']);
				$deposits[] = $row;
			}
		}

		return [
			'deposits' => $deposits,
			'paginator' => $paginator
		];
	}

	/**
	 * Obtiene todos los depósitos pendientes (con paginación)
	 *
	 * @param int $page Número de página
	 * @param int $perPage Cantidad de elementos por página
	 * @return array Arreglo asociativo con los depósitos pendientes y la información de paginación
	 */
	public function getPendingWithdrawals($page = 1, $perPage = 10)
	{
		$offset = ($page - 1) * $perPage;

		// Consulta para obtener el total de depósitos pendientes
		$queryTotal = $this->db->query("SELECT COUNT(*) FROM `site_withdrawals` WHERE `status` = 0");
		list($total) = $queryTotal->fetch_row();

		// Calcular el total de páginas y generar el paginador
		$paginator = Core::model('paginator', 'core')->pageIndex(['admin', 'withdrawals', null, null], $total, $perPage);

		// Consulta para obtener los depósitos pendientes para la página actual
		$queryWithdrawals = $this->db->query("SELECT * FROM `site_withdrawals` WHERE `status` = 0 ORDER BY `created_at` DESC LIMIT $offset, $perPage");

		$withdrawals = [];
		if ($queryWithdrawals && $queryWithdrawals->num_rows > 0)
		{
			while ($row = $queryWithdrawals->fetch_assoc())
			{
				$row['username'] = loadClass('members/member')->getName($row['member_id']);
				$withdrawals[] = $row;
			}
		}

		return [
			'data' => $withdrawals,
			'paginator' => $paginator
		];
	}

	/**
	 * Obtiene todos los depósitos (con paginación)
	 *
	 * @param int $page Número de página
	 * @param int $perPage Cantidad de elementos por página
	 * @return array Arreglo asociativo con los depósitos pendientes y la información de paginación
	 */
	public function getAllDeposits($page = 1, $perPage = 10)
	{
		$offset = ($page - 1) * $perPage;

		// Consulta para obtener el total de depósitos pendientes
		$queryTotal = $this->db->query("SELECT COUNT(*) FROM `site_deposits`");
		list($total) = $queryTotal->fetch_row();

		// Calcular el total de páginas y generar el paginador
		$paginator = Core::model('paginator', 'core')->pageIndex(['admin', 'deposits', null, null], $total, $perPage);

		// Consulta para obtener los depósitos pendientes para la página actual
		$queryDeposits = $this->db->query("SELECT * FROM `site_deposits` ORDER BY `created_at` DESC LIMIT $offset, $perPage");

		$deposits = [];
		if ($queryDeposits && $queryDeposits->num_rows > 0)
		{
			while ($row = $queryDeposits->fetch_assoc())
			{
				$row['username'] = loadClass('members/member')->getName($row['member_id']);
				$deposits[] = $row;
			}
		}

		return [
			'deposits' => $deposits,
			'paginator' => $paginator
		];
	}

	/**
	 * Obtiene todos los retiros (con paginación)
	 *
	 * @param int $page Número de página
	 * @param int $perPage Cantidad de elementos por página
	 * @return array Arreglo asociativo con los retiros pendientes y la información de paginación
	 */
	public function getAllWithdrawals($page = 1, $perPage = 10)
	{
		$offset = ($page - 1) * $perPage;

		// Consulta para obtener el total de retiros pendientes
		$queryTotal = $this->db->query("SELECT COUNT(*) FROM `site_withdrawals`");
		list($total) = $queryTotal->fetch_row();

		// Calcular el total de páginas y generar el paginador
		$paginator = Core::model('paginator', 'core')->pageIndex(['admin', 'withdrawals', null, null], $total, $perPage);

		// Consulta para obtener los retiros pendientes para la página actual
		$queryWithdrawals = $this->db->query("SELECT * FROM `site_withdrawals` ORDER BY `created_at` DESC LIMIT $offset, $perPage");

		$deposits = [];
		if ($queryWithdrawals && $queryWithdrawals->num_rows > 0)
		{
			while ($row = $queryWithdrawals->fetch_assoc())
			{
				$row['username'] = loadClass('members/member')->getName($row['member_id']);
				$deposits[] = $row;
			}
		}

		return [
			'data' => $deposits,
			'paginator' => $paginator
		];
	}

	/**
	 * Marca un retiro como completado
	 *
	 * @param int $withdrawal_id ID del retiro
	 * @return bool True si se marcó como completado correctamente, false en caso contrario
	 */
	public function completeWithdrawal($withdrawal_id)
	{
		$query = $this->db->query("UPDATE `site_withdrawals` SET `status` = 1 WHERE `id` = {$withdrawal_id}");

		return $query ? true : false;
	}

	/**
	 * Cambia el estado de un deposit
	 *
	 * @param int $deposit_id ID del depósito
	 * @param int $status Nuevo estado [0: pendiente, 1: completado, 2: cancelado]
	 * @return bool True si se marcó como completado correctamente, false en caso contrario
	 */
	public function setDepositStatus($deposit_id, $status): bool
	{
		$query = $this->db->query("UPDATE `site_deposits` SET `status` = $status WHERE `id` = {$deposit_id}");

		return $query ? true : false;
	}

	/**
	 * Cambia el estado de un retiro
	 *
	 * @param int $deposit_id ID del depósito
	 * @param int $status Nuevo estado [0: pendiente, 1: completado, 2: cancelado]
	 * @return bool True si se marcó como completado correctamente, false en caso contrario
	 */
	public function setWithdrawalStatus($withdrawal_id, $status): bool
	{
		$query = $this->db->query("UPDATE `site_withdrawals` SET `status` = $status WHERE `id` = {$withdrawal_id}");

		return $query ? true : false;
	}


	/**
	 * Obtiene un depósito pendiente
	 * @param int $deposit_id ID del depósito
	 * @return array Arreglo asociativo con los depósitos pendientes y la información de paginación
	 */
	public function getPendingDeposit($deposit_id)
	{
		$query = $this->db->query("SELECT * FROM `site_deposits` WHERE `id` = {$deposit_id}");

		if ($query && $query->num_rows > 0)
		{
			$row = $query->fetch_assoc();
			$row['username'] = loadClass('members/member')->getName($row['member_id']);

			return $row;
		}
		return false;
	}

	/**
	 * Optiene un retiro
	 * @param int $withdrawal_id ID del retiro
	 * @return array
	 */
	public function getWithdrawal($withdrawal_id)
	{
		$query = $this->db->query("SELECT * FROM `site_withdrawals` WHERE `id` = {$withdrawal_id}");

		if ($query && $query->num_rows > 0)
		{
			$row = $query->fetch_assoc();
			$row['username'] = loadClass('members/member')->getName($row['member_id']);

			return $row;
		}
		return false;
	}
}
