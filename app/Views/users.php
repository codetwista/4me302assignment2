<?php
/**
 * Created by PhpStorm
 * User: codetwista
 * Date: 10/8/2022
 * Time: 11:35 AM
 */
?>
<?= $this->extend('templates/base')?>
<?= $this->section('content') ?>
            <section class="section mt-5">
                <div class="container">
                    <h1>Users</h1>
                    <table class="table is-striped is-narrow is-hoverable is-fullwidth">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Organization</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $counter = 1; ?>
                        <?php foreach ($users as $user): ?>
                        
                        <tr>
                            <td><?= $counter++ ?></td>
                            <td><?= ucwords($user->username) ?></td>
                            <td><?= strtolower($user->email) ?></td>
                            <td><?= ucfirst($user->name) ?></td>
                            <td>
                                <div class="is-flex is-justify-content-flex-end is-align-items-center">
                                    <a class="button is-info is-small" href="">
                                        <i class="las la-user-alt mr-3"></i>View profile
                                    </a>
                                </div>
                           </td>
                        </tr>
                        <?php endforeach ?>
                        
                        </tbody>
                    </table>
                </div>
            </section>
<?= $this->endSection() ?>
