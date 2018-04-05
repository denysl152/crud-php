<?php

function get_event_list(){
    include "../connection.php";

    try{
        return $reponse = $connection->query("SELECT * FROM event");
    } catch(PDOException $e){
       echo "Error : ". $e->getMessage();
       return false; 
    }
}

function get_event($id){
    include "../connection.php";

    try{
        $sql= "SELECT * FROM event WHERE id= ?";
        $result=$connection->prepare($sql);
        $result->bindValue(1, $id, PDO::PARAM_INT);
        $result->execute();
    }
    catch(Exception $e){
        echo $e->getMessage();
        return false;
    }
    return $result->fetch();
}

function add_event($name, $date, $start, $end, $description, $price, $image, $id=null){
    include "../connection.php";

    if($id){
        $sql = "UPDATE event SET name = ?, date = ?, start = ?, end = ?, description = ?, price = ?, image = ? WHERE id = ?";
    } else {
        $sql = "INSERT INTO event (name, date, start, end, description, price, image) VALUE(?, ?, ?, ?, ?, ?, ?)";
    }

    try{
        $result= $connection->prepare($sql);
        $result->bindValue(1, $name, PDO::PARAM_STR);
        $result->bindValue(2, $date, PDO::PARAM_STR);
        $result->bindValue(3, $start, PDO::PARAM_STR);
        $result->bindValue(4, $end, PDO::PARAM_STR);
        $result->bindValue(5, $description, PDO::PARAM_STR);
        $result->bindValue(6, $price, PDO::PARAM_INT);
        $result->bindValue(7, $image, PDO::PARAM_STR);
        if($id){
            $result->bindValue(8, $id,PDO::PARAM_INT);
        }
        $result->execute();
    } catch(Exception $e){
        echo $e->getMessage();
        return false;
    }
    return true;
}

function delete_event($id){
    include "../connection.php";

    $sql="DELETE FROM event WHERE id= ?";

    try{
        $result=$connection->prepare($sql);
        $result->bindValue(1, $id, PDO::PARAM_INT);
        $result->execute();
    }
    catch(Exception $e){
        echo $e->getMessage();
        return false;
    }
    return true;
}
?>