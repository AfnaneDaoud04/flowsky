<?php
$app_name = "Flowsky";
$version = "1.0";
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $app_name; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5 text-center">
        <h1 class="text-primary">⚡ <?php echo $app_name; ?></h1>
        <p class="text-muted">Your productivity app — v<?php echo $version; ?></p>
        <span class="badge bg-primary">PHP <?php echo phpversion(); ?></span>
    </div>
</body>
</html>