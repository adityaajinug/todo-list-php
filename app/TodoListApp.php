<?php 

namespace App;
require_once __DIR__ . '/../Database/DatabaseConnection.php';
use Database\DatabaseConnection;
use PDO;
use PDOException;

class TodoListApp
{
    private PDO $conn;
    public function __construct()
    {
        $databaseConnection = new DatabaseConnection();
        $this->conn = $databaseConnection->getConnection();
    }

    public function index()
    {
        try {
            $statement = $this->conn->query('SELECT * FROM todos');
            return $statement->fetchAll(PDO::FETCH_ASSOC);

        } catch(PDOException $error) {
            echo "Failed get data: " . $error->getMessage();
        }
    }

    public function create()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }

    public function getStatus($status)
    {
        return $status == 1 ? 'Sudah' : 'Belum';
    }

    public function getStatusClass($status)
    {
        return $status == 1 ? 'bg-success text-white' : 'bg-warning text-black';
    }

    public function updateStatus($id)
    {
        try {
            $statement = $this->conn->prepare('SELECT status FROM todos WHERE id = :id');
            $statement->execute(['id' => $id]);
            $currentStatus = $statement->fetchColumn();

            $newStatus = ($currentStatus == 1) ? 0 : 1;

            $update = $this->conn->prepare('UPDATE todos SET status = :status WHERE id = :id');
            $update->execute([
                'status' => $newStatus,
                'id' => $id
            ]);

        return $newStatus;


        } catch(PDOException $error) {
            echo "Failed update data: " . $error->getMessage();
        }
       
    }
}