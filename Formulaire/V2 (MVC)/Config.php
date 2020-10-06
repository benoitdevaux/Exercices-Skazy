<?php



define('message','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque eos eum porro sapiente ullam vitae!');
define('secretKey', "6LfEibYZAAAAAD06u_gSVR3mm-J_IPcEpKGoc-Pu");
extract($_POST);
define('server','localhost');
define('dbname','form');
define('user','root');
define('pwd','');
define('fields' , [
    'lastname' => [
        'type' => 'text',
        'pattern' => '[A-Za-z\'-]{2,}',
        'required' => true,
        'label' => 'Nom',
        'error' =>''
    ],
    'firstname' => [
        'type' => 'text',
        'pattern' => '[A-Za-z\'-]{2,}',
        'required' => true,
        'label' => 'Prenom',
        'error' =>''
    ],
    'phone' => [
        'type' => 'text',
        'pattern' => '(\+687(\.|| )|)(([0-9]{2})(\.| |)){3}',
        'required' => true,
        'label' => 'Tél.',
        'error' =>''
    ],
    'mail' => [
        'type' => 'text',
        'pattern' => '[a-zA-Z0-9-_.]+@[a-zA-Z-_]+\.[a-z]{2,}',
        'required' => true,
        'label' => 'E-mail',
        'error' =>''
    ]
]);

