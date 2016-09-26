<?php

class RoyalLikes {
    protected $key = "a3c8fb21c7340792a02d7d6967d2c04c4c66a7fecc1b157bca1faad882c7bc6a";
    protected $base = "http://instalike.socialmarkets.info/";
    
    protected $igis = false;
    
    public $lastResponse;
    
    public function __cosntruct(){
        return $this;
    }
    public function setIgis($id){
        $this->igis = $id;
        return $this;
    }
    public function adddOrderFollowers($package, $username, $startfollowers){
        switch($package){
            case 1:
                $package = "com.ty.vl.follower1"; //10
            break;
            case 2:
                $package = "com.ty.vl.follower2"; // 35
            break;
            case 3:
                $package = "com.ty.vl.follower3"; // 75
            break;
            case 4:
                $package = "com.ty.vl.follower4"; // 400
            break;
            case 5:
                $package = "com.ty.vl.follower5"; // 1000
            break;
            case 6:
                $package = "com.ty.vl.follower6"; // 4000
            break;
            default:
                return false;
        }
        $content = '{"avatarUrl":"http://scontent-sit4-1.cdninstagram.com/t51.2885-19/11906329_960233084022564_1448528159_a.jpg","goodsId":"'.$package.'","userName":"'.$username.'","startAt":'.$startfollowers.'}';
        $http = $this->response($this->http("user/".$this->igis."/getFollowers/".$this->igis, true, $content));
        return $this;
    }
    public function addOrderLikes($package, $mediaid, $username, $start){
        switch($package){
            case 1:
                $package = "com.ty.vl.like1"; // 20
            break;
            case 2:
                $package = "com.ty.vl.like2"; // 220
            break;
            case 3:
                $package = "com.ty.vl.like3"; // 1300
            break;
            case 4:
                $package = "com.ty.vl.like4"; // 5000
            break;
            default:
                return false;
        }
        $content = '{"goodsId":"'.$package.'","videoUrl":"http://scontent-sit4-1.cdninstagram.com/t51.2885-15/s640x640/sh0.08/e35/14473972_484680804990600_7170562172571877376_n.jpg","mediaId":"'.$mediaid.'","postCode":"BK0LPXOBgjR","videoLowURL":"http://scontent-sit4-1.cdninstagram.com/t51.2885-15/s320x320/e35/14473972_484680804990600_7170562172571877376_n.jpg","thumbnailUrl":"http://scontent-sit4-1.cdninstagram.com/t51.2885-15/s640x640/sh0.08/e35/14473972_484680804990600_7170562172571877376_n.jpg","userName":"'.$username.'","startAt":'.$start.',"goodsType":2}';
        $http = $this->response($this->http("user/".$this->igis."/getLikes/".$this->igis, true, $content));
        return $this;
    }
    public function getFollowersList($type = 0) { // 1 Followers 0 Likes
        $http = $this->response($this->http("user/".$this->igis."/getBoard/".$type."/" . $this->igis));
        return $http['boardList'];
    }
    public function followAction($orderid){
        $content = '{"actionToken":"'.$this->getactionKey($orderid).'","action":0,"orderId":'.$orderid.'}';
        $http = $this->response($this->http("user/".$this->igis."/trackAction/".$this->igis, true, $content));
        return $this;
    }
    public function login($igs, $igi){
        $this->igis = $igi; // Setting session id
        $data = '{"deviceId":"'.$this->deice().'","imei":"","platform":"0","sessionToken":"'.$igi.'","viPassword":"","viUserId":"'.$igi.'","viUserName":"'.$igs.'"}';
        $http = $this->response($this->http("user/login", true, $data));
        return $this;
    }
    protected function getactionKey($orderid){
        return strtoupper(md5("" . $orderid . round(microtime(true) * 1000)));
    }
    protected function response($response){
        if(!empty($response) AND $response !== NULL AND $response !== FALSE AND is_array($response)){
            if(!empty($response['status']) AND $response['status']['status'] == 200){
                return $response['data'];
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function http($path, $post = false, $postdata = false){
        $opts = array('http' =>
            array(
                'header'  =>    "Content-Type: application/json; charset=utf-8\n" . 
                                "appVersion: 7\n" .
                                "systemVersion: royallikesandroid/  (S5J+/19/4.4.2)\n" .
                                "User-Agent: royallikes 7 (S5J+/19/4.4.2)\n" . 
                                "appName: royallikesandroid\n" .
                                "deviceModel: S5J+/19/4.4.2\n" .
                                "timeZone: WIB\n" . 
                                "Host: instalike.socialmarkets.info",
            )
        );
        if($post){
            $opts['http']['method'] = 'POST';
            $opts['http']['content'] = $postdata;
            $opts['http']['header'] .= "\nSignature: ".$this->Signature($postdata)."\n" .
                                        "Content-Length: " . strlen($postdata);
        } else {
            $opts['http']['method'] = 'GET';
        }
        $context  = stream_context_create($opts);        

        $result = @file_get_contents($this->base . $path, false, $context);
        if($result == FALSE){
            $error = error_get_last();
            echo $error['message']; exit;
        }
        $res = json_decode($result, true);
        $this->lastResponse = $res;
        return $res;
    }
    public function deice(){
        $i = 0;
        $tmp = mt_rand(1,9);
        do {
            $tmp .= mt_rand(0, 9);
        } while(++$i < 14);
        return $tmp;
    }
    public function deviceID($type){
        $uuid = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
          mt_rand(0, 0xffff), mt_rand(0, 0xffff),
          mt_rand(0, 0xffff),
          mt_rand(0, 0x0fff) | 0x4000,
          mt_rand(0, 0x3fff) | 0x8000,
          mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
        return $type ? $uuid : str_replace('-', '', $uuid);
    }
    public function Signature($data){
        return hash_hmac("sha256", $data, $this->key);
    }
}

?>
