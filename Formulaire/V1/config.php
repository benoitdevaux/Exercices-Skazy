<?php
namespace config;
$mail = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque eos eum porro sapiente ullam vitae!';
$secretKey = "6LfEibYZAAAAAD06u_gSVR3mm-J_IPcEpKGoc-Pu";
extract($_POST);
$server = 'localhost';
$dbname = 'form';
$user = 'root';
$pwd = '';
$fields = [
    'lastname' => [
        'type' => 'text',
        'pattern' => '[A-Za-z\'-]{2,}',
        'required' => true,
        'label' => 'Nom'
    ],
    'firstname' => [
        'type' => 'text',
        'pattern' => '[A-Za-z\'-]{2,}',
        'required' => true,
        'label' => 'Prenom'
    ],
    'phone' => [
        'type' => 'text',
        'pattern' => '(\+687(\.|| )|)(([0-9]{2})(\.| |)){3}',
        'required' => true,
        'label' => 'Tél.'
    ],
    'mail' => [
        'type' => 'text',
        'pattern' => '[a-zA-Z0-9-_.]+@[a-zA-Z-_]+\.[a-z]{2,}',
        'required' => true,
        'label' => 'E-mail'
    ]
];