<?php

namespace ArungPIsyadi\SiBex\SibexModels;

Class Account
{
    protected $elements;
    
    /**
     * construct the protected elements.
     * 
     * @return array protected $elements
     */
    public function __construct()
    {
        $this->elements = [
            'email' => null,
            'firstName' => null,
            'lastName' => null,
            'companyName' => null,
            'address' => [],
            'plan' => [],
            'relay' => [],
            'marketingAutomation' => null,
        ];
    }
    
    /**
     * extract Account modal to readable object
     * 
     * @param array $modal
     * @return object $return
     */
    public function extract($modal = null)
    {
        if(null === $modal){
            try {
                throw new \Exception("No data to processed", 300);
            } catch (\Throwable $th) {
                dd($th->getMessage());
            }
        }

        $el = new \stdClass();
        foreach($this->elements as $key => $val){
            $el->$key = $modal[$key];
            if($key === 'address'){
                $el->$key = $this->translateAddress($modal[$key]);
            }
            if($key === 'plan'){
                $el->$key = $this->translatePlan($modal[$key]);
            }
            if($key === 'relay'){
                $el->$key = $this->translateRelay($modal[$key]);
            }
        }
        return $el;
    }

    /**
     * extract address modal to readable object
     * 
     * @param array $modal
     * @return object $return
     */
    private function translateAddress($modal)
    {
        return (object) [
            'street' => $modal['street'],
            'city' => $modal['city'],
            'zipCode' => $modal['zipCode'],
            'country' => $modal['country'],
        ];
    }

    /**
     * extract plan modal to readable object
     * 
     * @param array $modal
     * @return object $return
     */
    private function translatePlan($arr)
    {
        $return = [];
        foreach($arr as $key => $modal){
            $return[$key] = (object) [
                'type' => $modal['type'],
                'creditsType' => $modal['creditsType'],
                'credits' => $modal['credits'],
                'startDate' => $modal['startDate'],
                'endDate' => $modal['endDate'],
                'userLimit' => $modal['userLimit'],
            ];
        }

        return $return;
    }

    /**
     * extract plan modal to readable object
     * 
     * @param array $modal
     * @return object $return
     */
    private function translateRelay($modal)
    {
        return (object) [
            'enabled' => $modal['enabled'],
            'data' => [
                'userName' => $modal['data']['userName'],
                'relay' => $modal['data']['relay'],
                'port' => $modal['data']['port'],
            ],
        ];
    }
}
?>