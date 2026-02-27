<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Penerimaan Bahan Baku</h3>

<form method="post" action="/stocks/processReceive">
    <div class="grid-x grid-padding-x">
        <div class="medium-4 cell">
            <label>Item
                <select name="item_id" required>
                    <?php foreach ($items as $item): ?>
                        <option value="<?= $item['id'] ?>">
                            <?= $item['nama_barang'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label>
        </div>

        <div class="medium-4 cell">
            <label>Qty
                <input type="number" step="0.01" name="qty" required>
            </label>
        </div>
    </div>

    <button class="button success">Terima Barang</button>
</form>

<?= $this->endSection() ?>