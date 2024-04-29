<div class="join mt-8 flex justify-end">
    <?php if ($data['page'] > 1): ?>
        <a class="join-item btn" href="?page=<?= ($data['page'] - 1) . '&' . $data['query'] ?>">« Sebelumnya</a>
    <?php else: ?>
        <span class="join-item btn btn-disabled hover:cursor-not-allowed">« Sebelumnya</span>
    <?php endif; ?>

    <a class="join-item btn" href="?page=<?= ($data['page'] + 1) . '&' . $data['query'] ?>">Selanjutnya »</a>
</div>