<?php

require_once("ConnectionService.php");
require_once("ServerStatus.php");
require_once("SocketDetails.php");

class UserServices extends ServerStatus
{
    function Connection()
    {
        $getConnService = new GetConnectionService();
        $conn = $getConnService -> getConnection();
        return $conn;
    }

    function GetMovies()
    {
        try
        {
            $conn = $this->Connection();

            $sql = "SELECT * from mmplayerdb.mmplayermovies";
            $res_data = $conn->prepare($sql);
            $res_data->execute();

            // set the resulting array to associative
            $_response = $res_data->setFetchMode(PDO::FETCH_ASSOC);
            $response_ = $res_data->fetchAll();

//             "id" = $response[0]['id'];
//                "mName" = $response[0]['movieName'];
//                "mId" = $response[0]['movieId'];
//                "noOfSongs" = $response[0]['noOfSongs'];

            $movies_data = $response_;
            $response = array("message"=>"Service is successful",
                             "code"=>"1",
                              "movie_details"=>$movies_data
                             );
            $conn = null;
            return $response;
//            $conn->close();
        }
        catch(PDOException $e)
        {
            $movies_data = array();
                $response = array("message"=>"Movies list are empty",
                             "code"=>"0",
                            "movie_details"=>$movies_data
                             );
                return $response;
            //echo "Connection failed: " . $e->getMessage();
        }
    }

    function GetSongs($data)
    {
        try
        {
            $movieId = $data['movieId'];
            $conn = $this->Connection();
            $sql = "SELECT * from mmplayerdb.mmplayersongs WHERE movieId="."\"".$movieId."\"";
            $res_data = $conn->prepare($sql);
            $res_data->execute();
            $_response = $res_data->setFetchMode(PDO::FETCH_ASSOC);
            $response = $res_data->fetchAll();
            $response = array(
                    "message"=>"Login is successful",
                    "code"=>"1",
                    "SongDetails"=>$response
                );
                return $response;
        }
        catch(PDOException $e)
        {
          // echo 'Exception -> ';
          //   var_dump($e->getMessage());
            $user_data = array();
            $response = array("message"=>"Songs cannot be retrived.".$e->getMessage(),
                             "code"=>"0",
                              "UserDetails"=>""
                             );
            return $response;
            //echo "Connection failed: " . $e->getMessage();
        }
    }

    function GetSocketDetails()
    {
        try
        {
            
        }
        catch(PDOException $e)
        {
          // echo 'Exception -> ';
          //   var_dump($e->getMessage());
            $user_data = array();
            $response = array("message"=>"Songs cannot be retrived.".$e->getMessage(),
                             "code"=>"0",
                              "UserDetails"=>""
                             );
            return $response;
            //echo "Connection failed: " . $e->getMessage();
        }
    }

    function FaultMethod($data)
    {

    }

}

?>
