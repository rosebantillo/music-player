<?php

class Music{
    function store($con,$decode){
        

        $stmt = $con->prepare("INSERT INTO  music (name) VALUES (?)");
        $stmt->bind_param("s", $name);

        $name = $decode->name;
        $stmt->execute();

        $response['data'] = array('id' => $con->insert_id, 'name' => $name);
        $response['status'] = 200;



        echo json_encode($response);

    }

    function update($con,$decode){
        $name = $decode->name;
        $id = $decode->id;

        $sql = "UPDATE music SET name= '$name' WHERE id=$id";

        if($con->query($sql) === TRUE) {
            $response['status'] = '200';
            $response['data'] = array('name' => $name, 'id' => $id);
        } else {
            $response['status'] = '500';
            $response['message'] = 'Server error' . $con->error;
        }

        echo json_encode($response);
    }

    function delete($con,$decode){
        $id = $decode->id;

        $sql = "DELETE FROM music WHERE id=$id";

        if ($con->query($sql) === TRUE) {
            $response['status'] = '200';
            $response['id'] = $id;
        } else {
            $response['status'] = '500';
            $response['message'] = 'Server error';
            $response['id'] = $id;
        }

        echo json_encode($response);
    }

    function index($con){
        $sql = "SELECT id,name FROM music";
        $result = $con->query($sql);
        $jsonResult = array();
        
        if(!empty($result)){
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    array_push($jsonResult, array('id' => $row['id'],'name' => $row['name']));
                }
                echo json_encode($jsonResult);
            } 
        }
    }
}

?>