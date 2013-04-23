<?php

//define your token
define("TOKEN", "zjuthelp");
$wechatObj = new zjuthelp();
//$wechatObj->valid();
$wechatObj->responseMsg();

class zjuthelp
{
    public function valid()
       {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }
	
    public function responseMsg()
    {
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

      	//extract post data
		if (!empty($postStr)){
                
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
          		$event = $postObj->Event;
                $time = time();
          
          		//textTpl是回复文本消息的格式
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
          		//一条图文消息的模版
          		$newsTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[news]]></MsgType>
							<ArticleCount>1</ArticleCount>
							<Articles>
							<item>
							<Title><![CDATA[%s]]></Title>
							<Description><![CDATA[%s]]></Description>
							<PicUrl><![CDATA[%s]]></PicUrl>
							<Url><![CDATA[%s]]></Url>
							</item>
							</Articles>
							<FuncFlag>0</FuncFlag>
							</xml>";
          		$help = "发送：\n【课表】查询原创课表（部分用户可能课表有误）\n【天气】查看校园天气\n【校车】查校车时刻表\n【外卖】提供外卖号码\n【优惠】最新优惠活动\n【电话】查看校园电话\n【黄历】查工大老黄历\n【求签】测测各类吉凶";
				if(!empty($event))
                {
                  	$msgType = "text";
                    $contentStr = "欢迎关注工大助手~小助手将不定时推送校内各种有用的资讯信息\n\n你可以".$help;
                	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                	echo $resultStr;
                }
          		if(!empty( $keyword ))
                {
                    switch($keyword)
                    {
                        case "天气":
                        	$msgType = "text";
                        	$contentStr = $this->getWeather()."\n\n小助手提醒您注意天气变化，爱心伞记得放回原处哦~";
                    		$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    		echo $resultStr;
                         	break;
                        case "校车":
                    		$contentPicUrl ="http://mmsns.qpic.cn/mmsns/nMeVe6ic1s7MUE8P8fuIpUwFG8KZzVERuibpMiaVFVD2hicHzwtpPia5b4g/0";
                       	    $contentUrl="http://mp.weixin.qq.com/mp/appmsg/show?__biz=MjM5NzY2NTcyMQ==&appmsgid=10000031&itemidx=1#wechat_redirect";
                    		$resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, "校车时刻表","",$contentPicUrl,$contentUrl);
                    		echo $resultStr;
                         	break;
                        case "优惠":
                    		$contentPicUrl ="";
                       	    $contentUrl="http://mp.weixin.qq.com/mp/appmsg/show?__biz=MjM5NzY2NTcyMQ==&appmsgid=10000041&itemidx=1#wechat_redirect";
                    		$resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, "优惠活动","最新更新",$contentPicUrl,$contentUrl);
                    		echo $resultStr;
                         	break;
                        case "课表":
                    		$contentPicUrl ="";
                       	    $contentUrl="http://www.izjut.com/help/loginyuanchuang.html";
                    		$resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, "课表查询","",$contentPicUrl,$contentUrl);
                    		echo $resultStr;
                         	break;
                        case "外卖":
                    		$contentPicUrl ="";
                            $contentUrl="http://www.izjut.com/help/food.html";
                            $resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, "提供部分外卖电话","",$contentPicUrl,$contentUrl);
                            echo $resultStr;
                            break;
                        case "电话":
                    		$contentPicUrl ="";
                            $contentUrl="http://www.izjut.com/help/tel.html";
                            $resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, "校内各种电话热线","",$contentPicUrl,$contentUrl);
                            echo $resultStr;
                            break;
                        case "帮助":
                        	$contentStr = "$help";
                    		$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, "text", $contentStr);
                    		echo $resultStr;
                         	break;
                        case "黄历":
                            $contentPicUrl ="http://www.fjsen.com/images/attachement/jpg/site1/2011-12-23/5160716855638538788.jpg";
                            $contentUrl="http://www.izjut.com/help/zjutcal/";
                            $resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, "工大老黄历","",$contentPicUrl,$contentUrl);
                            echo $resultStr;
                            break;
                        case "求签":
                            $contentPicUrl ="http://d.hiphotos.baidu.com/baike/pic/item/0dd7912397dda14406509992b3b7d0a20cf486b1.jpg";
                            $contentUrl="http://www.izjut.com/help/zjutpray/";
                            $resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, "工大求签","",$contentPicUrl,$contentUrl);
                            echo $resultStr;
                            break;
                        /*default:
                        	$msgType = "text";
                    		$contentStr = "指令【".$keyword."】未定义，请输入【帮助】查看如何使用.";
                    		$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    		echo $resultStr;
    						break;*/
                    }
                }else{
                	echo "Input something...";
                }

        }else {
        	echo "";
        	exit;
        }
    }
  
	private function getWeather()
	{
		$url = 'http://m.weather.com.cn/data/101210101.html';
		$output = file_get_contents($url);
		$weather = json_decode($output,true);
		$info = $weather['weatherinfo'];
		$result = "今天：".$info['temp1']." ".$info['weather1']." ".$info['wind1']."\n明天：".$info['temp2']." ".$info['weather2']." ".$info['wind2']."\n后天：".$info['temp3']." ".$info['weather3']." ".$info['wind3'];
      	return $result;
	}
  
	private function checkSignature()
	{
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];	
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
}

?>