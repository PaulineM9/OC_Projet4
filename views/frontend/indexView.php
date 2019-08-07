<?php $title = 'le blog de Jean Forteroche'; ?>

<section class="index_title">
    <h1>Billet simple pour l'Alaska</h1>
    <h2>Jean Forteroche</h2>
    <h3>Acteur et Ecrivain</h3>
</section>
<section class="index_chapters">
    <div class="pagination">
        <?php foreach ($chapters as $chapter) { ?>
            <div class="chapters_published">
                <h3><?= $chapter->getTitle() ?></h3><br />
                <a href="index.php?action=chapter&id=<?= $chapter->getId() ?>">Lire</a>
            </div>
        <?php } ?>

        <div class="pagePagination">
            <?php for ($i = 1; $i <= $nbPage; $i++) {
                if ($i == $cPage) {
                    echo " $i /";
                } else {
                    echo " <a href=\"index.php?p=$i\">$i</a> /";
                }
            } ?>
        </div>
    </div>
</section>

