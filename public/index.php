╔╗╔╗╔╗╔╗╔═══╗╔══╗╔╗╔══╗╔══╗╔╗╔══╗──╔══╗╔╗╔╗
║║║║║║║║║╔═╗║║╔═╝║║║╔═╝╚╗╔╝║║║╔═╝──║╔╗║║║║║
║╚╝║║║║║║╚═╝║║║──║╚╝║───║║─║╚╝║────║║║║║╚╝║
╚═╗║║║║║║╔╗╔╝║║──║╔╗║───║║─║╔╗║────║║║║╚═╗║
─╔╝║║╚╝║║║║║─║╚═╗║║║╚═╗╔╝╚╗║║║╚═╗╔╗║╚╝║──║║
─╚═╝╚══╝╚╝╚╝─╚══╝╚╝╚══╝╚══╝╚╝╚══╝╚╝╚══╝──╚╝

<?php
//error_reporting(0);
require 'Zendesk.php';
namespace\Zendesk::class;
$subdomain = "testyura";
$username  = "up552195@gmail.com";
$token     = "ztEr7S6jTBf6ZsGUoQacVDibc3r1xOosqQ7JCSp1";

$zendesk = new Zendesk($token, $username, $subdomain);   // create class object

$data    = $zendesk->call();  //receive data from the api

$filename = 'openMe'.'.csv';  // name of our csv file

header('Content-type: text/csv');                                      //Header
header('Content-Disposition: attachment; filename=' . $filename);     //Header
header('Pragma: no-cache');                                          //Header
header('Expires: 0');                                               //Header

$fh = fopen('php://output', 'w');                          // open our file for writing

$keys = array(                      // keys for csv table
    '0' => 'Id',
    '1' => 'Url',
    '2' => 'Created',
    '3' => 'Updated',
    '4' => 'Type',
    '5' => 'Subject',
    '6' => 'Description',
    '7' => 'Priority',
    '8' => 'Status',
    '9' => 'Requester',
    '10' => 'Submitter',
    '11' => 'Assignee',
    '12' => 'Organization',
    '13' => 'Group',
    '14' => 'Tags',
    '15' => 'Comments'
);
fputcsv($fh, $keys, ",", "\"");    // write keys in csv

    foreach ($data->tickets as $result) {

        $result = json_decode(json_encode($result), true);     // decode json data

        $result = array(
            'id' => $result['id'],
            'url' => $result['url'],
            'created_at' => $result['created_at'],
            'updated_at' => $result['updated_at'],
            'type' => $result['type'],
            'subject' => $result['subject'],
            'description' => $result['description'],
            'priority' => $result['priority'],
            'status' => $result['status'],

        );
        fputcsv($fh, $result, ",", "\"");    //write array in csv
    }



