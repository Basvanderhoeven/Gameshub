<?php
class order extends Controller{
    function redirect($url, $statusCode = 303)
    {
       header('Location: '.URL. $url, true, $statusCode);
       die();
    }
    public function Shoppingcart(){
        session_start();
        //aanmaken van de array voor de games die in het winkelmandje liggen
        if(!isset($_SESSION['games'])){
        $_SESSION['games'] = array();
        } 
        //toevoegen van een exemplaar aan de winkelmand
        if(isset($_GET['add'])){
            $stock = $this->game->getSellableStock($_GET['add']);
            if($stock['sellable'] > $_SESSION['games'][$_GET['add']]){
            $_SESSION['games'][$_GET['add']] += 1;
            } else{
                $_SESSION['message'] = 'Er is niet nog een exemplaar van deze game beschikbaar op dit moment';
            }
            $this->redirect('order/shoppingcart');
        }
        //verwijderen van een exemplaar uit de winkelmand, en als het aantal 0 of minder is word deze verwijdert uit de winkelmand
        if(isset($_GET['lower'])){
            if(isset($_SESSION['games'][$_GET['lower']])){
            $_SESSION['games'][$_GET['lower']] -= 1;
            if($_SESSION['games'][$_GET['lower']] <= 0){
                unset($_SESSION['games'][$_GET['lower']]);
            }
            }
            $this->redirect('order/shoppingcart');
        }
        //toevoegen van de game aan de winkelmand, als deze al bestaat word er een exemplaar bij opgeteld
        if(isset($_GET['id'])){
            if(isset($_SESSION['games'][$_GET['id']])){
                $stock = $this->game->getSellableStock($_GET['id']);
                if($stock['sellable'] > $_SESSION['games'][$_GET['id']]){
                $_SESSION['games'][$_GET['id']] += 1;
                } else{
                    $_SESSION['message'] = 'Er is niet nog een exemplaar van deze game beschikbaar op dit moment';
                }
            } else{
                $_SESSION['games'][$_GET['id']] = 1;
            }
            $this->redirect('order/shoppingcart');
        }
        if(isset($_GET['empty'])){
            session_destroy();
            $this->redirect('order/shoppingcart');
        }
        //switch of er 1, of meedere games in de winkelmand liggen
        if(count($_SESSION['games']) == 1){
            reset($_SESSION['games']);
            $first_key = key($_SESSION['games']);
            $games = $this->game->getGameByIdArray($first_key);
        }
        else{
            if(isset($_SESSION['games'])){
            $games = $this->game->getGamesById($_SESSION['games']);
            }
        }
        require APP . 'view/_templates/winkelmand.php';
        require APP . 'view/_templates/header.php';
        require APP . 'view/order/shoppingcart.php';
        require APP . 'view/_templates/footer.php';
    }
    public function Step1(){
        session_start();
        //filter of de betaalknop ingedrukt is.
        if(isset($_POST['paymethod_submit'])){
            //gegevens uit de winkelmand worden in de sessie gezet, zodat deze op de volgende pagina aangeroepen kunnen worden.
            $_SESSION['order_customerid'] = $_POST['customerid'];
            $_SESSION['order_paymethod'] = $_POST['paymethod'];
            //controle het ingevulde klantid bestaat in de database
            $customer = $this->customer->checkCustomerId($_POST['customerid']);
            if($customer){
                //Als het ingevulde klantnummer bestaat, door naar stap 2
            $this->redirect('order/Step2');
            } else{
                //Als het ingevulde klantnummer niet bestaat, geef melding
                $message = 'Klantnummer bestaat niet.';
            }
        }
        require APP . 'view/_templates/winkelmand.php';
        require APP . 'view/_templates/header.php';
        
        require APP . 'view/order/Step1.php';
        require APP . 'view/_templates/footer.php';  
    }
    public function Step2(){
        session_start();
        $customer_validation = false;
        //Klant word opgehaald dmv klantid
        $customer = $this->customer->checkCustomerId($_SESSION['order_customerid']);
        //Als op de bevestiging van de klant word gedrukt word validation true
        if(isset($_POST['popup_submit'])){
            $customer_validation = true;
        }
        //Als validation true is word de order aangemaakt
        if($customer_validation == true){
            if(isset($_SESSION['games'])){
                $customerid = $_SESSION['order_customerid'];
                    $order = $this->order->insertOrder($_SESSION['order_customerid'], $_SESSION['order_paymethod']);
                foreach($_SESSION['games'] as $key => $item){
                    
                   $gameid = $key;
                   $amount = $item;
                   $game = $this->game->getGameById($gameid);
                   $this->game->reduceStock($gameid, $amount);
                   if(date('Y-m-d') > $game['release_date']){
                   $this->order->insertOrderRow($gameid, $amount, $order['id'], 0);
                   } else{
                   $this->order->insertOrderRow($gameid, $amount, $order['id'], 1);    
                   }
                }
                session_destroy();
                session_start();
                $_SESSION['order_customerid'] = $customerid;
                $_SESSION['order_id'] = $order['id'];
                $this->redirect('order/Step3');
                
            }
        }
        require APP . 'view/_templates/winkelmand.php';
        require APP . 'view/_templates/header.php';
        require APP . 'view/order/Step2.php';
        require APP . 'view/_templates/footer.php';  
    }
    public function Step3(){
        session_start();
        require APP . 'view/_templates/winkelmand.php';
        require APP . 'view/_templates/header.php';
        require APP . 'view/order/Step3.php';
        require APP . 'view/_templates/footer.php';
        if(isset($_SESSION['order_id'])){
        $this->redirect('order/pdfgenerator?orderid='.$_SESSION['order_id']);
        }
    }
    public function Pdfgenerator(){
        session_start();
        require APP . 'view/_templates/winkelmand.php';
        require APP . 'view/_templates/header.php';
        require APP . 'view/order/pdfgenerator.php';
        require APP . 'view/_templates/footer.php';
        if(isset($_GET['orderid'])){
        $this->redirect('order/pdfgenerator');
        }
        
    }
    public function datetest(){
        session_start();
        $game = $this->game->getGameById(9);
        if(date('Y-m-d') > $game['release_date']){
            echo "Geen preorder";
        }
    }
}
