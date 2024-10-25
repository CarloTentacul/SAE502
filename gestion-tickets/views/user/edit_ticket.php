<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Ticket</title>
    <!-- Lien vers le CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .chat-box {
            border: 1px solid #ddd;
            padding: 1rem;
            border-radius: 0.375rem;
            background-color: #f8f9fa;
            margin-bottom: 1rem;
        }
        .chat-message {
            margin-bottom: 1rem;
        }
        .chat-message strong {
            display: block;
        }
        .chat-message p {
            margin: 0.5rem 0;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4 text-primary">Modifier le Ticket : <?= htmlspecialchars($ticket['title']); ?></h1>

    <!-- Formulaire de modification du ticket -->
    <form action="/user/tickets/<?= $ticket['id']; ?>" method="POST" class="bg-light p-4 rounded shadow-sm mb-4">
        <div class="mb-3">
            <label for="title" class="form-label">Titre</label>
            <input type="text" name="title" id="title" class="form-control" value="<?= htmlspecialchars($ticket['title']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4" required><?= htmlspecialchars($ticket['description']); ?></textarea>
        </div>

        <div class="mb-3">
            <label for="project_id" class="form-label">Projet</label>
            <select name="project_id" id="project_id" class="form-select" required>
                <?php foreach ($projects as $project): ?>
                    <option value="<?= $project['id']; ?>" <?= $project['id'] == $ticket['project_id'] ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($project['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="/user/tickets" class="btn btn-secondary">Retour à la liste des tickets</a>
    </form>

    <!-- Lien vers le JS de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
