<?php

require_once("UserService.php");
//require_once("ServerStatusService.php");

class RequestHandler// extends ServerStatus
{
    function Request_Handler($userRequest, $data)
    {
        $uServices = new UserServices();
        switch($userRequest)
        {
            case "GetAllMovies":
                return $response = $uServices -> GetMovies();
                break;
            case "GetAllSongs":
                return $response = $uServices -> GetSongs($data);
                break;
            case "GetSocketDetails":
                return $response = $uServices -> GetSocketDetails();
                break;
            default:
                return $response = $uServices -> FaultMethod($data);
                break;
        }
    }

}

?>
