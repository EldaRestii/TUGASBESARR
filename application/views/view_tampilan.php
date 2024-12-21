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
            <form action="<?php echo base_url('PredictController/predict'); ?>" method="post">
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
    <div class="content-section">
        <h2>Hasil Prediksi</h2>
        <?php if (isset($result) && !empty($result)): ?>
            <p>
                <?php if (isset($result['result'])): ?>
                    Prediction Result: <?= $result['result'] == 1 ? 'Survived' : 'Did Not Survive'; ?>
                <?php else: ?>
                    Error: Unable to retrieve prediction result.
                <?php endif; ?>
            </p>
        <?php elseif (isset($errors)): ?>
            <p style="color: red;"><?= $errors; ?></p>
        <?php else: ?>
            <p>Provide an overview or description here.</p>
        <?php endif; ?>
    </div>

</body>

</html>