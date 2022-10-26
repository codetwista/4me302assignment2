<?php
/**
 * Created by PhpStorm
 * User: codetwista
 * Date: 10/6/2022
 * Time: 5:29 PM
 */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= esc($title) ?> - PD Patients Management System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <?php if ($uri->getSegment(2) === 'map'): ?>
        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    
        <link rel="stylesheet" type="text/css" href="<?= base_url('css/map.css') ?>" />
        <script type="module" src="<?= base_url('js/index.js') ?>"></script>
    <?php endif ?>
    
    </head>
    <body>
        <header>
            <nav class="navbar is-fixed-top" role="navigation" aria-label="main navigation">
                <div class="navbar-brand pl-2">
                    <a class="navbar-item" href="<?= base_url() ?>">
                        <!--<img src="https://bulma.io/images/bulma-logo.png" width="112" height="28" alt="logo">-->
                        <span class="has-text-weight-bold">PD Patients Management System</span>
                    </a>
                    <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                        <span aria-hidden="true"></span>
                        <span aria-hidden="true"></span>
                        <span aria-hidden="true"></span>
                    </a>
                </div>
                <div id="navbarBasicExample" class="navbar-menu">
                    <div class="navbar-end">
                        <?php if (session()->has('profile')): ?>
                        
                        <div class="navbar-item">
                            Hej <?= ucwords(session()->profile) ?>! You're logged in.
                        </div>
                        <?php if (session()->profile === 'researcher'): ?>
                        
                        <?php if (current_url() !== base_url('news')): ?>
    
                            <div class="navbar-item px-1">
                                <a class="button is-info is-light" href="<?= base_url('news') ?>">Latest news</a>
                            </div>
                        <?php endif ?>
                        
                        <?php endif ?>
                        
                        <div class="navbar-item pl-1 pr-0">
                            <a class="button is-danger is-light" href="<?= base_url('logout') ?>">
                                Log out
                            </a>
                        </div>
                        <?php else: ?>
                        <div class="navbar-item">
                            Hej guest!
                        </div>
                        <?php endif ?>
                        
                        <div class="navbar-item">
                            <?php if (current_url() == base_url('register')): ?>
                            
                            <a class="button is-danger is-light" href="<?= base_url('login') ?>">
                                Log in
                            </a>
                            <?php endif ?>
                            
                            <?php if (current_url() == base_url('login')): ?>
                            
                            <a class="button is-danger is-light" href="<?= base_url('register') ?>">
                                Register
                            </a>
                            <?php endif ?>
                            
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <main>
<?= $this->renderSection('content') ?>
        </main>
        <script
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBKK6yNjFVhQsE3pl2KkURu4RWQSy8QHFs&callback=initMap&v=weekly"
                defer
        ></script>
    </body>
</html>