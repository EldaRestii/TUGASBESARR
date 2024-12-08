<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Prediction Result</title>
</head>

<body>
    <h1>Prediction Result</h1>
    <?php if (isset($result['result'])): ?>
        <p><strong>Prediction:</strong> <?php echo $result['result']; ?></p>
        <?php if ($result['result'] == 1): ?>
            <p><strong>Note:</strong> The passenger is predicted to survive.</p>
        <?php else: ?>
            <p><strong>Note:</strong> The passenger is predicted not to survive.</p>
        <?php endif; ?>
    <?php elseif (isset($result['error'])): ?>
        <p><strong>Error:</strong> <?php echo $result['error']; ?></p>
    <?php else: ?>
        <p><strong>Error:</strong> Unexpected response from API.</p>
    <?php endif; ?>
    <a href="<?php echo base_url('PredictController'); ?>">Back to Form</a>
</body>

</html>
