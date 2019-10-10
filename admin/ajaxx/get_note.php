<?php 
include_once '../../dexcode/loader.php';
$loader = new loader();

$uid = $_GET['uid'];

    $sql = $loader->database->select("notes","uid='".$uid."'","","order by nid desc","");
    if(mysqli_num_rows($sql)){
        echo '
        <h3>My comments about the applicant: </h3>
        <div class="table-responsive">
                <table class="table">
                <thead>
                  <tr>
                    <th>Note</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>';
        while($row = mysqli_fetch_assoc($sql)){
            echo '<tr>';
                echo '<td>'.$row['note'].'</td>';
                echo '<td>'.$row['dt'].'</td>';
            echo '</tr>';
        }
        echo '  </tbody>
                    </table>
                    </div>';
    }

?>