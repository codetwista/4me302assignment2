<?php
/**
 * Created by PhpStorm
 * User: codetwista
 * Date: 10/19/2022
 * Time: 8:34 PM
 */
?>
<?= $this->extend('templates/base')?>
<?= $this->section('content') ?>
            <section class="hero is-fullheight">
                <div class="hero-body is-flex is-justify-content-center is-align-items-center">
                    <section class="section">
                        <div class="container p-3">
                            <?php $counter = 1; ?>
                            <?php foreach($news->children() as $item): ?>
        
                            <div class="box">
                                <div class="mb-3">
                                    <h1><?= (string)$item->title ?></h1>
                                    <h2><?= (string)$item->description ?></h2>
                                    <p><a href="<?= (string)$item->link ?>" target="_blank"><?= (string)$item->link ?></a></p>
                                </div>
                                <?php foreach ($item->children()->item as $content): ?>
                
                                    <div class="mt-3">
                                        <p class="has-text-weight-bold"><?= $counter++ . '. ' . (string)$content->title ?></p>
                                        <p><?= (string)$content->description ?></p>
                                        <p><a href="<?= (string)$content->link ?>" target="_blank"><?= (string)$content->link ?></a></p>
                                        <div class="columns mt-1 mb-5">
                                            <div class="column">
                                                <?php $namespaces = $content->getNamespaces(true); ?>
                                                <figure class="image is-square">
                                                    <a href="<?= (string)$content->link ?>" target="_blank">
                                                        <img src="<?= trim((string)$content->children($namespaces['media'])->attributes()->url) ?>" alt="">
                                                    </a>
                                                </figure>
                                            </div>
                                            <div class="column is-three-quarters">
                                                <p>Comments: <a href="<?= (string)$content->comments ?>" target="_blank"><?=
                                                        (string)
                                                        $content->comments ?></a></p>
                                                <p class="my-3">Guide: <a href="<?= (string)$content->guid ?>" target="_blank"><?= (string)
                                                        $content->guid ?></a></p>
                                                <p>Publication date: <?= (string)$content->pubDate ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
            
                                <?php endforeach ?>
        
                            </div>
                        </div>
                    </section>
                </div>
            </section>
<?= $this->endSection() ?>
