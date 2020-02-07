<?php
    include "../db.php";
    $stmt = $pdo->prepare("SELECT * FROM members");
    $stmt->execute();
    $users = $stmt->fetchAll();
    

    $stmt = $pdo->prepare("SELECT country, COUNT(*) FROM members GROUP BY country ORDER BY country LIMIT 10");
    $stmt->execute();
    $countries = $stmt->fetchAll();
?>
<div class="row">
    <div class="col-sm-12">
        <div class="basic-box">
            <div class="basic-box-head">
                <h3>Users</h3>
                -
                <h3><?php echo count($users);?></h3>
            </div>
            <div class="basic-box-body">
                <table>
                    <tr>
                        <th>User</th>
                        <th>Active</th>
                    </tr>
                    <?php foreach($users as $u){?>
                    <tr>
                        <td><?php echo $u['username'];?></td>
                        <td><?php echo $u['verified'] == 1 ? "Yes" : "No"; ?></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
        <div class="basic-box">
            <div class="basic-box-head">
                <h3>Top Countries</h3>
            </div>
            <div class="basic-box-body">
                <?php print_r($countries);?>
            </div>
        </div>
    </div>
</div>