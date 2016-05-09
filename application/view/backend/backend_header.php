<html>
    <head>
    <link href="<?php echo URL;?>css/backend.css" rel="stylesheet"/>
    </head>
    <body>
        <div class='backend_menu_background shadow'>
            <div class='backend_menu'>
                <?php if(isset($_SESSION['backend_login'])){
                    
                echo "
                <div class='backend_menu_item'><a href='".URL."backend/customerregistration'>Klant registreren</a></div>
                <div class='backend_menu_item'><a href='".URL."backend/stock'>Voorraad bekijken</a></div>
                <div class='backend_menu_item'><a href='".URL."backend/barcode'>Barcode scannen</a></div>
                <div class='backend_menu_item_right'><a href='".URL."backend/logout'><img src='".URL."img/logout.png'></a></div>
            ";
                if($_SESSION['backend_login'] == 2){
                        echo "
                <div class='backend_menu_item'><a href='".URL."backend/management'>Beheer overzicht</a></div>";
                    }
                        }else{?>
                <div class='backend_menu_item'><a href='#'></a></div>
                        <?php } ?>
                </div>
            <a></a>
        </div>
        <div class='backend_center shadow'>