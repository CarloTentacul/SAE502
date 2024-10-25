<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques des Tickets</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-4">
        <h1 class="text-center mb-4">Statistiques des Tickets</h1>
        
        <!-- Button for Dashboard -->
        <div class="d-flex justify-content-end mb-4">
            <a href="/admin/dashboard" class="btn btn-primary">Dashboard</a>
        </div>

        <!-- Row for Charts -->
        <div class="row">
            <!-- Répartition des tickets par statut -->
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center">Répartition des tickets par statut</h2>
                        <canvas id="statusChart"></canvas>
                    </div>
                </div>
            </div>
            
            <!-- Évolution des tickets créés par mois -->
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center">Évolution des tickets créés par mois</h2>
                        <canvas id="timeChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Données envoyées depuis le contrôleur
        const stats = <?php echo json_encode($users); ?>;

        // Extraire les données pour chaque graphique
        const statusData = {
            'Ouvert': 0,
            'En cours': 0,
            'Fermé': 0
        };
        const userData = {};
        const monthlyData = {};

        stats.forEach(ticket => {
            // Répartition par statut
            statusData[ticket.status]++;

            // Nombre de tickets par utilisateur
            const user = ticket.assigned_to;
            if (!userData[user]) {
                userData[user] = 0;
            }
            userData[user]++;

            // Évolution des tickets par mois
            const createdAt = new Date(ticket.created_at);
            const monthYear = `${createdAt.getFullYear()}-${('0' + (createdAt.getMonth() + 1)).slice(-2)}`;
            if (!monthlyData[monthYear]) {
                monthlyData[monthYear] = 0;
            }
            monthlyData[monthYear]++;
        });

        // 1. Diagramme circulaire : répartition par statut
        const statusChartCtx = document.getElementById('statusChart').getContext('2d');
        new Chart(statusChartCtx, {
            type: 'pie',
            data: {
                labels: Object.keys(statusData),
                datasets: [{
                    data: Object.values(statusData),
                    backgroundColor: ['#36a2eb', '#ffcd56', '#ff6384'],
                }]
            },
        });

        const timeChartCtx = document.getElementById('timeChart').getContext('2d');
        new Chart(timeChartCtx, {
            type: 'line',
            data: {
                labels: Object.keys(monthlyData).sort(),
                datasets: [{
                    label: 'Tickets créés par mois',
                    data: Object.values(monthlyData),
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    fill: true
                }]
            },
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
