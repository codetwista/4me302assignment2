<?php
/**
 * Created by PhpStorm
 * User: codetwista
 * Date: 10/8/2022
 * Time: 11:09 AM
 */
?>
<?= $this->extend('templates/base')?>
<?= $this->section('content') ?>
            <section class="hero is-fullheight">
                <div class="hero-body is-flex is-justify-content-center is-align-items-center">
                    <div class="is-flex is-flex-direction-column is-justify-content-center
                is-align-items-center box mb-6 form-container">
                        <h1>PD patients management system</h1>
                        <h2 class="mb-5">Log in</h2>
                        <?php if (session()->getFlashdata('status')): ?>
                            <?= session()->getFlashdata('status') ?>
                        <?php endif ?>
                        
                        <!--<?/*= form_open('', 'class="mt-3"') */?>
                        <div class="field">
                            <p class="control has-icons-left has-icons-right">
                                <label for="username"></label>
                                <input class="input" id="username" name="username" type="text"
                                       value="<?/*= set_value('username') */?>"
                                       placeholder="Enter user name"
                                       required>
                                <span class="icon is-small is-left">
                                  <i class="las la-user"></i>
                                </span>
                            </p>
                        </div>
                        <div class="field">
                            <p class="control has-icons-left has-icons-right">
                                <label for="email"></label>
                                <input class="input" id="email" name="email" type="email"
                                       value="<?/*= set_value('email') */?>"
                                       placeholder="Enter valid email address"
                                       required>
                                <span class="icon is-small is-left">
                                  <i class="las la-envelope"></i>
                                </span>
                            </p>
                        </div>
                        <div class="field">
                            <p class="control">
                                <button class="button is-danger is-fullwidth">
                                    Log in <i class="las la-arrow-right ml-2"></i>
                                </button>
                            </p>
                        </div>
                        <?/*= form_close() */?>-->
                        <div class="is-flex is-justify-content-center is-align-items-center">
                            <!--<div class="brand">
                                <a class="is-flex is-justify-content-center box mx-2 px-2 py-4" href="">
                                    <img src="<?/*= base_url('images/logo_facebook.png') */?>" alt="Facebook logo">
                                </a>
                            </div>-->
                            <div class="brand">
                                <a class="is-flex is-justify-content-center box mx-2 px-2 py-4" href="<?= base_url('github/login') ?>">
                                    <img src="<?= base_url('images/logo_github.png') ?>" alt="GitHub logo">
                                </a>
                            </div>
                            <?php if (isset($data['googleAuthURL'])): ?>
            
                                <div class="brand">
                                    <a class="is-flex is-justify-content-center box mx-2 px-2 py-4" href="<?= $data['googleAuthURL'] ?>">
                                        <img src="<?= base_url('images/logo_gmail.png') ?>" alt="GMail logo">
                                    </a>
                                </div>
                            <?php endif ?>
        
                            <div class="brand">
                                <a class="is-flex is-justify-content-center box mx-2 px-2 py-4" href="<?= base_url('twitter/login') ?>">
                                    <img src="<?= base_url('images/logo_twitter.png') ?>" alt="Twitter logo">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
<?= $this->endSection() ?>
