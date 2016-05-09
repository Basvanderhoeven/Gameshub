<form method='POST' enctype='multipart/form-data'>
    <table>
        <th colspan="2">Game toevoegen</th>
        <tr>
            <td>Naam</td>
            <td><input type='text' name='add_name' required></td>
        </tr>
        <tr>
            <td>Platform</td>
            <td><select name='add_platform' required>
                    <option value="PS4">PS4</option>
                    <option value="PC">PC</option>
                    <option value="XBOX">XBOX</option>
                    <option value="WII U">WII U</option>
                </select></td>
        </tr>
        <tr>
            <td>Prijs</td>
            <td><input type='text' name='add_price' required></td>
        </tr>
        <tr>
            <td>Afbeelding</td>
            <td><input type='file' name='add_img' required></td>
        </tr>
        <tr>
            <td>Videolink</td>
            <td><input type='text' name='add_vid' required></td>
        </tr>
        <tr>
            <td>Beschrijving</td>
            <td><textarea name="add_descr" required></textarea></td>
        </tr>
        <tr>
            <td>Datum van uitgave</td>
            <td><input type='date' name='add_release' required></td>
        </tr>
        <tr>
            <td>Genre</td>
            <td><select name='add_genre'>
                    <option value="FPS">FPS</option>
                    <option value="Open world">Open world</option>
                    <option value="RTS">RTS</option>
                    <option value="Sport">Sport</option>
                </select></td>
        </tr>
        <tr>
            <td></td>
            <td><input type='submit' name='add_submit'></td>
        </tr>
    </table>
</form>

