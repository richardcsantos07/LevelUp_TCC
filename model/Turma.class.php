<?PHP

class Turma {
    private $id;
    private $turma;
    private $id_inst;
    private $pdo;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getTurma()
    {
        return $this->turma;
    }
    public function setTurma($turma)
    {
        $this->turma = $turma;
    }
    public function getId_inst()
    {
        return $this->id_inst;
    }
    public function setId_inst($id_inst)
    {
        $this->id_inst = $id_inst;
    }
    public function getPdo()
    {
        return $this->pdo;
    }
    

    function __construct()
    {
        $dns = "mysql:dbname=leveluptest;host=localhost";
        $dbUser = "root";
        $dbPass = "";

        try {
            $this->pdo = new PDO($dns, $dbUser, $dbPass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return true;
        } catch (\Throwable $th) {
            echo "Erro de conexão: " . $th->getMessage();
            return false;
        }
    }

    public function inserirTurma($turma, $id_inst)
    {
        $sql = "INSERT INTO turma (turma, id_inst) VALUES (:t, :ii)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':t', $turma);
        $stmt->bindValue(':ii', $id_inst);
        $stmt->execute();
    }
    public function listarTurmas($id_inst)
    {
        $sql = "SELECT * FROM turma WHERE id_inst = :ii";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':ii', $id_inst);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }

    public function chkTurma($turma, $id_inst){
        $sql = "SELECT * FROM turma WHERE turma = :t AND id_inst = :ii";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':i', $turma);
        $stmt->bindValue(':ii', $id_inst);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $info = $stmt->fetch(PDO::FETCH_ASSOC);
            return $info;
        } else {
            $info = array();
            return $info;
        }
    }
}