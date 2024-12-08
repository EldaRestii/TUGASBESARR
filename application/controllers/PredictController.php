<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PredictController extends CI_Controller {

    public function index() {
        // Tampilkan form
        $this->load->view('view_form_predict');
    }

    public function predict() {
        // Ambil data dari form POST
        $data = [
            'Sex' => $this->input->post('Sex'),
            'Age' => $this->input->post('Age'),
            'No_of_Parents_or_Children_on_Board' => $this->input->post('No_of_Parents_or_Children_on_Board'),
            'No_of_Siblings_or_Spouses_on_Board' => $this->input->post('No_of_Siblings_or_Spouses_on_Board'),
            'Passenger_Fare' => $this->input->post('Passenger_Fare')
        ];
    
        // Log data untuk memastikan format
        log_message('debug', 'Data to be sent: ' . json_encode($data));
    
        // Konversi data ke format JSON
        $jsonData = json_encode($data);
    
        // URL Flask API
        $url = "http://127.0.0.1:5000/predict";
    
        // Kirim request ke API Flask
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    
        // Eksekusi permintaan
        $response = curl_exec($ch);
    
        // Tutup cURL
        curl_close($ch);
    
        // Decode respons API
        $result = json_decode($response, true);
    
        // Log response dari API
        log_message('debug', 'Response from API: ' . $response);
    
        // Tampilkan hasil prediksi
        $this->load->view('view_result_predict', ['result' => $result]);
    }
    
}
