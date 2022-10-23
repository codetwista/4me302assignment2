<?php
/**
 * Created by PhpStorm
 * User: codetwista
 * Date: 10/8/2022
 * Time: 11:16 AM
 */
?>
<?= $this->extend('templates/base')?>
<?= $this->section('content') ?>
            <section class="hero is-fullheight">
                <div class="hero-body is-flex is-justify-content-center is-align-items-center">
                    <div class="is-flex is-flex-direction-column is-justify-content-center box form-container">
                        <h1>PD patients management system</h1>
                        <h2>Register your profile</h2>
                        <p>Use your social handle (name or email)</p>
                        <?php if (! empty($validation)): ?>
                            <div class="notification is-danger is-light my-3">
                                <h2 class="mb-2">Please review your submission!</h2>
                                <?= $validation->listErrors() ?>
                            </div>
                        <?php endif ?>
                        <?php if (session()->getFlashdata('status')): ?>
                            <?= session()->getFlashdata('status') ?>
                        <?php endif ?>
    
                        <?= form_open('', 'class="mt-3"') ?>
                        <div class="field">
                            <div class="control has-icons-left">
                                <div class="select is-fullwidth">
                                    <label for="role"></label>
                                    <select id="role" name="role">
                                        <option value="">Select your profile</option>
                                        <?php foreach ($roles as $role): ?>
                        
                                            <option value="<?= $role->type ?>"<?= set_select('role', $role->type) ?>><?= ucwords($role->name) ?></option>
                                        <?php endforeach; ?>
                
                                    </select>
                                </div>
                                <div class="icon is-small is-left">
                                    <i class="las la-user-alt"></i>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <p class="control has-icons-left has-icons-right">
                                <label for="username"></label>
                                <input class="input" id="username" name="username" type="text"
                                       value="<?= set_value('username') ?>"
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
                                       value="<?= set_value('email') ?>"
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
                                    Register <i class="las la-arrow-right ml-2"></i>
                                </button>
                            </p>
                        </div>
                        <?= form_close() ?>
                        
                    </div>
                </div>
            </section>
<?= $this->endSection() ?>
