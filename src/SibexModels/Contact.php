<?php

namespace ArungPIsyadi\SiBex\SibexModels;

class Contact
{
    /**
     * Create SIB Model format for API request.
     *
     * @param string $email
     * @param array $atts
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

    public static function AddContactToList(array $emails)
    {
        return new \SendinBlue\Client\Model\AddContactToList(['emails' => $emails]);
    }

    public static function translateContacts($modal)
    {
        return (object) [
            'contacts' => collect(json_decode(json_encode($modal['contacts']))),
            'count' => (int) $modal['count'],
        ];
    }

    public static function translateLists($modal)
    {
        return (object) [
            'lists' => collect(json_decode(json_encode($modal['lists']))),
            'count' => (int) $modal['count'],
        ];
    }
}
?>