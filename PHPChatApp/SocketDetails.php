<?php
// require_once("SocketDetails.php");
// $ipaddress = "";
// $ipport = 8081;
// $server_data="{ip_address: ".$ipaddress . "ip_Port :". $ipport ."}";
// $raw = array("message"=>"Service is successful",
//                      "code"=>"1",
//                       "server_details"=>$server_data
//                      );
//                      $response = encodeJson($raw);
//                      echo $response."\n";
//                      function encodeJson($responseData) {
//                         $jsonResponse = json_encode($responseData);
//                         //var_dump("receiveservice.php".$jsonResponse);
//                         return $jsonResponse;
//                     } 

class SocketServerDetails
{
    function sendSocketServerDetails()
    {
        $ipaddress = "127:0:0:1";
        $ipport = 8081;
        // $server_data="{ \"ip_address:\" ". "\"" .$ipaddress . "\"" . " \"ip_Port :\" ". "\"" . $ipport . "\"" ."}";
        // $server_data="{ \"ip_address\" : \"" . $ipaddress . "\" ," . " \"ip_Port\" : \"" . $ipport . "\" }";
        $server_data= array("ip_address" => $ipaddress ,"ip_port" => $ipport);
        return $server_data;
    }
    function getSocketServerDetails()
    {
        // $socketsss = SocketServerDetails();
        $obtainedSocketDetails = $this->sendSocketServerDetails();
        $raw = array("message"=>"Service is successful", "code"=>"1", "server_details"=>$obtainedSocketDetails);
        $response = $this->encodeJson($raw);
        return $response."\n";
    }
    function encodeJson($responseData) {
        $jsonResponse = json_encode($responseData);
        //var_dump("receiveservice.php".$jsonResponse);
        return $jsonResponse;
    }
}
//to get post or get or .. request method type
$method = $_SERVER['REQUEST_METHOD'];
//echo $method."\n";

//to get data type like xml or json or text type
if(isset($_SERVER["CONTENT_TYPE"]))
{
	// echo $_SERVER["CONTENT_TYPE"];
	$requestContentType = $_SERVER["CONTENT_TYPE"];
	// if($requestContentType != "application/json")
	// {
	// 	$requestContentType = "application/json";
	// }
	// echo $requestContentType."\n";
}
else
{
	$requestContentType = "application/json";
	// echo "CONTENT_TYPE is not set.";
	// exit;
}


//to get values from url that attached
$userRequest = "";
if(isset($_GET["userRequest"]))
{
    $userRequest = $_GET["userRequest"];
    //echo $userRequest."\n";
}
else
{
    $userRequest="faultRequest";
}
if($userRequest === "SocketServerDetails")
{
    // $socketsss = SocketServerDetails();
    $SocketServerDetailsClass = new SocketServerDetails();
    // $GetSocketDetails = $SocketClass->sendSocketServerDetails();
    // $raw = array("message"=>"Service is successful", "code"=>"1", "server_details"=>$GetSocketDetails);
    // $response = encodeJson($raw);
    // echo $response."\n";
    echo $SocketServerDetailsClass->getSocketServerDetails();
}
else
{
    $SocketServerDetailsClass = new SocketServerDetails();
    echo $SocketServerDetailsClass->getSocketServerDetails();
}

// function encodeJson($responseData) {
//     $jsonResponse = json_encode($responseData);
//     //var_dump("receiveservice.php".$jsonResponse);
//     return $jsonResponse;
// }

/*
$rawData = json_decode(file_get_contents('php://input'),true);

if(strpos($requestContentType,'application/json') !== false)
{
    //here we are converting data from json object to an array
    $json = json_decode(file_get_contents('php://input'),true);
    $raw = $rh -> Request_Handler($userRequest, $json);
    $response = encodeJson($raw);
    echo $response."\n";
}
else if(strpos($requestContentType,'text/html') !== false)
{
    print_r($_REQUEST."\n");
    //echo $response;
}
else if(strpos($requestContentType,'application/xml') !== false)
{
    $response = new SimpleXMLElement($response);
    print_r($_REQUEST."\n");
    //echo $response;
}
else if(strpos($requestContentType,'application/x-www-form-urlencoded') !== false)
{
    $response = new SimpleXMLElement($response);
    print_r($_REQUEST."\n");
    //echo $response;
}
else
{
	echo "Content-Type is not valid try application/json";
}
*/
?>