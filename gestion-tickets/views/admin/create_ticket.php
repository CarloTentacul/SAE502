<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un ticket</title>
</head>
<body>

<h1>Créer un ticket</h1>

<form method="POST" action="/tickets/create">
    <label for="title">Titre:</label>
    <input type="text" name="title" required>

    <label for="description">Description:</label>
    <textarea name="description" required></textarea>

    <label for="status">Statut:</label>
    <select name="status">
        <option value="Ouvert">Ouvert</option>
        <option value="En cours">En cours</option>
        <option value="Fermé">Fermé</option>
    </select>

    <label for="project_id">Projet:</label>
    <select name="project_id" required>
        <?php foreach ($projects as $project): ?>
            <option value="<?php echo $project['id']; ?>"><?php echo $project['name']; ?></option>
        <?php endforeach; ?>
    </select>

    <label for="assigned_to">Assigné à:</label>
    <select name="assigned_to">
        <option value="">Non assigné</option>
        <?php foreach ($users as $user): ?>
            <option value="<?php echo $user['id']; ?>"><?php echo $user['name']; ?></option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Créer le ticket</button>
</form>

<a href="/tickets">Retour à la liste des tickets</a>

</body>
</html>
