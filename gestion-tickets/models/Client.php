<?php

class Client
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function createClient($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO clients (entreprise, address) VALUES (:entreprise, :email)");
        return $stmt->execute($data);
    }

    public function getAllClients()
    {
        $stmt = $this->pdo->query("SELECT * FROM clients");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getClientById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM clients WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateClient($id, $data)
    {
        $stmt = $this->pdo->prepare("UPDATE clients SET entreprise = :entreprise, address = :address WHERE id = :id");
        return $stmt->execute(array_merge(['id' => $id], $data));
    }

    public function deleteClient($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM clients WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
