<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un utilisateur</title>
    <!-- Lien vers le CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4 text-primary">Créer un utilisateur</h1>

    <form method="POST" action="/admin/users/create" class="bg-light p-4 rounded shadow-sm">
        <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
            <input type="text" name="username" class="form-control" id="username" placeholder="Entrez le nom d'utilisateur" required>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Nom:</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Entrez le nom" required>
        </div>

        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom:</label>
            <input type="text" name="prenom" class="form-control" id="prenom" placeholder="Entrez le prénom" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Entrez l'email" required>
        </div>

        <div class="mb-3">
            <label for="telephone" class="form-label">Téléphone:</label>
            <input type="text" name="telephone" class="form-control" id="telephone" placeholder="Entrez le numéro de téléphone" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe:</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Entrez le mot de passe" required>
        </div>

        <div class="mb-3">
            <label for="entreprise" class="form-label">Entreprise:</label>
            <select name="entreprise" class="form-select" id="entreprise" required>
                <option value="" disabled selected>Choisissez une entreprise</option>
                <?php foreach ($clients as $client): ?>
                    <option value="<?php echo $client['id']; ?>"><?php echo $client['entreprise']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Rôle:</label>
            <select name="role" class="form-select" id="role" required>
                <option value="" disabled selected>Choisissez un rôle</option>
                <option value="Rapporteur">Rapporteur</option>
                <option value="Développeur">Développeur</option>
            </select>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Créer l'utilisateur</button>
        </div>
    </form>

    <div class="mt-3">
        <a href="/admin/users" class="btn btn-primary">Retour à la liste des utilisateurs</a>
    </div>
</div>

<!-- Lien vers le JS de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
