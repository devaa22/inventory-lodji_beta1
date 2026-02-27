<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Inventory System</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/foundation-sites@6.8.1/dist/css/foundation.min.css">

    <style>
        body { padding: 20px; }
        .top-bar { margin-bottom: 20px; }
        .content { margin-top: 20px; }
        table { width: 100%; }
    </style>
</head>
<body>

<div class="top-bar">
    <div class="top-bar-left">
        <ul class="dropdown menu" data-dropdown-menu>
            <li class="menu-text">Inventory</li>
            <li><a href="/dashboard">Dashboard</a></li>
            <li><a href="/stocks">Stok</a></li>
            <li><a href="/stocks/receive">Penerimaan</a></li>
            <li><a href="/stocks/transfer">Transfer</a></li>
            <li>
                <a href="#">Laporan</a>
                <ul class="menu vertical">
                    <li><a href="/reports/stock">Posisi Stok</a></li>
                    <li><a href="/reports/mutation">Mutasi</a></li>
                    <li><a href="/reports/stockin">Penerimaan</a></li>
                    <li><a href="/reports/stockcard">Kartu Stok</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <div class="top-bar-right">
        <ul class="menu">
            <li><span><?= session()->get('name') ?> (<?= session()->get('role_name') ?>)</span></li>
            <li><a href="/logout">Logout</a></li>
        </ul>
    </div>
</div>

<div class="grid-container content">
    <?= $this->renderSection('content') ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/foundation-sites@6.8.1/dist/js/foundation.min.js"></script>
<script>
    $(document).foundation();
</script>

</body>
</html>