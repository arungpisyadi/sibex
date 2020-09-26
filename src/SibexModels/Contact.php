<?php

namespace ArungPIsyadi\SiBex\SibexModels;

class Contact
{
    /**
     * Create SIB Model format for API request.
     *
     * @param [type] $email
     * @param [type] $atts
     * @param boolean $emailBlacklisted
     * @param boolean $smsBlacklisted
     * @param array $listIds
     * @param boolean $updateEnabled
     * @return array $params(container)
     */
    public static function CreateContact(
        $email = null, 
        $atts = null, 
        $emailBlacklisted = false, 
        $smsBlacklisted = false, 
        $listIds = [],
        $updateEnabled = false
        )
    {
        $params = [
            'email' => $email,
            'attributes' => $atts,
            'emailBlacklisted' => $emailBlacklisted,
            'smsBlacklisted' => $smsBlacklisted,
            'listIds' => $listIds,
            'updateEnabled' => $updateEnabled,
        ];

        return new \SendinBlue\Client\Model\CreateContact($params);
    }
}
?>