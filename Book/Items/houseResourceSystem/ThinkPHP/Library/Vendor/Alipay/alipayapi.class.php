<?php
/* *
 * 功能：即时到账交易接口接入页
 * 版本：3.3
 * 修改日期：2012-07-23
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。
 * 如果不想使用扩展功能请把扩展功能参数赋空值。
 * 代码由小何改造
 */
	namespace  Vendor\Alipay;
	class alipayapi{
		public $config = array();//配置
		protected $curpath = '';
		//构造
		public function __construct($config){
			//获取文件
			$this->curpath = dirname(__FILE__);
			$this->config = $config;
			//初始化系统配置
			$this->config['partner']=$config['alipay_partner'];
			$this->config['key']=$config['alipay_key'];
			$this->config['sign_type']='MD5';
			$this->config['input_charset']='utf-8';
			$this->config['private_key_path']='key/rsa_private_key.pem';
			$this->config['ali_public_key_path']= 'key/alipay_public_key.pem';
			$this->config['cacert']    = $this->curpath.'/cacert.pem';
			$this->config['transport']    = 'http';

		}
		/**
		 * [setPay 发送支付信息]
		 */
		public function setPay(){
			require_once($this->curpath."/lib/alipay_submit.class.php");
			//import('Com.Sina.Util.Couter');
			/**************************调用授权接口alipay.wap.trade.create.direct获取授权码token**************************/
			//必填，不需要修改
			$format = "xml";
			$v = "2.0";
			$req_id = date('Ymdhis').uniqid();
			//**req_data详细信息**
			//服务器异步通知页面路径,http://格式的完整路径，不允许加?id=123这类自定义参数
			$notify_url = $this->config['notify_url'];//"http://www.xxx.com/WS_WAP_PAYWAP-PHP-UTF-8/notify_url.php";
			$call_back_url = $this->config['call_back_url'];//"http://127.0.0.1:8800/WS_WAP_PAYWAP-PHP-UTF-8/call_back_url.php";
			//操作中断返回地址
			$merchant_url = $this->config['break_url'];//"http://127.0.0.1:8800/WS_WAP_PAYWAP-PHP-UTF-8/xxxx.php";
			$seller_email = $this->config['seller_email'];//卖家支付宝帐户
			$out_trade_no = $this->config['out_trade_no'];//商户网站订单系统中唯一订单号，必填
			$subject = $this->config['subject'];//订单名称,必填
			$total_fee = $this->config['total_fee'];//付款金额必填
			//请求业务参数详细
			$req_data = '<direct_trade_create_req><notify_url>' . $notify_url . '</notify_url><call_back_url>' . $call_back_url . '</call_back_url><seller_account_name>' . $seller_email . '</seller_account_name><out_trade_no>' . $out_trade_no . '</out_trade_no><subject>' . $subject . '</subject><total_fee>' . $total_fee . '</total_fee><merchant_url>' . $merchant_url . '</merchant_url></direct_trade_create_req>';
			//必填

			/************************************************************/

			//构造要请求的参数数组，无需改动
			$para_token = array(
					"service" => "alipay.wap.trade.create.direct",
					"partner" => $this->config['partner'],
					"sec_id" => 'MD5',
					"format"	=> $format,
					"v"	=> $v,
					"req_id"	=> $req_id,
					"req_data"	=> $req_data,
					"_input_charset"	=> 'utf-8'
			);
			//建立请求
			$alipaySubmit = new \AlipaySubmit($this->config);
			$html_text = $alipaySubmit->buildRequestHttp($para_token);
			//URLDECODE返回的信息
			$html_text = urldecode($html_text);
			
			//解析远程模拟提交后返回的信息
			$para_html_text = $alipaySubmit->parseResponse($html_text);

			//获取request_token
			$request_token = $para_html_text['request_token'];


			/**************************根据授权码token调用交易接口alipay.wap.auth.authAndExecute**************************/

			//业务详细
			$req_data = '<auth_and_execute_req><request_token>' . $request_token . '</request_token></auth_and_execute_req>';
			//必填

			//构造要请求的参数数组，无需改动
			$parameter = array(
					"service" => "alipay.wap.auth.authAndExecute",
					"partner" => $this->config['partner'],
					"sec_id" => $this->config['sign_type'],
					"format"	=> $format,
					"v"	=> $v,
					"req_id"	=> $req_id,
					"req_data"	=> $req_data,
					"_input_charset"	=> trim(strtolower($this->config['input_charset']))
			);
			//建立请求
			$alipaySubmit = new \AlipaySubmit($this->config);
			$html_text = $alipaySubmit->buildRequestForm($parameter, 'get', '确认');
			echo $html_text;
		}
		/**
		 * [Notify description]
		 */
		public function Notify(){
			require_once($this->curpath."/lib/alipay_notify.class.php");
			$alipayNotify = new \AlipayNotify($this->config);
			
			if(empty($_POST)){
				$verify_result = $alipayNotify->verifyReturn();
			}else{
				$verify_result = $alipayNotify->verifyNotify();
			}
			if($verify_result) {
				return true;
			}else{
				return false;
			}
		}
	}
