<?php
    $doc_content = 'Content unavailable !';

    $airport_token = isset($_GET['a'])? $_GET['a']: 0;
    $company_token = isset($_GET['c'])? $_GET['c']: 0;
    if ($airport_token && $airport_token != '' && $company_token && $company_token != '') {
        include '../config/core.php';
        include '../whitelabelling-webapp/php/objects/service-provider-company.php';
        $sp_company = new ServiceProviderCompany();
        $sp_company->airport_token = $airport_token;
        $sp_company->company_token = $company_token;
        $sp_company->readPrivacyPolicy();

        if ($sp_company->stmt->rowCount() > 0) {
            $doc_content = $sp_company->makeView()[0]->doc_content;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy</title>
</head>
<body>
    <?php echo $doc_content; ?>
</body>
</html>