<?php
/**
 * Created by PhpStorm
 * User: codetwista
 * Date: 10/6/2022
 * Time: 5:36 PM
 */
?>
<?= $this->extend('templates/base')?>
<?= $this->section('content') ?>
            <section class="hero is-fullheight">
                <div class="hero-body is-flex is-justify-content-center is-align-items-center">
                    <div class="is-flex is-flex-direction-column is-justify-content-center is-align-items-center box
                    mb-6 form-container">
                        <h1>PD patients management system</h1>
                        <div class="is-flex is-flex-direction-column p-3">
                            <a class="mb-3 button is-danger is-fullwidth" href="register">
                                Register <i class="las la-arrow-right ml-2"></i>
                            </a>
                            <a class="button is-info is-fullwidth" href="login">
                                Login <i class="las la-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
<?= $this->endSection() ?>
