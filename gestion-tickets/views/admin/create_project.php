<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un projet</title>
    <!-- Lien vers le CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4 text-primary">Créer un projet</h1>

    <form method="POST" action="/admin/projects/create" class="bg-light p-4 rounded shadow-sm">
        <div class="mb-3">
            <label for="name" class="form-label">Nom du projet:</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Entrez le nom du projet" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea name="description" class="form-control" id="description" rows="4" placeholder="Entrez une description"></textarea>
        </div>

        <div class="mb-3">
            <label for="client_id" class="form-label">Client:</label>
            <select name="client_id" class="form-select" id="client_id" required>
                <option value="" disabled selected>Choisissez un client</option>
                <?php foreach ($clients as $client): ?>
                    <option value="<?php echo $client['id']; ?>"><?php echo $client['entreprise']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Créer le projet</button>
        </div>
    </form>

    <div class="mt-3">
        <a href="/admin/projects" class="btn btn-link">Retour à la liste des projets</a>
    </div>
</div>

<!-- Lien vers le JS de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
