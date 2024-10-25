<?php

class Project
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function createProject($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO projects (name, description, client_id) VALUES (:name, :description, :client_id)");
        return $stmt->execute($data);
    }

    public function getAllProjects()
    {
        $stmt = $this->pdo->query("SELECT * FROM projects");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProjectById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM projects WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProject($id, $data)
    {
        $stmt = $this->pdo->prepare("UPDATE projects SET name = :name, description = :description, client_id = :client_id WHERE id = :id");
        return $stmt->execute(array_merge(['id' => $id], $data));
    }

    public function deleteProject($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM projects WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
