<?php
/**
 * api 自定义错误码
 *
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/24 0024
 * Time: 16:58
 */
return [

    /**
     * 系统异常
     */
    50101=>['message'=>'System exception','code'=>50101],

    /**
     * 网络异常
     */
    50201=>['message'=>'Network exception','code'=>50201],






    /**
     * admins(对应的表)
     */
    40100=>['message'=>'错误信息','code'=>40100],

    /**
     * users
     */
    40200=>['message'=>'错误信息','code'=>40200],

    /**
     * roles
     */
    40300=>['message'=>'错误信息','code'=>40300],

    /**
     * permissions
     */
    40400=>['message'=>'错误信息','code'=>40400],

    /**
     * subjects
     */
    40500=>['message'=>'错误信息','code'=>40500],

    /**
     * pools
     */
    40600=>['message'=>'错误信息','code'=>40600],

    /**
     * tests
     */
    40700=>['message'=>'错误信息','code'=>40700],
    40701=>['message'=>'Test exists','code'=>40701],        //用户开始测试时存在暂停的测试
    40702=>['message'=>'Test underway','code'=>40702],      //用户有正在进行的测试
    40703=>['message'=>'Test submitted','code'=>40703],     //试卷已经提交
    40704=>['message'=>'Test pausing','code'=>40704],       //试卷已经被暂停了
    40705=>['message'=>'Test closing time','code'=>40705],  //试卷已经到交卷时间


    /**
     * feedback
     */
    40800=>['message'=>'错误信息','code'=>40800],
];