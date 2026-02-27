<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Dashboard</h3>

<div class="callout primary">
    Halo, <?= session()->get('name') ?>
</div>

<?= $this->endSection() ?>