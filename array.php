<?php
    $arr['mask1'] = [0=>'1', 'price'=>'10', 'image'=>'gold.jpg', 'name' => 'маска'];
    $arr['mask2'] = [0=>'2', 'price'=>'13', 'image'=>'bronz.jpg', 'name' => 'бронзовая маска'];
    $arr['mask3'] = [0=>'3', 'price'=>'11', 'image'=>'silver.jpg', 'name' => 'серебрян'];
?>
                    <?php
                        $conn = new mysqli("127.0.0.1", "root", "","book");
                        if (!$conn) {
                            die("Connection failed: " . mysqli_connect_error());
                        }
                        $query = "SELECT id,name FROM categories";	
                        $result = mysqli_query($conn,$query);

                        if($result){
                            echo '<ul>';  
                            while($row = mysqli_fetch_array($result)){
                                $cat_id = $row['id'];
                                $name = $row['name'];
                                echo "<li>
                                        <a href='index.php?p=2&cat_id={$cat_id}' class='categori'> {$name} </a>
                                    </li>";
                            }
                            echo '</ul>';
                        }
                        else{
                            die("Query failed: " . mysqli_error($conn));
                            }
                    ?>