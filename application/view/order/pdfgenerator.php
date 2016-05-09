
<!DOCTYPE html>
<?php if(isset($_GET['orderid'])){ 
$game_row = '';
$table_rows = '';
$orderrows = $this->order->getAvailableRows($_GET['orderid']);
$order = $this->order->getOrderById($_GET['orderid']);
$customer = $this->customer->getCustomerByOrderID($_GET['orderid']);
$totalprice = array();
if(!empty($orderrows)){
foreach($orderrows as $row){
    $games = $this->game->getGameByIdArray($row['game_id']);
    foreach($games as $game){
    $table_rows .= '<tr>
                    <td>'.$game['name'].'</td>
                    <td>'.$game['platform'].'</td>
                    <td>&euro;'.$game['price'].'</td>
                    <td>'.$row['amount'].'</td>
                    </tr>';
    }
        $row_amount[] = $row['amount'];
        $row_price[] = $game['price'] * $row['amount'];
        
    }
    $total_price = array_sum($row_price);
    $total_amount = array_sum($row_amount);

            require_once (APP . 'libs/tcpdf/config/tcpdf_config.php');
            require_once(APP . 'libs/tcpdf/tcpdf.php');
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            // set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Gameshub');
            $pdf->SetTitle('TCPDF Example 006');
            $pdf->SetSubject('TCPDF Tutorial');
            $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

            // set default header data
            //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);
            // set header and footer fonts
            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

            // set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // set margins
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

            // set auto page breaks
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            // set image scale factor
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
                $pdf->SetFont('dejavusans', '', 10);
                $pdf->AddPage();
                $html = '<html>
                            <head>
                                
                            </head>
                            <body>
                                <div class="mail" style="font-family: Arial; font-size: 13px;">
                                    <table>
                                        <tr>
                                            <td><img style="width:150px; height:150px;" src="'.URL.'img/logo.png"></td>
                                            <td></td>
                                            <td></td>
                                            <td><table>
                                                <tr>
                                                    <td>Columbuslaan 10</td>
                                                </tr>
                                                <tr>
                                                    <td>Utrecht 1234 AB</td>
                                                </tr>
                                                <tr>
                                                    <td>Tel: 0123-456789</td>
                                                </tr>
                                            </table></td>
                                        </tr>
                                    </table>
                                    <div class="maincontent">
                                        <div class="message">
                                            <p style="font-size:25px; font-weight:bolder;">Bedankt voor uw aankoop bij Gameshub.</p>
                                            <p>Met deze order moet u naar de winkel om uw games op te halen.</p>
                                        </div>
                                        <div class="table">
                                        <table>
                                            <tr>
                                                <th rowspan="1">Naam</th>
                                                <th colspan="1">Platform</th>
                                                <th colspan="1">Prijs</th>
                                                <th colspan="1">Aantal</th>
                                            </tr>
                                                '.$table_rows.'
                        <tr>
                            <td colspan="2">Totaalprijs</td>
                            <td colspan="2">&euro;'.$total_price.'</td>
                        </tr>
                        <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        </tr>
                    </table>
                    <table style="width:200px; margin-top:100px;">
                    <tr>
                    <td><img src="'.URL.'php/barcode.php?text='.$order['barcode'].'"></td>
                    </tr>
                    <tr>
                    <td style="text-align:center;">'.$order['barcode'].'</td>
                    </tr>
                    </table>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>';
                
                $pdf->writeHTML($html, true, false, true, false, '');
                $pdf->lastPage();
                ob_clean();
               
$fileatt = $pdf->Output(APP.'libs/pdf/'.$order['id'].'.pdf', "F"); //save the pdf to a folder setting `F`
require_once(APP.'libs/phpmailer/class.phpmailer.php'); //where your phpmailer folder is
$mail = new PHPMailer();                    
$mail->From = "order@gameshub.com";
$mail->FromName = "Bas van der Hoeven";
$mail->AddAddress($customer['email']);
$mail->AddReplyTo("email@gmail.com", "Bas van der Hoeven");               
$mail->AddAttachment(APP.'libs/pdf/'.$order['id'].'.pdf');      
// attach pdf that was saved in a folder
$mail->Subject = "Ophaalbon";                  
$mail->Body = "Bedankt voor uw aankoop bij Gameshub, in de bijlage vind u een pdf met daarin de ophaalbon. print deze uit en neem deze mee naar de winkel om uw game(s) op te halen";
if(!$mail->Send())
{
   echo "Message could not be sent. <p>";
   echo "Mailer Error: " . $mail->ErrorInfo;
}
}}
            ?>
<h2>Bedankt voor uw aankoop, u heeft nu een mail gekregen met daarin een overzicht van uw bestelling.
print deze uit en neem hem mee naar de winkel om uw games op te halen. Indien u deze bestelling een pre-order is krijgt u uw ophaalbon zodra de game op te halen is</h2>
