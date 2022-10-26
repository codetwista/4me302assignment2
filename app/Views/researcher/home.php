<?php
/**
 * Created by PhpStorm
 * User: codetwista
 * Date: 10/8/2022
 * Time: 2:36 PM
 */
?>
<?= $this->extend('templates/base')?>
<?= $this->section('content') ?>
            <?php if (! empty($userData)): ?>
            
            <section class="section">
                <div class="container">
                    <h1>Patients information</h1>
                    <table class="table is-striped is-narrow is-hoverable is-fullwidth">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $counter = 1; ?>
                        <?php foreach ($patients as $patient): ?>
                            <tr>
                                <td><?= $counter++ ?></td>
                                <td><?= ucwords($patient->username) ?></td>
                                <td><?= strtolower($patient->email) ?></td>
                            </tr>
                        <?php endforeach ?>
            
                        </tbody>
                    </table>
                </div>
            </section>
            <section>
                <div class="container">
                    <h1>Patients data files</h1>
                    <table class="table is-striped is-narrow is-hoverable is-fullwidth">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Data Files</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $counter = 1; ?>
                        <?php foreach ($userData as $data): ?>
                            <tr>
                                <td><?= $counter++ ?></td>
                                <td><?= ucwords($data->username) ?></td>
                                <td><a href="<?= base_url('uploads/data/' . $data->DataURL) ?>.csv"><?=
                                        ucwords($data->DataURL) ?></a></td>
                            </tr>
                        <?php endforeach ?>
                        
                        </tbody>
                    </table>
                </div>
            </section>
            <?php endif ?>

<?= $this->endSection() ?>
