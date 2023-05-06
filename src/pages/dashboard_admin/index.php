<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboard_admin.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="navbar">
            <?php include '../../components/navbar/index.php' ?>
        </div>
        <div class="content">
            <div class="sidebar">
                <?php include '../../components/sidebar/index.php' ?>
            </div>
            <div class="main-content">
                <?php
                @$page = $_GET['page'];
                if (!empty($page)) {
                    switch ($page) {
                        case 'home':
                            include '../../components/home/index.php';
                            break;
                        case 'data-pasien':
                            include '../../components/data_pasien/index.php';
                            break;
                        case 'antrian-poli':
                            include '../../components/antrian_poli/index.php';
                            break;
                        case 'data-poli':
                            include '../../components/data_poli/index.php';
                            break;
                        case 'tambah-user':
                            include '../../components/tambah_user/index.php';
                            break;
                        case 'tambah-poli':
                            include '../../components/tambah_poli/index.php';
                            break;
                        case 'edit-user':
                            include '../../components/edit_user/index.php';
                            break;
                        case 'edit-poli':
                            include '../../components/edit_poli/index.php';
                            break;
                        case 'pengunjung':
                            include '../../components/pengunjung/index.php';
                            break;
                        default:
                            include '../../components/home/index.php';
                            break;
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>