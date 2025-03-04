<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Este modelo se encarga de gestionar la información sobre la depuración del software
 *
 *
 */

class Debug extends Model
{

    /**
     * Generar informe
     */
    public function show($display = TRUE)
    {
        if ($display == TRUE)
        {
            $sResult = '<span style="color: #3dff00;">' . (number_format(array_sum(explode(' ', microtime())) - START_TIME, 3) . ' segundos</span> ');
            $sResult .= '/ <span style="color: #3dff00;">' . number_format((memory_get_usage() - START_MEMORY) / 1024, 2) . ' kb</span>';
            //
            //$qs = $this->db->query('SHOW STATUS WHERE `Variable_name` = \'Questions\'')->fetch_assoc();
            $qs = $this->db->query("SHOW STATUS WHERE `Variable_name` = 'Questions'")->fetch_assoc();

            $nQueries = $qs['Value'];
            //
            //$sResult .= ' con ' . $nQueries . ' consultas';
            //
            echo $sResult;
            return;
        }
    }
}
