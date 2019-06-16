<?php
require('include/connect_db.php');
$id = "user4";
$sql = "SELECT * FROM siteadmin WHERE username = :id";
                                $query1 = $conn->prepare($sql);
                                $query1->bindparam(':id', $id);
                                $query1->execute();
                                //$query1->execute(array(':id' => $id));
                                while ($row = $query1->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<tr>";
                                    echo "<td>".$row['cus_id']."</td></t>";
                                    echo "<td>".$row['username']."</td>";
                                    echo "<td>".$row['add_ress']."</td>";
                                    echo "</tr>";

                                }




?>