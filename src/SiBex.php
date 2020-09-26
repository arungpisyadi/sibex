<?php

namespace ArungPIsyadi\SiBex;

use ArungPIsyadi\SiBex\SibexModels\Contact;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class SiBex
{
    protected $config;

    public function __construct($type, $key)
    {
        $this->config = \SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey($type, $key);
    }

    private function setupApiInstance($mode)
    {
        switch ($mode) {
            case 'account':
                return new \SendinBlue\Client\Api\AccountApi(new \GuzzleHttp\Client(), $this->config);
                break;
            
            case 'contact':
                return new \SendinBlue\Client\Api\ContactsApi(new \GuzzleHttp\Client(), $this->config);
                break;
            
            default:
                # code...
                break;
        }
    }

    /** 
     * Get the account details with the API key.
     * 
     * @return array
     */
    public function getAccount()
    {
        $return = null;
        $api = $this->setupApiInstance('account');

        try {
            $return = $api->getAccount();
        } catch (\Throwable $th) {
            $return = $th->getCode().': '. $th->getMessage();
        }

        return $return;
    }

    /**
     * Get all available folder on SIB account.
     *
     * @param integer $limit
     * @param integer $offset
     * @return array $return
     */
    public function getFolders(int $limit = 10, int $offset = 0)
    {
        $return = null;
        $api = new \SendinBlue\Client\Api\ContactsApi(new \GuzzleHttp\Client(), $this->config);

        try {
            $return = $api->getFolders($limit, $offset);
        } catch (\Throwable $th) {
            $return = $th->getCode().': '. $th->getMessage();
        }

        return $return;
    }

    /**
     * Get all email list(s) from the account.
     *
     * @param integer $limit
     * @param integer $offset
     * @return array
     */
    public function getLists(int $limit = 10, int $offset = 0)
    {
        $return = null;
        $api = $this->setupApiInstance('contact');

        try {
            $return = $api->getLists($limit, $offset);
        } catch (\Throwable $th) {
            $return = $th->getCode().': '. $th->getMessage();
        }

        return $return;
    }
    
    /**
     * Create a list in the account.
     *
     * @param string $name (if null the name will be made based on current date)
     * @param integer $folderId (if null the folder id will taken from the first folder from folder list)
     * @return integer $id
     */
    public function createList(string $name = null, int $folderId = null)
    {
        $return = null;

        if(null === $folderId){
            $folders = $this->getFolders();
            $folder = Arr::first($folders['folders']);
            $folderId = $folder['id'];
        }

        if(null === $name){
            $name = Carbon::now()->format('Ymd');
        }

        $params = new \SendinBlue\Client\Model\CreateList(
            [
                'name' => $name,
                'folderId' => $folderId
            ]
        );

        $api = $this->setupApiInstance('contact');

        try {
            $list = $api->createList($params);
            $return = intval($list['id']);
        } catch (\Throwable $th) {
            $return = $th->getCode().': '.$th->getMessage();
        }

        return $return;
    }

    public function addContactToList(int $listId = null, string $emails = null)
    {
        if(null === $emails){
            return 'Error: no email is being added!';
        }
        
        $email_arr = explode(',', $emails);
        if(!is_array($email_arr)){
            return 'Error: something is wrong with the parameter format!';
        }

        if(null === $listId){
            return 'Error: list ID cannot be empty!';
        }

        if($listId == 0){
            return 'Error: list ID is wrong!';
        }

        $api = $this->setupApiInstance('contact');

        $email_params = new \SendinBlue\Client\Model\AddContactToList(['emails' => $email_arr]);
        // dd($email_params);

        try {
            $return = $api->addContactToList($listId, $email_params);
        } catch (\Throwable $th) {
            $return = $th->getCode().': '.$th->getMessage();
        }

        return $return;
    }
    
    /**
     * Create new contact based on email address input.
     * if email address already exists return string output with code 400.
     * "code":"duplicate_parameter","message":"Contact already exist"
     *
     * @param string $email
     * @param object $atts
     * @return int $id
     */
    public function createContact(string $email, object $atts = null)
    {
        $return = null;
        $params = Contact::CreateContact($email, $atts);

        $api = $this->setupApiInstance('contact');

        try {
            $contact = $api->createContact($params);
            $return = intval($contact['id']);
        } catch (\Throwable $th) {
            $return = $th->getMessage();
        }

        return $return;
    }
}