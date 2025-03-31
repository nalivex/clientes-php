<?php
$router->get('/clientes', 'ClientesController@list');
$router->post('/clientes', 'ClientesController@create');