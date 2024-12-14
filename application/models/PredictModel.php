<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PredictModel extends CI_Model {
    public function save_prediction($data) {
        // Simpan data ke tabel dataset
        return $this->db->insert('titanic_data', $data);
    }
}
