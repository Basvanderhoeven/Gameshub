<?php

class Controller
{
    public $db = null;
    public $model = null;
    public $game = null;
    public $stock = null;
    public $order = null;
    public $customer = null;
    public $coworker = null;
    function __construct()
    {
        $this->openDatabaseConnection();
        $this->loadModel();
        $this->loadGame();
        $this->loadCustomer();
        $this->loadStock();
        $this->loadOrder();
        $this->loadCoworker();
    }
    private function openDatabaseConnection()
    {
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
        $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);
    }
    public function loadModel()
    {
        require APP . 'model/model.php';
        $this->model = new Model($this->db);
    }
    public function loadGame()
    {
        require APP . 'model/game_model.php';
        $this->game = new Game_model($this->db);
    }
    public function loadStock()
    {
        require APP . 'model/stock_model.php';
        $this->stock = new Stock_model($this->db);
    }
    public function loadOrder()
    {
        require APP . 'model/order_model.php';
        $this->order = new Order_model($this->db);
    }
    public function loadCustomer()
    {
        require APP . 'model/customer_model.php';
        $this->customer = new Customer_model($this->db);
    }
    public function loadCoworker()
    {
        require APP . 'model/coworker_model.php';
        $this->coworker = new Coworker_model($this->db);
    }
}
