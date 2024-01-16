<main class="main-content">
    <p id="formatModel">Modèle : </p>
    <div is="red-acteur" id="redacteur"></div>
</main>
<section class="left-sidebar">
<form id="form_ctxt">
    <label for="corpus">Corpus</label>
    <select name="corpus" id="corpus">
    <?php foreach ($corpus as $item): ?>
        <option value="<?= esc($item["id"]) ?>"><?= esc($item["nom"]) ?></option>
    <?php endforeach ?>
    </select>
    <br>

    <label for="version">Version</label>
    <select name="version" id="version" disabled>
    </select>
    <br>

    <label for="livre">Livre</label>
    <select name="livre" id="livre" disabled>
    </select>
    <br>

    <label for="chap">Chapitre</label>
    <select name="chap" id="chap" disabled>
    </select>
    <br>
    <label for="debut">Marqueur de début</label>
    <input type="text" id="debut" name="debut" required minlength="1" maxlength="3" size="4" />    <br>
    <br>
    <label for="sep">Séparateur</label>
    <input type="text" id="sep" name="sep" required minlength="1" maxlength="3" size="4" />    <br>
    <br>
    <label for="fin">Marqueur de fin</label>
    <input type="text" id="fin" name="fin" required minlength="1" maxlength="3" size="4" />    <br>
    <br>
</form>
</section>
<aside class="right-sidebar">
    <p>Aside droite</p>
</aside>
<script src="/js/grafw/grafw.js"></script>