<?php include __DIR__ . '/../layout/header.php'; ?>

<main class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="mb-4 text-center">Asistente IA (RAG)</h1>
            <p class="text-center text-muted">Haz una pregunta y buscaré en los artículos publicados para responderte.</p>

            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <form action="index.php?action=rag_ask" method="POST">
                        <input type="hidden" name="csrf_token" value="<?= \Utils\Csrf::getToken() ?>">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control form-control-lg" name="question" placeholder="Ej: ¿Qué es MVC?" value="<?php echo htmlspecialchars($question ?? ''); ?>" required>
                            <button class="btn btn-primary" type="submit">Preguntar</button>
                        </div>
                    </form>
                </div>
            </div>

            <?php if (!empty($answer)): ?>
                <div class="card bg-light mb-4 border-success">
                    <div class="card-header bg-success text-white">Respuesta Generada</div>
                    <div class="card-body">
                        <p class="card-text"><?php echo $answer; ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($results)): ?>
                <h4 class="mb-3">Fuentes Encontradas</h4>
                <div class="list-group">
                    <?php foreach ($results as $post): ?>
                        <a href="index.php?action=show&id=<?php echo $post['ID_POST']; ?>" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><?php echo htmlspecialchars($post['TITLE']); ?></h5>
                                <small>Relevancia: <?php echo number_format($post['score'], 2); ?></small>
                            </div>
                            <p class="mb-1 text-truncate"><?php echo strip_tags(substr($post['CONTENT'], 0, 150)); ?>...</p>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php elseif (isset($question) && !empty($question)): ?>
                <div class="alert alert-warning">No se encontraron artículos relacionados con tu búsqueda.</div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php include __DIR__ . '/../layout/footer.php'; ?>
