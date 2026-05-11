<nav aria-label="Pagination">
    <ul class="pagination justify-content-center mt-4">

        <!-- Bouton précédent -->
        <?php if ($pager->hasPrevious()) : ?>
            <li class="page-item">
                <a class="page-link rounded-start-pill px-3"
                   href="<?= $pager->getPreviousPage() ?>">
                    &laquo;
                </a>
            </li>
        <?php else : ?>
            <li class="page-item disabled">
                <span class="page-link rounded-start-pill px-3">&laquo;</span>
            </li>
        <?php endif ?>

        <!-- Numéros de pages -->
        <?php foreach ($pager->links() as $link) : ?>

            <?php if ($link['active']) : ?>
                <li class="page-item active">
                    <span class="page-link fw-bold px-3">
                        <?= $link['title'] ?>
                    </span>
                </li>
            <?php else : ?>
                <li class="page-item">
                    <a class="page-link px-3"
                       href="<?= $link['uri'] ?>">
                        <?= $link['title'] ?>
                    </a>
                </li>
            <?php endif ?>

        <?php endforeach ?>

        <!-- Bouton suivant -->
        <?php if ($pager->hasNext()) : ?>
            <li class="page-item">
                <a class="page-link rounded-end-pill px-3"
                   href="<?= $pager->getNextPage() ?>">
                    &raquo;
                </a>
            </li>
        <?php else : ?>
            <li class="page-item disabled">
                <span class="page-link rounded-end-pill px-3">&raquo;</span>
            </li>
        <?php endif ?>

    </ul>
</nav>

<style>
.pagination .page-link {
    color: #0d6efd;
    border: none;
    margin: 0 4px;
    border-radius: 12px;
    transition: 0.2s;
    box-shadow: 0 2px 6px rgba(0,0,0,0.08);
}

.pagination .page-link:hover {
    background-color: #0d6efd;
    color: white;
    transform: translateY(-2px);
}

.pagination .active .page-link {
    background-color: #0d6efd;
    color: white;
    border: none;
}

.pagination .disabled .page-link {
    opacity: 0.5;
    box-shadow: none;
}
</style>
