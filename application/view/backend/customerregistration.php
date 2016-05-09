<div>
    <div class="customerregistrationform">
        <form method="post">
            <div><input type="text" name="firstname" placeholder="Voornaam" required></div>
        <div><input type="text" name="infix" placeholder="Tussenvoegsel" required></div>
        <div><input type="text" name="surname" placeholder="Achternaam" required></div>
        <div><input type="text" name="phonenumber" placeholder="Telefoonnummer" required></div>
        <div><input type="email" name="email" placeholder="Email" required></div>
        <div><input type="text" name="password" placeholder="Wachtwoord" required></div>
        <div><input type="submit" name="registrate" value="Registreer klant"></div>
        </form>
            <div>
        <p><?php if(isset($message)){ echo $message;} ?></p>
    </div>
    </div>

</div>
