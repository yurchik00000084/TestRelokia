<?php
error_reporting(0);
require 'Zendesk.php';

$subdomain = "testyura";
$username  = "up552195@gmail.com"; // replace this with your registered email
$token     = "ztEr7S6jTBf6ZsGUoQacVDibc3r1xOosqQ7JCSp1"; // replace this with your token



$zendesk = new Zendesk($token, $username, $subdomain, $suffix = '.json', $test = true);

$data    = $zendesk->call("/tickets", [], "GET");
$ticketsS = $data ->tickets;
$ticketsJ = json_encode($ticketsS[0]);
$ticket = json_decode($ticketsJ);



$filename = 'tickets_' . '.csv';

$fh = fopen('php://output', 'w');

header('Content-type: text/csv');
header('Content-Disposition: attachment; filename=' . $filename);
header('Pragma: no-cache');
header('Expires: 0');


$keys = array(
    '0' => 'Id',
    '1' => 'Url',
    '2' => 'Created',
    '3' => 'Updated',
    '4' => 'Type',
    '5' => 'Subject',
    '6' => 'Description',
    '7' => 'Priority',
    '8' => 'Status'
);
fputcsv($fh, $keys, ",", "\"");
foreach($data->tickets as $result) {

    $data2 = $zendesk->call("/organizations", [], "GET");
    $orgS = $data2->organizations;
    $orgJ = json_encode($orgS[0]);
    $org = json_decode($ticketsJ);

    $data3 = $zendesk->call("/users", [], "GET");
    $usersS = $data3->users;
    $usersJ = json_encode($usersS[0]);
    $user = json_decode($usersJ);

    $data4 = $zendesk->call("/groups", [], "GET");
    $groupS = $data4->groups;
    $groupsJ = json_encode($groupS[0]);
    $group = json_decode($groupsJ);


    $result = array(
        'id' => $ticketsJ['id'],
        'url' => $ticketsJ['url'],
        'created_at' => $ticketsJ['created_at'],
        'updated_at' => $ticketsJ['updated_at'],
        'type' => $ticketsJ['type'],
        'subject' => $ticketsJ['subject'],
        'description' => $ticketsJ['description'],
        'priority' => $ticketsJ['priority'],
        'status' => $ticketsJ['status'],
    );

    fputcsv($fh, $result, ",", "\"");

}