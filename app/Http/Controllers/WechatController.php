<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;
use Illuminate\Support\Facades\Config;
use EasyWeChat\Message\News;
use EasyWeChat\Message\Voice;
use EasyWeChat\Message\Raw;
use EasyWeChat\Message\Image;

class WechatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function server()
    {
        $options = Config::get('weixin');

        //dd($options);

        $app = new Application($options);

        $server = $app->server;
        $user = $app->user;

        $server->setMessageHandler(function($message) use ($user) {
            switch ($message->MsgType) {
                case 'event':
                    # 事件消息...
                    switch ($message->Event) {
                        case 'subscribe':
                            # code...
                            return '欢迎关注！';
                            break;

                        default:
                            # code...
                            break;
                    }
                    break;
                case 'text':
                    # 文字消息...
                    if ($message->Content=="【收到不支持的消息类型，暂无法显示】"){
                        $text = new Image(['media_id' => $this->imgId()]);
                        return $text;
                    }else{
                        return "您发送了文字：".$message->Content;
                    }
//                    return $news = new News([
//                        'title'       => '给你发送一个图文消息',
//                        'description' => '呵呵呵呵呵',
//                        'url'         => 'http://www.baidu.com',
//                        'image'       => 'http://mmbiz.qpic.cn/mmbiz/icJDOYj5tbyoUxuGQu5zjpZ5vHwWwyEicpGZr5ta9pYMQHpF1YQYK6g4NmLpkIwWwmqu3j0kuDdHVoLLPPbe2wLw/0',
//                        // ...
//                    ]);
                    break;
                case 'image':
                    # 图片消息...
                    $text = new Image(['media_id' => $this->imgId()]);
                    return $text;
//回复语音            return $voice = new Voice(['media_id' => 'iTzJNLJDPk5HQc5FxpJTfNcTizRr3L3-7W3ZNXKC_wvbMXoxfT_0NKHMyffRIGU_']);
//                    return "您发送了图片:".$message->PicUrl;
                    break;
                case 'voice':
                    # 语音消息...
                    return "您发送了语音:".$message->MediaId;
                    break;
                case 'video':
                    # 视频消息...
                    return "您发送了视频";
                    break;
                case 'location':
                    # 坐标消息...
                    return "您发送了坐标:x=".$message->Location_X.",y=".$message->Location_Y;
                    break;
                case 'link':
                    # 链接消息...
                    return "您发送了链接";
                    break;
                case 'shortvideo':
                    # 链接消息...
                    return "您发送了小视频";
                    break;
                // ... 其它消息
                default:
                    # code...
                    break;
            }
        });

        $server->serve()->send();
    }

    /**
     *
     */
    public function weixin()
    {
        $options = Config::get('weixin');

//        dd($options);

        $app = new Application($options);

        $notice = $app->notice;

        $messageId = $notice->send([
            'touser' => 'oqjanwAxl4WlVlcJjYwe7xl2u1zM',
            'template_id' => '0INi02ClHrFKTO9vgJ2dpFM5E4-D29AeEn8zeuCMZes',
            'url' => 'www.baidu.com',
            'topcolor' => '#66cc9a',
            'data' => [
                "first"  => "恭喜你购买成功！",
                "name"   => "巧克力",
                "price"  => "39.8元",
                "remark" => "欢迎再次购买！",
            ],
        ]);

        dd($messageId);
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function imgId()
    {
        $path = public_path().'\img\1 ('.rand(1,72).').gif';
        $options = Config::get('weixin');
        $app = new Application($options);
        $temporary = $app->material_temporary;
        $result = $temporary->uploadImage($path);  // 请使用绝对路径写法！除非你正确的理解了相对路径（好多人是没理解对的）！
        return $result['media_id'];
    }

    public function getList()
    {
        $options = Config::get('weixin');
        $app = new Application($options);
        $material = $app->material;
        $list = $material->lists('image');
        dd($list);
    }
}
