<?php 
    //include de database
    include('connect.php');
    $con = new Database("localhost","schelden","root","");
    $db = $con->getConnection();

    //class voor de scheldword check
    class curse{
        //varibles
        public $str;
        private $conn;
        public function __construct($db){
            $this->conn = $db;
        }

        //Level 1 cencord alle active scheldwoorden die in de DataBase zitten
        public function levelOne(){
            $test = $this->conn->query("SELECT * FROM scheldwoord WHERE active = 1");
            $message = $this->str = $_POST['sentice'];

            //Dit replaced alle slechte woorden met de goede woorden maakt niet uit dat het hoofdletters heeft of niet.
            while($row=$test->fetch()){
                $badword = $row["badword"];
                $goodword = $row["goodword"];
                $message = str_ireplace($badword, $goodword ,$message);
            }
            echo $message."<br/>";
        }

        //Level 2 cencord alle woorden met level 2 en active scheldwoorden die in de DataBase zitten
        public function levelTwo(){
            $test = $this->conn->query("SELECT * FROM scheldwoord WHERE level = 1 AND active = 1");
            $message = $this->str = $_POST['sentice'];
            while($row=$test->fetch()){
                $badword = $row["badword"];
                $goodword = $row["goodword"];

                $message = str_ireplace($badword, $goodword ,$message);
            }
            echo $message."<br/>";
        }

        //Level 3 heeft geen cencor het is letterlijk een echo
        public function levelThree(){
            $this->str = $_POST['sentice'];
            echo $this->str;
        }
    }
    
    //Dit zet de class in een var
    $t = new curse($db);

    //Pakt het level en activeert de juiste functie
    $level = $_POST['level'];
    if($level == '1'){
        $t->levelOne();
    } elseif ($level == '2') {
        $t->levelTwo();
    } else{
        $t->levelThree();
    }
?>
