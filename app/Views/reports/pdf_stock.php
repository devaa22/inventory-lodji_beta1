<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Posisi Stok</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h2 { margin-bottom: 5px; }
        .info { margin-bottom: 15px; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid #000; }
        th, td { padding: 6px; }
        th { background: #eee; }
        .text-right { text-align: right; }
    </style>
</head>
<body>

<h2>LAPORAN POSISI STOK</h2>

<div class="info">
    Dicetak pada: <?= date('d-m-Y H:i') ?>
</div>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Lokasi</th>
            <th>Qty</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach ($data as $row): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['nama_barang'] ?></td>
            <td><?= $row['lokasi'] ?></td>
            <td class="text-right"><?= number_format($row['qty'],2) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>