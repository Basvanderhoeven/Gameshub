<?php
class Backend extends Controller
{
    function safeRedirect($url, $statusCode = 303)
    {
       header('Location: '.URL. $url, true, $statusCode);
       die();
    }
        
    public function index()
    {
        session_start();
        
        if(isset($_POST['backend_login_submit'])){
            $coworker = $this->coworker->getCoworker($_POST['backend_username'], $_POST['backend_password']);
            if(!empty($coworker)){
                $_SESSION['backend_login'] = 1;
                $_SESSION['backend_user'] = $_POST['backend_username'];
            }
            else{
                $melding = 'De ingevoerde gegevens komen niet overeen met onze database.';
            }
            $admin = $this->coworker->getAdmin($_POST['backend_username'], $_POST['backend_password']);
            if(!empty($admin)){
                $_SESSION['backend_login'] = 2;
                $_SESSION['backend_user'] = $_POST['backend_username'];
            }
            else{
                $melding = 'De ingevoerde gegevens komen niet overeen met onze database.';
            }
        }
        if(isset($_SESSION['backend_login'])){
            $this->safeRedirect('backend/barcode');
        }
        
        require APP . 'view/backend/backend_header.php';
        require APP . 'view/backend/index.php';
        
    }
    public function stock(){
        session_start();
        $games = $this->game->getAllGames();
        
        require APP . 'view/backend/backend_header.php';
        require APP . 'view/backend/stock.php';
        
    }
    public function customerregistration(){
        session_start();
        if(isset($_POST['registrate'])){
            $email = $this->customer->checkEmail($_POST['email']);
            if(!$email){
            $registration = $this->customer->insertCustomer($_POST['firstname'],$_POST['infix'],$_POST['surname'],$_POST['phonenumber'],$_POST['email'],$_POST['password']);
            $message = 'Klant succesvol geregistreerd.';
            } else{
                $message = 'Het ingevulde email adres is al in gebruik.';
            }
            
        }
        require APP . 'view/backend/backend_header.php';
        require APP . 'view/backend/customerregistration.php';
    }
    public function barcode(){
        session_start();
        if(isset($_POST['barcode_submit'])){
            $order_information = $this->order->getOrderByBarcode($_POST['barcode_input']);
        }
        if(isset($_POST['barcode_stock_submit'])){
        foreach($_POST['barcode_delivered'] as $gameid){
        $this->stock->lowerFysical($_POST['barcode_location'], $_POST['barcode_amount'], $gameid);
        $_SESSION['message'] = "Voorraad succesvol bijgewerkt";
        $this->safeRedirect('backend/barcode');
        }
        }
        require APP . 'view/backend/backend_header.php';
        if(isset($_SESSION['backend_login'])){
        require APP . 'view/backend/barcode.php';
        } else{
            $this->safeRedirect('backend');
        }
    }
    public function logout(){
        session_start();
        require APP . 'view/backend/backend_header.php';
        session_destroy();
        $this->safeRedirect('backend');
    }
    public function management(){
        session_start();
        if(isset($_SESSION['backend_login'])){
            if($_SESSION['backend_login'] == 2){
                $games = $this->game->getAllGames();
            require APP . 'view/backend/backend_header.php';
            require APP . 'view/backend/management.php';
            }
        } else{
            $this->safeRedirect('backend');
        }
    }
    public function addgame(){
        session_start();
        if(isset($_SESSION['backend_login'])){
            if($_SESSION['backend_login'] == 2){
            require APP . 'view/backend/backend_header.php';
            require APP . 'view/backend/addgame.php';
            if(isset($_POST['add_submit'])){
                $filename = trim($_POST['add_name']," ");
                $filename .= ".png";
                $location = $_SERVER['DOCUMENT_ROOT'].'/public/img/games/'.$filename;
                move_uploaded_file( $_FILES['add_img']['tmp_name'], $location );
                $this->game->addGame($_POST['add_name'],$_POST['add_platform'], $_POST['add_price'], $filename, $_POST['add_vid'], $_POST['add_descr'], $_POST['add_release'], $_POST['add_genre']);
            }
            }
        } else{
            $this->safeRedirect('backend');
        }
    }
    public function updategame(){
        session_start();
        if(isset($_SESSION['backend_login'])){
            if($_SESSION['backend_login'] == 2){
                if(isset($_GET['id'])){
                    $game = $this->game->getGameById($_GET['id']);
                    if(isset($_POST['update_submit'])){
                        if(!empty($_FILES['update_img']['name'])){
                        $filename = trim($_POST['update_name']," ");
                        $filename .= ".png";
                        $location = $_SERVER['DOCUMENT_ROOT'].'/public/img/games/'.$filename;
                        move_uploaded_file( $_FILES['update_img']['tmp_name'], $location );
                        $this->game->updateGame(
                                $_GET['id'], 
                                $_POST['update_name'], 
                                $_POST['update_platform'], 
                                $_POST['update_price'],  
                                $_POST['update_vid'], 
                                $_POST['update_descr'], 
                                $_POST['update_release'], 
                                $_POST['update_genre'],
                                $filename);
                        } else{
                        $this->game->updateGame(
                                $_GET['id'], 
                                $_POST['update_name'], 
                                $_POST['update_platform'], 
                                $_POST['update_price'],  
                                $_POST['update_vid'], 
                                $_POST['update_descr'], 
                                $_POST['update_release'], 
                                $_POST['update_genre'], false);
                        
                        }
                        $_SESSION['message'] = 'Game succesvol gewijzigd';
                        $this->safeRedirect('backend/management');
                    }
                }
            require APP . 'view/backend/backend_header.php';
            require APP . 'view/backend/updategame.php';
            
            }
        } else{
            $this->safeRedirect('backend');
        }
    }
    public function deletegame(){
        session_start();
        if(isset($_SESSION['backend_login'])){
            if($_SESSION['backend_login'] == 2){
                if(isset($_GET['id'])){
                   $game = $this->game->getGameById($_GET['id']);
                   require APP . 'view/backend/backend_header.php';
                   require APP . 'view/backend/deletegame.php';
                   if(isset($_POST['delete_yes'])){
                       $this->game->deleteGame($_GET['id']);
                       $_SESSION['message'] = 'Game '.$_GET['id'].' succesvol verwijdert';
                       $this->safeRedirect('backend/management');
                   }
                   if(isset($_POST['delete_no'])){
                      $this->safeRedirect('backend/management'); 
                   }
                } else{
                   $this->safeRedirect('backend/management'); 
                }
            
            }
        } else{
            $this->safeRedirect('backend');
        }
    }
    public function allgames(){
        session_start();
        if(isset($_SESSION['backend_login'])){
            if($_SESSION['backend_login'] == 2){
            require APP . 'view/backend/backend_header.php';
            require APP . 'view/backend/addgame.php';
            }
        } else{
            $this->safeRedirect('backend');
        }
    }
}
