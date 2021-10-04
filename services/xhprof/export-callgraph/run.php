<?php

ini_set('max_execution_time', 100);

require "./vendor/autoload.php";

use hollodotme\FastCGI\Client;
use hollodotme\FastCGI\Requests\GetRequest;
use hollodotme\FastCGI\SocketConnections\NetworkSocket;

if (!empty($argv[1])) {
  $run = $argv[1];

  $client = new Client();
  $connection = new NetworkSocket('127.0.0.1', 9000, 100000, 100000);
  $query = http_build_query([
    'callgraph' => '1',
    'run' => $run,
  ]);
  $request = new GetRequest('/xhprof/viewer/index.php', $query);

  // $_GET vars
  $request->addCustomVars(["QUERY_STRING" => $query]);

  $response = $client->sendRequest($connection, $request);

  echo $response->getBody();
}
