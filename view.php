<h2>Liste des utilisateurs</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user['id']); ?></td>
                <td><?= htmlspecialchars($user['email']); ?></td>
                <td><?= htmlspecialchars($user['nom']); ?></td>
                <td><?= htmlspecialchars($user['prenom']); ?></td>
                <td>
                    <a href="?action=edit&id=<?= $user['id']; ?>">Modifier</a> |
                    <a href="?action=delete&id=<?= $user['id']; ?>" onclick="return confirm('Êtes-vous sûr ?');">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
