<?php

return [
    /** 
     * enter the sendinblue api key here.
     * save in your .env file with value "SIB_API_KEY
     * 
    */
    'key' => env('SIB_API_KEY'),
    /**
     * You can chose between to use "api-key" or "partner-key"
    */
    'type' => env('SIB_API_TYPE', 'api-key')
];