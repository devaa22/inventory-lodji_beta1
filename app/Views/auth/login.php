<?= $this->extend('layouts/auth') ?>
<?= $this->section('content') ?>

<div class="grid-container full-height">
    <div class="grid-x align-center align-middle" style="min-height: 80vh;">
        <div class="cell medium-4">

            <div class="callout">

                <h4 class="text-center">Login Sistem Inventaris</h4>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="callout alert">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <form method="post" action="/login">

                    <label>Username
                        <input type="text" name="username" required>
                    </label>

                    <label>Password
                        <input type="password" name="password" required>
                    </label>

                    <button type="submit" class="button expanded primary">
                        Login
                    </button>

                </form>

            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>