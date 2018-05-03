<?php
require_once("./PHPSocketDetails.php");

$socketServer = new SocketServerDetails();
$serverDetailsResponse = json_decode($socketServer->getSocketServerDetails(), true);
$host = $serverDetailsResponse['server_details']['ip_address'];
$port = $serverDetailsResponse['server_details']['ip_port'];
//Note: Here the port and host should be same as defined in server.


//Create Socket
$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");

//Connect to the server
/*
Here unlike server, 
client socket is not bound with port and host. 
Instead it connects to server socket, 
waiting to accept the connection from client socket. 
Connection of client socket to server socket is established in this step.
*/
$result = socket_connect($socket, $host, $port) or die("Could not connect toserver\n");


//Write to the socket server
$message = "Hello Server";
echo "Message To server :".$message;
socket_write($socket, $message, strlen($message)) or die("Could not send data to server\n");

//Read the response for the server
$result = socket_read ($socket, 1024) or die("Could not read server response\n");
echo "Reply From Server  :".$result;

//Close the server
socket_close($socket);







?>