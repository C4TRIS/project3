<?php
    require_once 'secure.php';
    if (!Helper::can('admin')) {
        header('Location: 404.php');
        exit();
    }
    if (isset($_POST['company_id'])) {
        $company = new Company();
        $company->company_id = Helper::clearInt($_POST['company_id']);
        $company->name = Helper::clearString($_POST['name']);

        if ((new CompanyMap())->save($company)) {
            header('Location: view-company.php?id='.$company->company_id);
        } else {
            if ($company->company_id) {
                header('Location: add-company.php?id='.$company->company_id);
            } else {
                header('Location: add-company.php');
            }
        }
    }
?>