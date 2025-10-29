<?php
class Excursion {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function add($name, $excursion_date, $route, $audio_guide, $language, $email) {
        $stmt = $this->pdo->prepare(
            "INSERT INTO excursions (name, excursion_date, route, audio_guide, language, email) VALUES (?, ?, ?, ?, ?, ?)"
        );
        $stmt->execute([$name, $excursion_date, $route, $audio_guide, $language, $email]);
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM excursions ORDER BY excursion_date DESC");
        return $stmt->fetchAll();
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM excursions WHERE id=?");
        $stmt->execute([$id]);
    }
}
?>