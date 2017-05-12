<?php
use EasyWeChat\Foundation\Application;
$options = Config::get('weixin');
$app = new Application($options);
$js = $app->js;?>
<!DOCTYPE html>
<html>
<head>
    <title>分享测试</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            display: table;
            font-weight: 100;
            font-family: 'Lato';
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 96px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <div class="title">Share Test</div>
    </div>
</div>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
    wx.config(<?php echo $js->config(array('checkJsApi',
            'onMenuShareTimeline',
            'onMenuShareAppMessage',
            'onMenuShareQQ',
            'onMenuShareWeibo',
            'onMenuShareQZone',
            'hideMenuItems',
            'showMenuItems',
            'hideAllNonBaseMenuItem',
            'showAllNonBaseMenuItem',
            'translateVoice',
            'startRecord',
            'stopRecord',
            'onVoiceRecordEnd',
            'playVoice',
            'onVoicePlayEnd',
            'pauseVoice',
            'stopVoice',
            'uploadVoice',
            'downloadVoice',
            'chooseImage',
            'previewImage',
            'uploadImage',
            'downloadImage',
            'getNetworkType',
            'openLocation',
            'getLocation',
            'hideOptionMenu',
            'showOptionMenu',
            'closeWindow',
            'scanQRCode',
            'chooseWXPay',
            'openProductSpecificView',
            'addCard',
            'chooseCard',
            'openCard'), true) ?>);
    wx.ready(function () {
        wx.onMenuShareTimeline({
            title: '朋友圈分享测试', // 分享标题
            link: 'http://wseek.cn', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
            imgUrl: 'http://p.qpic.cn/weixiao/0/1486796458/640', // 分享图标
            success: function () {
                // 用户确认分享后执行的回调函数
                alert("分享成功");
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
                alert("取消分享");
            }
        });
        wx.onMenuShareAppMessage({
            title: '好友分享测试',
            desc: '好友分享测试描述',
            link: 'http://wseek.cn',
            imgUrl: 'http://p.qpic.cn/weixiao/0/1486796458/640',
            trigger: function (res) {
                // 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回
                alert('用户点击发送给朋友');
            },
            success: function (res) {
                alert('已分享');
            },
            cancel: function (res) {
                alert('已取消');
            },
            fail: function (res) {
                alert(JSON.stringify(res));
            }
        });
    });
</script>
</body>
</html>
