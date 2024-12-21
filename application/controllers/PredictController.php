<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PredictController extends CI_Controller
{

    public function index()
    {
        // Tampilkan form
        $this->load->view('view_tampilan');
    }

    public function predict()
    {
        // Ambil data dari form POST
        $sexInput = $this->input->post('Sex');
        $ageInput = $this->input->post('Age');
        $parentsInput = $this->input->post('No_of_Parents_or_Children_on_Board');
        $siblingsInput = $this->input->post('No_of_Siblings_or_Spouses_on_Board');
        $fareInput = $this->input->post('Passenger_Fare');

        // Mapping untuk Sex (untuk database)
        $sexMapping = ['0' => 'Male', '1' => 'Female'];
        $sexForDatabase = isset($sexMapping[$sexInput]) ? $sexMapping[$sexInput] : 'Unknown';

        // Validasi input
        $this->load->library('form_validation');
        $this->form_validation->set_rules('Sex', 'Sex', 'required|integer');
        $this->form_validation->set_rules('Age', 'Age', 'required|integer');
        $this->form_validation->set_rules('Passenger_Fare', 'Passenger Fare', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            // Tampilkan error jika validasi gagal
            $this->load->view('view_tampilan', ['errors' => validation_errors()]);
            return;
        }

        // Data untuk prediksi dan database
        $dataForPrediction = [
            'Sex' => $sexInput, // Tetap integer untuk API Flask
            'Age' => $ageInput,
            'No_of_Parents_or_Children_on_Board' => $parentsInput,
            'No_of_Siblings_or_Spouses_on_Board' => $siblingsInput,
            'Passenger_Fare' => $fareInput
        ];

        $dataForDatabase = [
            'Sex' => $sexForDatabase, // String untuk database
            'Age' => $ageInput,
            'No_of_Parents_or_Children_on_Board' => $parentsInput,
            'No_of_Siblings_or_Spouses_on_Board' => $siblingsInput,
            'Passenger_Fare' => $fareInput
        ];

        // Kirim data ke API Flask
        $jsonData = json_encode($dataForPrediction);
        $url = "http://127.0.0.1:5000/predict";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200 || !$response) {
            // Jika API tidak aktif atau ada error, tampilkan pesan kesalahan
            $this->load->view('view_tampilan', ['errors' => 'Prediction service is currently unavailable.']);
            return;
        }

        // Decode respons API
        $result = json_decode($response, true);

        // Mapping untuk Survived (untuk database)
        $survivedMapping = ['0' => 'No', '1' => 'Yes'];
        $survivedForDatabase = isset($result['result']) ? ($survivedMapping[$result['result']] ?? 'Unknown') : 'Error';

        // Tambahkan hasil prediksi ke data untuk database
        $dataForDatabase['Survived'] = $survivedForDatabase;

        // Simpan data ke database
        $this->load->model('PredictModel');
        $this->PredictModel->save_prediction($dataForDatabase);

        // Tampilkan hasil prediksi
        $this->load->view('view_tampilan', ['result' => $result]);
    }
}
