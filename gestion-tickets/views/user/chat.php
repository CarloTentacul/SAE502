<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket : <?= htmlspecialchars($ticket['title']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .chat-box {
            max-height: 400px;
            overflow-y: auto;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            background-color: #f8f9fa;
            padding: 1rem;
            margin-bottom: 1rem;
        }
        .chat-message {
            margin-bottom: 1rem;
        }
        .chat-message strong {
            display: block;
            color: #007bff;
        }
        .chat-message small {
            display: block;
            color: #6c757d;
        }
        .chat-input {
            display: flex;
            gap: 10px;
        }
        .chat-input textarea {
            flex: 1;
            resize: none;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <br>
    <h1 class="mb-4 text-primary">Ticket : <?= htmlspecialchars($ticket['title']); ?></h1>
    <div class="d-flex justify-content-end mb-3">
        <a href="/user/dashboard" class="btn btn-secondary me-2">Dashboard</a>
        <a href="/user/tickets" class="btn btn-secondary">Tickets</a>
    </div>

    <div class="chat-box mb-4" id="chat-box">
        <!-- Messages affichés ici -->
    </div>

    <!-- Formulaire d'envoi de message -->
    <form id="chat-form" class="chat-input">
        <input type="hidden" name="ticket_id" value="<?= htmlspecialchars($ticket['id']); ?>">
        <textarea id="message" class="form-control" rows="3" placeholder="Écrire un message..."></textarea>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function fetchMessages() {
        $.ajax({
            url: '/fetch_messages.php?ticket_id=<?= $ticket['id']; ?>',
            method: 'GET',
            success: function (data) {
                $('#chat-box').html(data);
                // Scroll to the bottom of the chat
                $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
            }
        });
    }

    // Auto-refresh messages every 5 seconds
    setInterval(fetchMessages, 5000);
    
    // Handle message submission
    $('#chat-form').on('submit', function (e) {
        e.preventDefault();
        var message = $('#message').val();

        if (message.trim() !== '') {
            $.ajax({
                url: '/send_message.php',
                method: 'POST',
                data: {
                    ticket_id: <?= $ticket['id']; ?>,
                    message: message
                },
                dataType: 'json',  // On s'attend à recevoir une réponse JSON
                success: function (response) {
                    if (response.status === 'success') {
                        $('#message').val('');  // Clear the input
                        fetchMessages();  // Refresh messages
                    } else {
                        alert(response.message);  // Afficher le message d'erreur
                    }
                },
                error: function () {
                    alert('Erreur lors de l\'envoi du message.');
                }
            });
        } else {
            alert('Veuillez écrire un message.');
        }
    });

    // Initial fetch of messages
    fetchMessages();
</script>

</body>
</html>
