<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="grid-container">

    <h3>Distribusi Stok</h3>

    <div class="callout">

        <form method="post" action="/stocks/processTransfer">
            
            <div class="grid-x grid-margin-x">

                <!-- Dari -->
                <div class="cell medium-6">
                    <label>Dari Lokasi
                        <input type="hidden" name="from_location" value="<?= $gudang['id'] ?>">
                        <input type="text" value="<?= $gudang['name'] ?>" readonly>
                    </label>
                </div>

                <!-- Ke -->
                <div class="cell medium-6">
                    <label>Ke Lokasi
                        <select name="to_location" required>
                            <option value="">-- Pilih Lokasi --</option>
                            <?php foreach ($sublocations as $loc): ?>
                                <option value="<?= $loc['id'] ?>">
                                    <?= $loc['name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                </div>

                <!-- Item -->
                <div class="cell medium-6">
                    <label>Item
                        <select name="item_id" required>
                            <option value="">-- Pilih Item --</option>
                            <?php foreach ($items as $item): ?>
                                <option value="<?= $item['id'] ?>">
                                    <?= $item['nama_barang'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                </div>

                <!-- Qty -->
                <div class="cell medium-6">
                    <label>Qty
                        <input type="number" step="0.01" name="qty" required>
                    </label>
                </div>

                <!-- Button -->
                <div class="cell">
                    <button type="submit" class="button primary">
                        Distribusi
                    </button>
                    <a href="/stocks" class="button secondary">
                        Batal
                    </a>
                </div>

            </div>

        </form>

    </div>

</div>

<?= $this->endSection() ?>