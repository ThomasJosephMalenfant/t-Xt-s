<a href="<?= url_to('Hermew::search')?>">(<?= esc($reference) ?>)</a>
<br>
<?php if (! empty($textes) && is_array($textes)): ?>

<?php foreach ($textes as $verset): ?>
    <p><?= esc($verset['texte']) ?></p>
<?php endforeach ?>

<?php else: ?>

<h3>Pas de texte...</h3>

<?php endif ?>
