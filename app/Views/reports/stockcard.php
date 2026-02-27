<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="grid-container">

    <div class="grid-x grid-margin-x align-middle">
        <div class="cell auto">
            <h3>Kartu Stok</h3>
        </div>
        <div class="cell shrink">
            <form method="get">
                <button type="submit" name="export" value="pdf" 
                        class="button success">
                    Export PDF
                </button>
            </form>
        </div>
    </div>

    <div class="callout secondary">
        <form method="get" class="grid-x grid-margin-x">
            <div class="cell small-4">
                <label>Item ID
                    <input type="number" name="item" required>
                </label>
            </div>
            <div class="cell small-2 align-self-bottom">
                <button type="submit" class="button primary">
                    Tampilkan
                </button>
            </div>
        </form>
    </div>

    <div class="callout">
        <table class="hover stack">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th class="text-right">Masuk</th>
                    <th class="text-right">Keluar</th>
                    <th class="text-right">Saldo</th>
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
                        <td class="text-right">
                            <?= number_format($row['masuk'],2) ?>
                        </td>
                        <td class="text-right">
                            <?= number_format($row['keluar'],2) ?>
                        </td>
                        <td class="text-right">
                            <?= number_format($saldo,2) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<?= $this->endSection() ?>