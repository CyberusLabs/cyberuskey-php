<?php 
require __DIR__ . '/vendor/autoload.php';
use \Firebase\JWT\JWT;

class Cyberkey {
  /**
  * @var string Your own secret key
  */
  private $secret_key;

  /**
  * @var string Your own client id
  */
  private $client_id;

  /**
  * @var string redirect url which you set the same as front-end plugin
  */
  private $redirect_url;

  /**
  * @var string public key
  */
  private static $public_key = "-----BEGIN PUBLIC KEY-----\nMIGeMA0GCSqGSIb3DQEBAQUAA4GMADCBiAKBgHElKnuERpCN/WcD6RtS9rKhJODM\nIdr2Y1yFrS255cOaG10CLwFPhSVK5z4HQv5/VN3GB2Ft+fbu9OZRTqdA4lHo0PB3\nKaj3yByDUdIoTHd4RmZMLSFVHKR0KAW193nI7s/pzeqDL0oFpHnRNZGUqhRbm2UK\nfHHDWKkTn/iGIV7XAgMBAAE=\n-----END PUBLIC KEY-----";
  
  /**
  * Code receive from Cyberus API
  * @var string
  */
  private $code;

  /**
  * @var string When results from curl will come, you can get them here
  */
  public $result = null;

  function __construct($client_id, $secret_key) {
    $this->client_id = $client_id;
    $this->secret_key = $secret_key;
    $this->code = $_GET['code'];
  }

  public function send_code() {
    $token = base64_encode("{$this->client_id}:{$this->secret_key}");
    $code_data = array(
      'code' => $this->code,
      'grant_type' => 'authorization_code',
      'redirect_uri' => $this->redirect_url
    );
    
    try {
      $curl = new \Curl\Curl();
      $curl->setHeader('Authorization', 'Basic '.$token);
      $curl->setHeader('Content-Type', 'application/x-www-form-urlencoded');
      $curl->post("https://production-api.cyberuskey.com/api/v2/tokens", $code_data);
      
      if ($curl->error) {
        var_dump($curl->error);
        throw new Exception('Error code: '.$curl->getErrorCode().' Message:'.$curl->getErrorMessage());
      } 
      
      $response = $curl->response;
      $id_token = json_decode($response)->id_token;
      $result = JWT::decode($id_token, self::$public_key, array('RS256'));
      
      $this->result = $result;
      
      return true;
    } catch(Exception $e) {
        print($e->getMessage());
    }
  
    // if ((get_site_url() != $decoded->iss) || 
    //     ($nonce[1] != $decoded->nonce)) {
    //   throw new Exception('Error: Wrong authentication token');
    // }
  }
 }