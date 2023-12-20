<h2><?= esc($title) ?></h2>

<?php if (! empty($livres) && is_array($livres)): ?>

    <?php foreach ($livres as $livre_item): ?>

        <h3><?= esc($livre_item['nom']) ?></h3>

        <div class="main">
            <?= esc($livre_item['titre']) ?>
        </div>
        <p><a href="/livres/<?= esc($livre_item['abbr'], 'url') ?>">Voir le livre</a></p>

    <?php endforeach ?>

<?php else: ?>

    <h3>Pas de livre !</h3>

    <p>Pas de livre de la DB !</p>

<?php endif ?>