<?php
require_once("./PHPSocketDetails.php");

$socketServer = new SocketServerDetails();
$serverDetailsResponse = json_decode($socketServer->getSocketServerDetails(), true);
$host = $serverDetailsResponse['server_details']['ip_address'];
$port = $serverDetailsResponse['server_details']['ip_port'];
//Setting time out to 0 so it never time outs or stops
set_time_limit(30);

//create socket
$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");

//bind socket to the host and port
$result = socket_bind($socket, $host, $port) or die("Could not bind to socket\n");
/*
To ckech the work is going in a port 
sudo lsof -i:<port number>
then we get PID
To kill work in this port
sudo kill -9 <PID number>
*/

//Start listening to the socket
$result = socket_listen($socket, 3) or die("Could not set up socket listener\n");

//Accept incoming connection
/*
This function accepts incoming connection request on the created socket. 
After accepting the connection from client socket, 
this function returns another socket resource that is actually responsible for communication with the corresponding client socket. 
Here “$spawn” is that socket resource which is responsible for communication with client socket.
*/
$spawn = socket_accept($socket) or die("Could not accept incoming connection\n");

//Read the message from the client socket
$input = socket_read($spawn, 1024) or die("Could not read input\n");

//Working with the obtained input message, here we are reversing the string obtained
$output = strrev($input) . "\n";

//Send messsage to the client socket
socket_write($spawn, $output, strlen ($output)) or die("Could not write output\n"); 

//close the socket
// socket_close($spawn);
// socket_close($socket);


//echo ($host . "\n" . $port . "\n");

?>