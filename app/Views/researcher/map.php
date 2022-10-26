<?php
/**
 * Created by PhpStorm
 * User: codetwista
 * Date: 10/26/2022
 * Time: 7:05 AM
 */
?>
<?= $this->extend('templates/base')?>
<?= $this->section('content') ?>
            <section class="section">
                <div class="container">
                    <h1>Patient's location overview</h1>
                    <div id="map"></div>
                </div>
            </section>
<?= $this->endSection() ?>
