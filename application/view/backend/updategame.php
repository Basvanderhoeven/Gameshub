<form method='POST' enctype='multipart/form-data'>
    <table>
        <th colspan="2">Update game</th>
        <tr>
            <td>Naam</td>
            <td><input type='text' name='update_name' value="<?php echo $game['name'] ?>" required></td>
        </tr>
        <tr>
            <td>Platform</td>
            <td><select name='update_platform' required>
                    <option value="PS4" <?php if($game['platform'] == 'ps4') echo "selected"; ?>>PS4</option>
                    <option value="PC" <?php if($game['platform'] == 'pc') echo "selected"; ?>>PC</option>
                    <option value="XBOX" <?php if($game['platform'] == 'xbox') echo "selected"; ?>>XBOX</option>
                    <option value="WII U" <?php if($game['platform'] == 'wii u') echo "selected"; ?>>WII U</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Prijs</td>
            <td><input type='text' name='update_price' value="<?php echo $game['price'] ?>" required></td>
        </tr>
        <tr>
            <td>Afbeelding</td>
            <td><input type='file' name='update_img'></td>
            <td style='font-size:11px; color:red;'>Dit veld is niet verplicht, indien u deze leeg laat word de afbeelding niet gewijzigd</td>
        </tr>
        <tr>
            <td>Videolink</td>
            <td><input type='text' name='update_vid' value="<?php echo $game['video'] ?>" required></td>
        </tr>
        <tr>
            <td>Beschrijving</td>
            <td><textarea name="update_descr"  required><?php echo $game['description'] ?></textarea></td>
        </tr>
        <tr>
            <td>Datum van uitgave</td>
            <td><input type='date' name='update_release' value="<?php echo $game['release_date'] ?>" required></td>
        </tr>
        <tr>
            <td>Genre</td>
            <td><select name='update_genre'>
                    <option value="FPS" <?php if($game['genre'] == 'FPS') echo "selected"; ?>>FPS</option>
                    <option value="Open world" <?php if($game['genre'] == 'Open world') echo "selected"; ?>>Open world</option>
                    <option value="RTS" <?php if($game['genre'] == 'RTS') echo "selected"; ?>>RTS</option>
                    <option value="Sport" <?php if($game['genre'] == 'Sport') echo "selected"; ?>>Sport</option>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td><input type='submit' name='update_submit'></td>
        </tr>
    </table>
</form>