<div class='backend_login_background'>
    <div>
        <h2>Vul uw gegevens in.</h2>
        <form class='backend_login_form' method='post'>
            <div>Gebruikersnaam</div>
                <div class='backend_login_username'><input type='text' name='backend_username' required></div>
            <div>Wachtwoord</div>
            <div class='backend_login_password'><input type='password' name='backend_password' required></div>
            <input type='submit' name='backend_login_submit' value='Log in'>
        </form>
    </div>
    <div><a><?php if(isset($melding)){echo $melding;}?></a></div>
   
</div>