<?php   

class Database
{
    // Properti untuk menyimpan informasi koneksi database
    private $host = DB_HOST;
    private $user = DB_USER;
    private $password = DB_PASS;
    private $name = DB_NAME;

    // Properti untuk menyimpan objek koneksi dan objek statement PDO
    private $dbh;
    private $stmt;

    // Method constructor untuk membuat koneksi database menggunakan PDO
    public function __construct()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->name";

        $option = [
            PDO::ATTR_PERSISTENT => true, // Mengaktifkan koneksi PDO yang persisten
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // Mengatur mode error untuk exception
        ];

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->password, $option); // Membuat objek PDO
        } catch (PDOException $e) {
            die($e->getMessage()); // Menghentikan eksekusi dan menampilkan pesan error jika koneksi gagal
        }
    }

    // Method untuk menyiapkan query SQL
    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query); // Mempersiapkan statement PDO
    }

    // Method untuk mengikat parameter ke statement PDO
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT; // Mengikat parameter sebagai integer
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL; // Mengikat parameter sebagai boolean
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL; // Mengikat parameter sebagai null
                    break;
                default:
                    $type = PDO::PARAM_STR; // Mengikat parameter sebagai string
                    break;
            }
        }

        $this->stmt->bindValue($param, $value, $type); // Mengikat parameter ke statement PDO
    }

    // Method untuk mengeksekusi statement PDO
    public function execute()
    {
        $this->stmt->execute(); // Mengeksekusi statement PDO
    }

    // Method untuk mengambil semua hasil query
    public function get()
    {
        $this->execute(); // Mengeksekusi statement PDO
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC); // Mengembalikan hasil query sebagai array asosiatif
    }

    // Method untuk mengambil satu baris hasil query
    public function first()
    {
        $this->execute(); // Mengeksekusi statement PDO
        return $this->stmt->fetch(PDO::FETCH_ASSOC); // Mengembalikan satu baris hasil query sebagai array asosiatif
    }

    // Method untuk mendapatkan jumlah baris yang terpengaruh oleh operasi SQL (INSERT, UPDATE, DELETE)
    public function rowCountAffected()
    {
        return $this->stmt->rowCount(); // Mengembalikan jumlah baris yang terpengaruh
    }
}
