<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Laporan Mutasi</h3>

<form method="get" class="grid-x grid-padding-x align-middle">
    <div class="medium-3 cell">
        <input type="date" name="from">
    </div>
    <div class="medium-3 cell">
        <input type="date" name="to">
    </div>
    <div class="medium-6 cell">
        <button class="button">Filter</button>
        <button class="button warning" name="export" value="excel">Excel</button>
        <button class="button alert" name="export" value="pdf">PDF</button>
    </div>
</form>

<table class="hover stack">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Dari</th>
            <th>Ke</th>
            <th>Item</th>
            <th class="text-right">Qty</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $row): ?>
        <tr>
            <td><?= $row['tanggal'] ?></td>
            <td><?= $row['dari'] ?></td>
            <td><?= $row['ke'] ?></td>
            <td><?= $row['nama_barang'] ?></td>
            <td class="text-right"><?= number_format($row['qty'],2) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>