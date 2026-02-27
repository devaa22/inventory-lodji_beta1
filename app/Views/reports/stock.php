<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="grid-container">

    <div class="grid-x grid-margin-x align-middle">
        <div class="cell auto">
            <h3>Laporan Posisi Stok</h3>
        </div>
        <div class="cell shrink">
            <form method="get">
                <button type="submit" name="export" value="pdf" 
                        class="button primary">
                    Export PDF
                </button>
            </form>
        </div>
    </div>

    <div class="callout">
        <table class="hover stack">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Lokasi</th>
                    <th class="text-right">Qty</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <td><?= $row['kode_barang'] ?></td>
                        <td><?= $row['nama_barang'] ?></td>
                        <td><?= $row['lokasi'] ?></td>
                        <td class="text-right">
                            <?= number_format($row['qty'], 2) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<?= $this->endSection() ?>