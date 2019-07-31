<?php

include_once 'connection.php';

class Manager {
    
    private $conn;
    
    public function __construct()
    {
        $database = new Connection();
        $this->conn = $database->openConnection();
    
    }
    
    /**
     * Login check
     *
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function loginCheck($email, $password) {
        $sql = "SELECT * FROM users WHERE email=? AND password=? ";
        
        $query = $this->conn->prepare($sql);
        $query->execute(array($email, crypt ( $password, 'init')));
        $row = $query->rowCount();
        
        return $row > 0;
    }
    
    /**
     * Add notice
     *
     * @param string $title
     * @param string $notice
     * @return bool
     */
    public function addNotice($title, $notice) {
        $statement = $this->conn->prepare('INSERT INTO notices (title, description) VALUES (:title, :description)');
        
        return $statement->execute([
            'title' => $title,
            'description' => htmlspecialchars($notice),
        ]);
    }
    
    /**
     * @return array
     */
    public function getNotices() {
        $sql = "SELECT * FROM notices order by id DESC";
    
        $query = $this->conn->prepare($sql);
        $query->execute();
    
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($result as &$r) {
            $r['description'] = htmlspecialchars_decode($r['description']);
        }
        
        return $result;
    }
}
