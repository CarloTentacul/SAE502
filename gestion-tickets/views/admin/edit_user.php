<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un utilisateur</title>
    <!-- Lien vers le CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4 text-primary">Modifier un utilisateur</h1>

    <!-- Formulaire de modification de l'utilisateur -->
    <form method="POST" action="/admin/users/edit/<?php echo $user['id']; ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Nom:</label>
            <input type="text" class="form-control" name="name" value="<?php echo $user['name']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" name="email" value="<?php echo $user['email']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Rôle:</label>
            <select name="role" class="form-select" required>
                <option value="Rapporteur" <?php if ($user['role'] === 'Rapporteur') echo 'selected'; ?>>Rapporteur</option>
                <option value="Développeur" <?php if ($user['role'] === 'Développeur') echo 'selected'; ?>>Développeur</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Mettre à jour</button>
    </form>

    <!-- Lien de retour à la liste des utilisateurs -->
    <a href="/admin/users" class="btn btn-outline-secondary mt-3">Retour à la liste des utilisateurs</a>
</div>

<!-- Lien vers le JS de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
