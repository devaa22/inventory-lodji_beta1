<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Stok Per Lokasi</h3>

<form method="get">
    <div class="grid-x grid-padding-x">
        <div class="medium-4 cell">
            <select name="location" onchange="this.form.submit()">
                <option value="">-- Pilih Lokasi --</option>
                <?php foreach ($locations as $loc): ?>
                    <option value="<?= $loc['id'] ?>"
                        <?= ($selected == $loc['id']) ? 'selected' : '' ?>>
                        <?= $loc['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
</form>

<?php if ($selected): ?>

<table class="stack">
    <thead>
        <tr>
            <th>Kode</th>
            <th>Item</th>
            <th>Unit</th>
            <th class="text-right">Qty</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($stocks as $stock): ?>
        <tr>
            <td><?= $stock['kode_barang'] ?></td>
            <td><?= $stock['nama_barang'] ?></td>
            <td><?= $stock['satuan'] ?></td>
            <td class="text-right"><?= $stock['qty'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php endif; ?>

<?= $this->endSection() ?>