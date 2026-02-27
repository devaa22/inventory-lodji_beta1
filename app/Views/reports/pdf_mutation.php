<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Mutasi Stok</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 5px;
            text-align: left;
        }
        th {
            background: #eee;
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>

<h2>Laporan Mutasi Stok</h2>

<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Dari</th>
            <th>Ke</th>
            <th>Item</th>
            <th>Qty</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $row): ?>
            <tr>
                <td><?= $row['tanggal'] ?></td>
                <td><?= $row['dari'] ?></td>
                <td><?= $row['ke'] ?></td>
                <td><?= $row['nama_barang'] ?></td>
                <td class="text-right">
                    <?= number_format($row['qty'], 2) ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>