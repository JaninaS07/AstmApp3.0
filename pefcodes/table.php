

<?php
/*$data5['userID'] = $currentUserID;
   // sql kyselyt
  $sql="SELECT medsInfo, 1st, 2nd, 3rd, timeOfMeasurement FROM `peakFlow`
   ORDER BY timeOfMeasurement DESC LIMIT 3";
    $kysely=$DBH->prepare($sql);				
    $kysely->execute();
        
        $sql="SELECT COUNT(*) FROM peakFlow";
        $kysely1=$DBH->prepare($sql);				
        $kysely1->execute();
        $tulos = $kysely1->fetch();
        echo ("<p><h3>Edelliset puhallusarvot:</h3></p>");

        echo("<table>
            <tr>
                <th>Lääkitys</th>
                <th colspan=\"3\">Mittaukset</th>
                <th>Päivämäärä</th>
            </tr>");
        while	($row=$kysely->fetch()){	
                $formatted_datetime = date("d.m.Y, H:i", strtotime($row['timeOfMeasurement']));
                echo("<tr>
                <td>".$row['medsInfo']."</td>
                <td align=\"right\">".$row['1st']."</td>
                <td align=\"right\">".$row['2nd']."</td>
                <td align=\"right\">".$row['3rd']."</td>
                <td align=\"right\">".$formatted_datetime."</td>");
            }
        echo("</table><br/>");*/  
?>
<?php
$data5['userID'] = $currentUserID;
$sql6 = "SELECT medsInfo, 1st, 2nd, 3rd, timeOfMeasurement FROM `peakFlow`
WHERE userID = :userID ORDER BY timeOfMeasurement DESC LIMIT 3";
$kysely5=$DBH->prepare($sql6);
$kysely5->execute($data5);				

echo ("<p><h3>Edelliset puhallusarvot:</h3></p>");

echo("<table>
    <tr>
        <th colspan=\"3\">Mittaukset</th>
        <th>Lääkitys</th>
        <th>pvm & klo</th>
    </tr>");
while	($row=$kysely5->fetch()){	
        $formatted_datetime = date("d.m.Y, H:i", strtotime($row['timeOfMeasurement']));
        echo("<tr>
        <td align=\"right\">".$row['1st']."</td>
        <td align=\"right\">".$row['2nd']."</td>
        <td align=\"right\">".$row['3rd']."</td>
        <td>".$row['medsInfo']."</td>
        <td align=\"right\">".$formatted_datetime."</td>");
    }
echo("</table><br/>");

?>

