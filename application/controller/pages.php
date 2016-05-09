<?php
class Pages extends Controller
{
    function redirect($url, $statusCode = 303)
    {
       header('Location: '.URL. $url, true, $statusCode);
       die();
    }
    public function wiiu()
    {
        session_start();
        // load views
        $games = $this->game->getWIIUGames();
        require APP . 'view/_templates/winkelmand.php';
        require APP . 'view/_templates/header.php';
        require APP . 'view/pages/wiiu.php';
        require APP . 'view/_templates/footer.php';
    }
    public function ps4()
    {
        session_start();
        // load views
        $games = $this->game->getPS4Games();
        require APP . 'view/_templates/winkelmand.php';
        require APP . 'view/_templates/header.php';
        require APP . 'view/pages/ps4.php';
        require APP . 'view/_templates/footer.php';
    }
    public function xbox()
    {
        session_start();
        // load views
        $games = $this->game->getXBOXGames();
        require APP . 'view/_templates/winkelmand.php';
        require APP . 'view/_templates/header.php';
        require APP . 'view/pages/xbox.php';
        require APP . 'view/_templates/footer.php';
    }
    public function pc()
    {
        session_start();
        // load views
        $games = $this->game->getPcGames();
        require APP . 'view/_templates/winkelmand.php';
        require APP . 'view/_templates/header.php';
        require APP . 'view/pages/pc.php';
        require APP . 'view/_templates/footer.php';
    }
    public function game(){
        session_start();
        // load views
        if(isset($_GET['id'])){
            $game = $this->game->getGameById($_GET['id']);
        } else{
            $alert = 'Er is geen game geselecteerd.'; 
        }
        require APP . 'view/_templates/winkelmand.php';
        require APP . 'view/_templates/header.php';
        require APP . 'view/pages/game.php';
        require APP . 'view/_templates/footer.php';
    }
    public function contact(){
        session_start();
        require APP . 'view/_templates/winkelmand.php';
        require APP . 'view/_templates/header.php';
        require APP . 'view/pages/contact.php';
        require APP . 'view/_templates/footer.php';
    }
    public function order(){
        session_start();
        require APP . 'view/_templates/winkelmand.php';
        require APP . 'view/_templates/header.php';
        require APP . 'view/pages/order.php';
        require APP . 'view/_templates/footer.php';
    }
    public function login(){
        session_start();
        if(isset($_POST['login_submit'])){
            $checklogin = $this->customer->checkLogin($_POST['email'], $_POST['password']);
            if(!empty($checklogin)){
                $customer = $this->customer->getCustomerByEmail($_POST['email']);
                $_SESSION['customer_id'] = $customer['id'];
                $_SESSION['customer_login'] = true;
                
                $this->redirect('pages/mijnbestellingen');
            } else{
                $message = "De ingevulde gegevens zijn niet juist, probeer het opnieuw";
            }
        }
        require APP . 'view/_templates/winkelmand.php';
        require APP . 'view/_templates/header.php';
        require APP . 'view/pages/login.php';
        require APP . 'view/_templates/footer.php';
    }
    public function logout(){
        session_start();
        $_SESSION['customer_login'] = false;
        $this->redirect('pages/login');
    }
    public function mijnbestellingen(){
        session_start();
        if(isset($_SESSION['customer_login'])){
        if($_SESSION['customer_login']){
            $orders = $this->order->getOrdersByCustomerId($_SESSION['customer_id']);
        } else{
            $this->redirect('pages/login');
        }
        } else{
            $this->redirect('pages/login');
        }
        require APP . 'view/_templates/winkelmand.php';
        require APP . 'view/_templates/header.php';
        require APP . 'view/pages/mijnbestellingen.php';
    }
}
