<?php
require_once("db.php");


$celkove=mysqli_query($conn,"SELECT count(drinks.ID) as Drinky, people.name as jmeno 
    FROM drinks
    INNER JOIN people ON drinks.id_people = people.ID
    INNER JOIN types ON drinks.id_types = types.ID
    GROUP BY people.name");
  
$names=mysqli_query($conn,"SELECT name as jmeno FROM people");


if (isset($_GET['submit'])) {
    $id = $_GET['uzivatele'];
    $Jeden=mysqli_query($conn,"SELECT types.typ, count(drinks.ID) as Drinky
        FROM drinks INNER JOIN people ON drinks.id_people = people.ID
        INNER JOIN types ON drinks.id_types = types.ID WHERE people.name = '$id'
        GROUP BY types.typ");




    }

?>

<!DOCTYPE html>
<html>
	<head>
        <meta charset="UTF-8" >

        <style>
            table,tr,td{
                border:1px solid black;
                text-align:center;
                
            }
            th{
                border:1px solid black;
                text-align:center;
                background-color:grey;
            }
            a{
                font-size:123%;
            }
              
        
        </style>

	</head>

	<body>
        
        
        <div class="table">
            <table>
                <tr>
                    <th>Kdo pil</th>
                    <th>Kolik toho vypil</th>
                </tr>
                <?php while ($Vsichni = mysqli_fetch_array($celkove)) { ?>
                    <tr>
                        <td><?php echo $Vsichni['jmeno']; ?></td>
                        <td><?php echo $Vsichni['Drinky']; ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>

       
        <div class="option">
            <form action="index.php" method="GET">
                    <select id="uzivatele" name="uzivatele">
                        <?php while ($Jmena = mysqli_fetch_array($names)) { ?>
                            <option value="<?php echo $Jmena['jmeno']; ?>"><?php echo $Jmena['jmeno']; ?></option>
                        <?php } ?>
                    </select>
                <input type="submit" name="submit" value="Vypsat">
            </form>
            <a>Vybrano: <?php echo $id; ?></a>
        </div>

        
        <div class="vypis">
            <table>
                    <tr>
                        <th>Co pil</th>
                        <th>Pocet</th>
                    </tr>
                    <?php while ($vypisRow = mysqli_fetch_array($Jeden)) { ?>
                        <tr>
                            <td><?php echo $vypisRow['typ']; ?></td>
                            <td><?php echo $vypisRow['Drinky']; ?></td>
                            <?php $CelkovaCena = $CelkovaCena + count_all($vypisRow['typ'],$vypisRow['Drinky']);?>
                        </tr>
                    <?php }?>
            </table>

            
            <a>Propito penez: </a>
            <a><?php echo round($CelkovaCena,2) . "Kč"; ?></a>

        </div>
	</body>
</html>

<?php 
function count_all($typ,$Drinky){
    $cena = 0;
    switch ($typ) {
        case 'Mléko':
            $cena = ($Drinky * 13.5);
            break;
            
        case 'Espresso':
            $cena = ($Drinky * 0.3);
            break;

        case 'Coffe':
            $cena = ($Drinky * 0.3);
            break;
    
        case 'Long':
            $cena = ($Drinky * 0.3);
            break;

        case 'Doppio+':
            $cena = ($Drinky * 0.3);
            break;
        
        default:
            return 0;
            break;
    }
    return $cena;
}
?>
