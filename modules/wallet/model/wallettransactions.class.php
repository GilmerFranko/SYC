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

class WalletTransactions extends Session
{
    public function __construct()
    {
        parent::__construct();
        $this->session = Core::model('session', 'core');
    }

    /**
     * Obtiene un deposito
     *
     * @return array Arreglo asociativo
     */
    public function getDeposit($deposit_id)
    {
        $query = $this->db->query("SELECT * FROM `site_deposits` WHERE `id` = {$deposit_id}");

        if ($query && $query->num_rows > 0)
        {
            return $query->fetch_assoc();
        }

        return false;
    }

    /**
     * Obtiene todos los retiros de un usuario con paginación
     *
     * @param int $member_id ID del usuario
     * @param int $page Número de página
     * @param int $perPage Cantidad de retiros por página
     * @return array Arreglo asociativo con los retiros del usuario y el paginador
     */
    public function getWithdrawals($member_id, $page = 1, $perPage = 10)
    {
        $offset = ($page - 1) * $perPage;

        // Obtener el total de retiros
        $queryTotal = $this->db->query("SELECT COUNT(*) FROM `site_withdrawals` WHERE `member_id` = '{$member_id}'");
        list($total) = $queryTotal->fetch_row();

        // Calcular el total de páginas y generar el paginador
        $paginator = Core::model('paginator', 'core')->pageIndex(array('admin', 'withdrawals', null, array('member_id' => $member_id)), $total, $perPage);

        // Obtener los retiros para la página actual
        $queryWithdrawals = $this->db->query("SELECT * FROM `site_withdrawals` WHERE `member_id` = '{$member_id}' ORDER BY `created_at` DESC LIMIT $offset, $perPage");

        $withdrawals = [];
        if ($queryWithdrawals && $queryWithdrawals->num_rows > 0)
        {
            while ($row = $queryWithdrawals->fetch_assoc())
            {
                $withdrawals[] = $row;
            }
        }

        return [
            'data' => $withdrawals,
            'pages' => $paginator
        ];
    }


    /**
     * Obtiene todos los depósitos pendientes
     *
     * @return array Arreglo asociativo con los depósitos pendientes
     */
    public function getPendingDeposits()
    {
        $query = $this->db->query("SELECT * FROM `site_deposits` WHERE `status` = 0");

        $deposits = [];
        if ($query && $query->num_rows > 0)
        {
            while ($row = $query->fetch_assoc())
            {
                $deposits[] = $row;
            }
        }

        return $deposits;
    }

    /**
     * Obtiene cantidad de los depósitos pendientes
     *
     * @return array Arreglo asociativo con los depósitos pendientes
     */
    public function getPendingDepositsCount()
    {
        $query = $this->db->query("SELECT COUNT(*) AS `count` FROM `site_deposits` WHERE `status` = 0");

        if ($query && $query->num_rows > 0)
        {

            $row = $query->fetch_assoc();

            return $row['count'];
        }
        return 0;
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
     * Marca un depósito como completado
     *
     * @param int $deposit_id ID del depósito
     * @return bool True si se marcó como completado correctamente, false en caso contrario
     */
    public function completeDeposit($deposit_id)
    {
        $query = $this->db->query("UPDATE `site_deposits` SET `status` = 1 WHERE `id` = {$deposit_id}");

        return $query ? true : false;
    }

    /**
     * Crea un nuevo depósito
     *
     * @param int $member_id ID del miembro
     * @param float $amount Monto del depósito
     * @param string $binance_email Correo electrónico de Binance
     * @param string $binance_id ID de Binance
     * @param string $binance_fullname Nombre completo de Binance
     * @param string $reference Referencia
     * @return bool True si se creó el depósito correctamente, false en caso contrario
     */
    public function createDeposit($member_id, $amount, $binance_email, $binance_id, $binance_fullname, $reference)
    {
        $amount = $this->db->real_escape_string($amount);
        $reference = $this->db->real_escape_string($reference);
        $time = time();

        $query = $this->db->query("INSERT INTO `site_deposits` (`member_id`, `amount`, `binance_email`, `binance_id`, `binance_fullname`, `reference`, `status`, `created_at`) VALUES ('$member_id', '$amount', '$binance_email', '$binance_id', '$binance_fullname', '$reference', 0, {$time})");

        return $query ? $this->db->insert_id : false;
    }

    /**
     * Crea un nuevo retiro
     * @param int $member_id ID del miembro
     * @param float $amount Monto del retiro
     * @param string $email Email
     * @param int $binance_id ID de Binance
     * @param string $binance_fullname Nombre completo de Binance
     * @param string $reference Referencia
     * @return bool True si se creó el retiro correctamente, false en caso contrario
     */
    public function createWithdrawal($member_id, $amount, $email, $binance_id, $binance_fullname)
    {
        // Descuenta el dinero al usuario
        if (loadClass('members/transactions')->updateBalance($member_id, $amount, false, 'withdrawalUser'))
        {
            $time = time();
            $status = 0; // Estado inicial del retiro: Pendiente

            // Preparar la consulta SQL para insertar el nuevo retiro en la tabla de retiros
            $query = "INSERT INTO `site_withdrawals` (`member_id`, `amount`, `binance_email`, `binance_id`, `binance_fullname`, `status`, `created_at`) 
            VALUES ('$member_id', '$amount', '$email', '$binance_id', '$binance_fullname', '$status', '$time')";


            // Ejecutar la consulta
            if ($this->db->query($query))
            {
                return true; // Retorno true si se creó el retiro correctamente
            }
            else
            {
                // Si ocurre un error al ejecutar la consulta, revertir el descuento de saldo realizado previamente
                loadClass('members/transactions')->updateBalance($member_id, $amount, true, 'withdrawal');
                return false; // Retorno false si hubo un error al crear el retiro
            }
        }

        return false; // Retorno false si no se pudo descontar el dinero del usuario
    }
}
