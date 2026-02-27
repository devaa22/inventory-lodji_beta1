<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kartu Stok</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid #000; }
        th, td { padding: 6px; }
        th { background: #eee; }
        .text-right { text-align: right; }
    </style>
</head>
<body>

<h2>KARTU STOK</h2>
Dicetak: <?= date('d-m-Y H:i') ?>

<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Masuk</th>
            <th>Keluar</th>
            <th>Saldo</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $saldo = 0;
        foreach ($data as $row): 
            $saldo += $row['masuk'];
            $saldo -= $row['keluar'];
        ?>
        <tr>
            <td><?= $row['tanggal'] ?></td>
            <td class="text-right"><?= number_format($row['masuk'],2) ?></td>
            <td class="text-right"><?= number_format($row['keluar'],2) ?></td>
            <td class="text-right"><?= number_format($saldo,2) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>