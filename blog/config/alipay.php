<?php
return [
		//应用ID,您的APPID。
		'app_id' => "2016092500596002",

		//商户私钥，您的原始格式RSA私钥
		'merchant_private_key' => "MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQDXvJUy/VEVjb/VO89vaKxymHSIJYVYlG4q94Y9PwbZuSO+miCOSXC1kFs3rMdk+rwKbUK8pp9MX1V0oCe5mOsiClYb9VK22OV8YSSYKWC0UHekeswSfag9Fq1t2lNgvxE04vxKCl4Y343Wh6JfwHcU89BgesB/O5Ae2I1k2DW2bRb/5Fc7mHDMcL6M0A91WF4mJPr7lq52pmolz6wbTvQmRYmGfYrfnF+/hPCFnMXryv6+SRzjjnlK9G7BjBDbeSPF8tGEn8drchIkx74KZTLGDBsITs8TE/yyEybE3gvKjCAjPjOwGxcGp3Upw5+BT5+/KlIbGJehHVfQKNWw2BsRAgMBAAECggEBAMKfc237j1HFfiEtAvb71E7RcJd+WezOgxCqGuVX3aM/XZrOyr3yTQbPAyuX6I4VkNxLM2CjZKRugNZkwVGzPbSI5KP2Tjd8NpNdw7it43rn+PdefInV6JerxKuMwZlO5YPznixhbAA+dWPrGrYNGKDDT+Ip+00M+/iH3g7y6on1+iAdh2b358jlFqh6NAvee1RKrl4IDM5Ed3nz1mwSpQgId5S7BSAmxs0yVVeigtnFa6A1Y3kgonosfY5dRb+9raRA12FDyzaFJMnM0AB2WG4R0Yd14vYqHt4HsdRVifAphWC537W3iKh2dZcXp8O5AbbxNxNHiuR03793qbiObsECgYEA8E6OHc/vcS0H8wf07Ed1l/8kkUoyZcNNkiF571bCg+61Kx1hq3q+fQIPUtq8XzOYIbCXk4NuToFVKPsiK/rWd42oMdmRn7540HIagesxG2kg/SwkURGrayRQlUYZXeR+oSmMvXxnviI55YsWiUASneYbiAdvQun7Nqe76whajUkCgYEA5dNDddoB/AnRjk7p/KWKuThBpkL4wkaU6haec/ot29Fe2Cwj90gZU9oE7SuB2Ixr8Y60WR/izgGQuZ6MaXcLFE29cVduGtB5MmRNSKxZkmNhyQAV43FzNz5CdWKOmNJbq8fatP4PXae/WW2T4yAFFpjlk6bE336q2NVK+A3Zh4kCgYEAh6WwLz/rB1XGAPfi12VXCd+qQqFBZZQjO3POIr40usiKV7YUJfn5gRMil0CFyK+VFp9aUJiGMaZr7eAk3/KOEZpS8SDBRQz9oZxnPiMG61QinQbH0UNKIgazvi99rjSHDm4n1eZdoUQsrlge9obGe38i11xq/7iYZ7ezKe7jPpECgYAIKfEDhrL7WP3wqCz3pInA+paaaVac0BUKG7OVOxXV8SIFW8wLRKxhpiT2p8z8/D/5XLBbWh6cYsHZViB2vpvOJNTN6eUnXrBvcdCs/DJSWOVoVnBwm98T30pNESsvkolfGMJUG5JAKW1Kp/HQ55pGqze8fvgPWFiJS0pWdWd8wQKBgEVWuEUPP30igwRS1LxROkynslXmJrfztTNsK3PibONfwrjxk96GGqX/UvljoGnImruA2g3LaFBd6pv3rIDLuhrl/mtQxA+bsktNNkkxXq8gHRNguPI4mKbVT6E2gVIerGAkTq0pZJJHlqjQUnWF7owNnl1ROIud3kvIwLzIy/17",
		
		//异步通知地址
		'notify_url' => "http://blog.com",
		
		//同步跳转
		'return_url' => "http://mitsein.com/alipay.trade.wap.pay-PHP-UTF-8/return_url.php",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAxtxiHzr0xojtijkxL2ZkA7EfEfTUU7ddeX/m6QbprMkZpnr8CV1+2WddrIfBp54SlvM4xuMgyET1y6YypbVqLhTUhEg/p4bEmxGh/KBUwjDbAff+qTwxFUGYJ2bx1LP4iJM7f6tcQoT07n4RP7PAaAAW1Dw7PxXV1B6JYkGmyVq/CCuQu/CtILzE+IXltpnaBiU1JoxAn/8tBvl0UEoBfQ4CENDWwqaQ6+2DVQI41VqW+aLyp+Cu4HEbWFM2LPsq8TPm1LvmG5rpFW121vHeGCweVAr6yg12AsqL+mLMfhhtHcWtB6tUZhUnMepoguajUOYSWJJgdwefPoTMRdV/VwIDAQAB",
		
	//标识沙箱环境
    "mode"=>'dev'
];