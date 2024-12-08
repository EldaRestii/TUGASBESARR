<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Predict Form</title>
</head>

<body>
    <h1>Prediction Form</h1>
    <form action="<?php echo base_url('PredictController/predict'); ?>" method="post">
        <label for="Sex">Sex:</label>
        <select name="Sex" id="Sex">
            <option value="0">Female</option>
            <option value="1">Male</option>
        </select>
        <br>

        <label for="Age">Age:</label>
        <input type="number" name="Age" id="Age" required>
        <br>

        <label for="No_of_Parents_or_Children_on_Board">Parents/Children on Board:</label>
        <input type="number" name="No_of_Parents_or_Children_on_Board" id="No_of_Parents_or_Children_on_Board" required>
        <br>

        <label for="No_of_Siblings_or_Spouses_on_Board">Siblings/Spouses on Board:</label>
        <input type="number" name="No_of_Siblings_or_Spouses_on_Board" id="No_of_Siblings_or_Spouses_on_Board" required>
        <br>

        <label for="Passenger_Fare">Passenger Fare:</label>
        <input type="number" step="0.01" name="Passenger_Fare" id="Passenger_Fare" required>
        <br>

        <button type="submit">Predict</button>
    </form>
</body>

</html>