<?php
class Home extends Controller
{
    public function index()
    {
        session_start();
        if(!isset($_SESSION['customer_login'])){
          $_SESSION['customer_login'] = false;  
        }
        $games = $this->game->getGames();
        // load views
        require APP . 'view/_templates/winkelmand.php';
        require APP . 'view/_templates/header.php';
        require APP . 'view/home/index.php';
        require APP . 'view/_templates/footer.php';
    }
}
