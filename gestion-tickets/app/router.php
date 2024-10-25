<?php
session_start();
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Fonction pour extraire l'ID d'une URL avec un motif donné
function getIdFromUri($pattern, $uri) {
    if (preg_match($pattern, $uri, $matches)) {
        return $matches[1];
    }
    return null;
}

// Route pour la page de connexion
if ($uri === '/' || $uri === '/login') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        require '../views/login.php';
    } else {
        require '../controllers/AuthController.php';
        $controller = new AuthController();
        $controller->login();
    }
}
// Route pour l'inscription
elseif ($uri === '/register') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        require '../views/register.php';
    } else {
        require '../controllers/AuthController.php';
        $controller = new AuthController();
        $controller->register();
    }
}
// Routes pour la déconnexion
elseif ($uri === '/admin/logout') {
    require '../controllers/AuthController.php';
    $controller = new AuthController();
    $controller->logout();
}

elseif ($uri === '/user/logout') {
    require '../controllers/AuthController.php';
    $controller = new AuthController();
    $controller->logout();
}
// Routes pour les projets (admin)
elseif (strpos($uri, '/admin/projects') === 0) {
    require '../controllers/ProjectController.php';
    $controller = new ProjectController();
    if ($uri === '/admin/projects') {
        $controller->index();
    } elseif ($uri === '/admin/projects/create') {
        $controller->create();
    } elseif ($id = getIdFromUri('/^\/admin\/projects\/edit\/(\d+)$/', $uri)) {
        $controller->edit($id);
    } elseif ($id = getIdFromUri('/^\/admin\/projects\/delete\/(\d+)$/', $uri)) {
        $controller->delete($id);
    }
}
// Routes pour les clients (admin)
elseif (strpos($uri, '/admin/clients') === 0) {
    require '../controllers/ClientController.php';
    $controller = new ClientController();
    if ($uri === '/admin/clients') {
        $controller->index();
    } elseif ($uri === '/admin/clients/create') {
        $controller->create();
    } elseif ($id = getIdFromUri('/^\/admin\/clients\/edit\/(\d+)$/', $uri)) {
        $controller->edit($id);
    } elseif ($id = getIdFromUri('/^\/admin\/clients\/delete\/(\d+)$/', $uri)) {
        $controller->delete($id);
    }
}
// Routes pour les tickets (admin)
elseif (strpos($uri, '/admin/tickets') === 0) {
    require '../controllers/TicketController.php';
    $controller = new TicketController();
    if ($uri === '/admin/tickets') {
        $controller->index();
    } elseif ($uri === '/admin/tickets/create') {
        $controller->create();
    } elseif ($id = getIdFromUri('/^\/admin\/tickets\/view\/(\d+)$/', $uri)) {
        $controller->view($id);
    } elseif ($id = getIdFromUri('/^\/admin\/tickets\/edit\/(\d+)$/', $uri)) {
        $controller->edit($id);
    } elseif ($id = getIdFromUri('/^\/admin\/tickets\/delete\/(\d+)$/', $uri)) {
        $controller->delete($id);
    }
}
// Routes pour les utilisateurs (admin)
elseif (strpos($uri, '/admin/users') === 0) {
    require '../controllers/UserController.php';
    $controller = new UserController();
    if ($uri === '/admin/users') {
        $controller->index();
    } elseif ($uri === '/admin/users/create') {
        $controller->create();
    } elseif ($id = getIdFromUri('/^\/admin\/users\/edit\/(\d+)$/', $uri)) {
        $controller->edit($id);
    } elseif ($id = getIdFromUri('/^\/admin\/users\/delete\/(\d+)$/', $uri)) {
        $controller->delete($id);
    }
}

// Route pour les statistiques
elseif (strpos($uri, '/admin/stats') === 0) {
    require '../controllers/StatsController.php';
    $controller = new StatsController();
    if ($uri === '/admin/stats') {
        $controller->index();
    }
}

// Routes pour l'admin dashboard
elseif ($uri === '/admin/dashboard') {
    // Vérifier si l'utilisateur est un développeur
    if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'Développeur') {
        $_SESSION['redirect_to'] = $uri;
        header('Location: /login');
        exit();
    }
    require '../views/admin/dashboard.php';
}
// Routes pour les tickets (utilisateur)
elseif (strpos($uri, '/user/tickets') === 0) {
    require '../controllers/TicketController.php';
    $controller = new TicketController();
    if ($uri === '/user/tickets') {
        $controller->index();
    } elseif ($uri === '/user/tickets/create') {
        $controller->create();
    } elseif ($id = getIdFromUri('/^\/user\/tickets\/view\/(\d+)$/', $uri)) {
        $controller->view($id);
    } elseif ($id = getIdFromUri('/^\/user\/tickets\/edit\/(\d+)$/', $uri)) {
        $controller->edit($id);
    } elseif ($id = getIdFromUri('/^\/user\/tickets\/delete\/(\d+)$/', $uri)) {
        $controller->delete($id);
    }
    // Routes pour les messages liés aux tickets
    elseif ($uri === '/user/tickets/send_message' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller->sendMessage(); // Vous devrez peut-être ajuster cette méthode
    } elseif ($uri === '/user/tickets/fetch_messages' && $_SERVER['REQUEST_METHOD'] === 'GET') {
        $controller->fetchMessages(); // Vous devrez implémenter cette méthode
    }
}
// Routes pour l'utilisateur dashboard
elseif ($uri === '/user/dashboard') {
    // Vérifier si l'utilisateur est un rapporteur
    if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'Rapporteur') {
        $_SESSION['redirect_to'] = $uri;
        header('Location: /login');
        exit();
    }
    require '../views/user/dashboard.php';
}
// Route par défaut si aucune route ne correspond
else {
    header("HTTP/1.0 404 Not Found");
    echo "Page non trouvée";
}
