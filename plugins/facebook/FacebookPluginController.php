<?php
class FacebookPluginController
{
    /**
     * Returns a JSON string object to the browser when hitting the root of the domain
     *
     * @url GET /plugins/facebook
     */
    public function index()
    {
        return "Hello World!!!!";
    }


    /**
     * Returns metrics values for a Facebook String ID
     *
     * @url POST /plugins/facebook/metrics
     * @url POST /metrics
     */
    public function getMetrics($data)
    {  
        // read data 
        $mArray = array();
        foreach ($data as $id) {   
            $mList = new MetricList();
            $mList->setId($id);
            $mList->setMethod('Post');
            $mList->setSourceName('Facebook');
            $mList->setIcon('http://www.facebook.com/favicon.ico');

            // Here should be place the code to identify the type of artifact to process 
            // and filter those that can't be processed
            $mList->setType('Article');            
            $mList->setPlugin('facebook.py');
            $mList->getMetrics(); // possible metrics loading method
            $mArray[$id]=$mList;
        }
        
        return $mArray; // serializes object into JSON
    }
}
?>