<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Este modelo se encarga de gestionar lo relacionado a los threads (temas)
 *
 */
class locations extends Model
{
  public function getLocationsByContactId($contactId)
  {
    $query = $this->db->query("SELECT * FROM f_locations WHERE contact_id = " . $contactId . " ORDER BY name ASC");
    $data['rows'] = $query->num_rows;
    if ($query and $data['rows'] > 0)
    {
      while ($row = $query->fetch_assoc())
      {
        $data['data'][] = $row;
      }
    }
    return $data;
  }
}
