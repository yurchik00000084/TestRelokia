╔╗╔╗╔╗╔╗╔═══╗╔══╗╔╗╔══╗╔══╗╔╗╔══╗──╔══╗╔╗╔╗
║║║║║║║║║╔═╗║║╔═╝║║║╔═╝╚╗╔╝║║║╔═╝──║╔╗║║║║║
║╚╝║║║║║║╚═╝║║║──║╚╝║───║║─║╚╝║────║║║║║╚╝║
╚═╗║║║║║║╔╗╔╝║║──║╔╗║───║║─║╔╗║────║║║║╚═╗║
─╔╝║║╚╝║║║║║─║╚═╗║║║╚═╗╔╝╚╗║║║╚═╗╔╗║╚╝║──║║
─╚═╝╚══╝╚╝╚╝─╚══╝╚╝╚══╝╚══╝╚╝╚══╝╚╝╚══╝──╚╝

<?php
namespace\Zendesk::class;
namespace\Zendesk\API\Http::class;
require '../vendor/autoload.php';
use Zendesk\API\HttpClient as ZendeskAPI;

class Zendesk
{
    public function __construct($apiKey, $user, $subDomain)
    {
        $this->api_key = $apiKey;
        $this->user    = $user;
        $this->subDomain = $subDomain;
    }

    public function call()
    {
        $client = new ZendeskAPI($this->subDomain);
        $client->setAuth('basic', ['username' =>  $this->user , 'token' => $this->api_key]);
        $data = $client->tickets()->findAll();
        return $data;
    }



}