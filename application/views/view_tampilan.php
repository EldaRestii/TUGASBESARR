<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prediction Form</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/style/main.css') ?>">
</head>

<body>
    <div class="section1" style="background-image: url('<?= base_url('assets/laut.jpg') ?>');">
        <h2>Welcome to Prediction</h2>
        <p>Use this application to make accurate predictions based on the inputs provided.</p>
    </div>

    <div class="card">
        <div class="card-header">
            <h2>Prediction Form</h2>
            <p>Provide your input below to predict the result.</p>
        </div>
        <div class="card-content">
            <form id="predictionForm">
                <label for="Sex">Sex:</label>
                <select name="Sex" id="Sex">
                    <option value="1">Female</option>
                    <option value="0">Male</option>
                </select>

                <label for="Age">Age:</label>
                <input type="number" name="Age" id="Age" placeholder="Enter age" required>

                <label for="No_of_Parents_or_Children_on_Board">Parents/Children on Board:</label>
                <input type="number" name="No_of_Parents_or_Children_on_Board" id="No_of_Parents_or_Children_on_Board"
                    placeholder="Enter number" required>

                <label for="No_of_Siblings_or_Spouses_on_Board">Siblings/Spouses on Board:</label>
                <input type="number" name="No_of_Siblings_or_Spouses_on_Board" id="No_of_Siblings_or_Spouses_on_Board"
                    placeholder="Enter number" required>

                <label for="Passenger_Fare">Passenger Fare:</label>
                <input type="number" step="0.01" name="Passenger_Fare" id="Passenger_Fare" placeholder="Enter fare"
                    required>

                <button type="submit">Predict</button>
            </form>
        </div>
    </div>

    <!-- Additional Sections -->
    <div class="content-section" id="predictionResult">
        <h2>Hasil Prediksi</h2>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#predictionForm').on('submit', function (event) {
                event.preventDefault(); // Mencegah form reload halaman

                $.ajax({
                    url: '<?php echo base_url('PredictController/predict'); ?>', // URL Controller
                    type: 'POST',
                    data: $(this).serialize(), // Ambil data dari formulir
                    dataType: 'json', // Format respons diharapkan JSON
                    success: function (response) {
                        // Jika berhasil, tampilkan hasil prediksi
                        if (response.result !== undefined) {
                            const resultText = response.result == 1
                                ? '<span style="color: green;">Survived ✔</span>'
                                : '<span style="color: red;">Did Not Survive ❌</span>';
                            $('#predictionResult').html(`<p>Prediction Result: ${resultText}</p>`);
                        } else {
                            $('#predictionResult').html('<p style="color: red;">Error: Unable to retrieve prediction result.</p>');
                        }
                    },
                    error: function () {
                        // Jika ada kesalahan, tampilkan pesan error
                        $('#predictionResult').html('<p style="color: red;">Error: Unable to connect to the prediction service.</p>');
                    }
                });
            });
        });
    </script>

</body>

</html>