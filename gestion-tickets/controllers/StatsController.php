<?php
require_once '../models/Stats.php';

class StatsController
{
    private $statModel;

    public function __construct()
    {
        global $pdo;
        $this->statModel = new Stats($pdo);
    }

    // Affiche la liste de tous les utilisateurs
    public function index()
    {
        $users = $this->statModel->getStats();
        require '../views/admin/stats.php';
    }

}
