<?php
namespace App;


class Bitstamp {
    private $username;
    private $api_key;
    private $api_secret;
    private $nonce_v;

    /**
     * Create Bitstampapi object
     * @param string $username
     * @param string $api_key
     * @param string $api_secret
     */
    public function __construct()
    {
        $this->username = 'gzof0760';
        $this->api_key = 'tqZ71x7Tq5fgq7ecLp6Lwge64hjpR3wz';
        $this->api_secret = 'rxgqY4f21tkTfbxSaeBHfsnOe64g2d5l';
        $this->signature = $this->signature();
        $this->nonce();
    }

    /**
     * Create signature for API call validation
     * @return string hash
     */
    private function signature() {

        $customerID = $this->username;
        $bitstampApiKey = $this->api_key;
        $bitstampApiSecret = $this->api_secret;
        $message = $this->nonce() . $customerID . $bitstampApiKey;
        return strtoupper(hash_hmac('sha256', $message, $bitstampApiSecret));
    }

    /**
     * Set nonce as timestamp
     */
    private function nonce() {
        
        return date('YYYYYYYYYYYYYYYYYYYYYYYYYmdHis');
        return round(microtime(true)*100);

    }

    /**
     * Send post request to Bitstamp.io API.
     * @param string $url
     * @param array $param
     * @return array JSON results
     */
    private function post($url, $param = array()) {
        $post = '';

        if (!empty($param)) {
            foreach($param as $k => $v) {
                $post .= $k . '=' . $v . '&'; //Dirty, but work
            }

            $post = substr($post, 0, strlen($post)-1);
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'phpAPI');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $out = curl_exec($ch);

        if (curl_errno($ch)) {
            trigger_error("cURL failed. Error #".curl_errno($ch).": ".curl_error($ch), E_USER_ERROR);
        }

        curl_close($ch);

        return $out;
    }

    /**
     * Send API call (over post request), to Bitstamp.io server.
     * @param string $method
     * @param array $param
     * @param string $private
     * @param string $couple
     * @return array JSON results
     */
    public function api_call($method, $param = array(), $private = false, $couple = '') {
        $url = "https://www.bitstamp.net/api/$method"; //Create url
        if ($couple !== '') {
            $url .= "$couple/"; //set couple if needed
        }

        if ($private === true) { //Create param
               $param = array_merge(array(
                'key' => $this->api_key,
                'signature' => $this->signature(),
                'nonce' => $this->nonce()
                 ),$param);
        }

        $answer = $this->post($url, $param);
        $answer = json_decode($answer, true);

        return $answer;
    }

    /**
     * Get the current ticker results for the given pair, or 'GHS/BTC' by default.
     * @param string $couple
     * @return array JSON results
     */
    public function ticker($couple = '') {
        return $this->api_call('ticker/', array(), false, $couple);
    }

    public function orderbook($id=""){
        return $this->api_call('order_book/', array("id" => $id), true);

    }
    public function transactions($id=""){
        return $this->api_call('transactions/', array("id" => $id), true);

    }
    public function balance($id=""){

         return  $this->api_call('v2/balance/', array(), true);
    }

    public function openorders(){
        return  $this->api_call('open_orders/', array(), true);
    }
    public function order_status($order_id){
        return $this->api_call('order_status/', array("id" => $order_id), true);
    }

    public function cancel_order($order_id)
    {
        return $this->api_call('cancel_order/', array("id" => $order_id), true);
    }
    public function cancel_all_orders()
    {
        return $this->api_call('cancel_all_orders/', array(), true);
    }
    public function buy($pare="xrpusd",$amount, $price, $limit_price = 0.05) {

        return $this->api_call('v2/buy/'.$pare.'/', array(
            "amount" => $amount,

             "price" => round($price,4)),true);
    }
    public function sell($pare="xrpusd",$amount, $price , $limit_price = 0.05) {


        return $this->api_call('v2/sell/'.$pare.'/', array(
            "amount" => $amount,
            "limit_price" => round($limit_price+($price*0.3),3),
            "price" => round($price,4)),true);
    }

    public function buymarket($pare="xrpusd",$amount = 10, $price = 10, $limit_price = 0.05) {

        return $this->api_call('v2/buy/market/'.$pare.'/', array(
            "amount" => $amount,
            "limit_price" => round($limit_price+($price*0.3),3),
            "price" => round($price,4)),true);
    }
    public function sellmarket($pare="xrpusd",$amount = 10, $price = 10, $limit_price = 0.05) {

        return $this->api_call('v2/sell/market/'.$pare.'/', array(
            "amount" => $amount,
             "limit_price" => round($limit_price+($price*0.3),3),
            "price" => round($price,4)),true);
    }




}

?>
