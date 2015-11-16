<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    /* public function getPage(){
        //$this->assign('title','静态文件测试');
        //$this->assign('info','这是一个后端数据');
        $this->display();
    }*/
    public function test(){
        $this->ajaxReturn('success');
    }
    public function _initialize() {
        if (!$this->checkMethodPost()) {
            $data = array(
                'status' => '-400',
                'info' => 'Bad Request Pls Use Method POST',
                'version' => '1.0'
            );
            $this->ajaxReturn($data);
        }
    }

    private function checkMethodPost() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    public function _empty(){
        $data = array(
            'status' => '-404',
            'info' => 'Not Found',
            'version' => '1.0'
        );
        $this->ajaxReturn($data);
    }
    public function borrow() {
        $readerId = I('post.readerId');
        $time = I('post.timestamp');
        $string = I('post.string');
        $secret = I('post.secret');

        $verify = sha1(sha1($time).md5($string)."redrock");

        if ($verify != $secret) {
            $this->ajaxReturn(array(
                'status' => '-400',
                'info' => 'Secret is Error'
            ));
        }
        $info = M('t_ts_jy')->where("sfrzh = '$readerId'")->select();
        $i = 0;
        foreach ($info as $var) {
            $data[$i]['bookName'] = $var['TSMC'];
            $data[$i]['start'] = substr($var['JSRQ'],0,10);
            $data[$i]['finish'] = $var['YHRQ'];
            $i++;
        }
        $this->ajaxReturn(array(
            "status" => 200,
            "info" => "success",
            "data" => $data
        ));
    }

    public function readerInfo() {
        $time = I('post.timestamp');
        $string = I('post.string');
        $secret = I('post.secret');
        $readerId = I('post.readerId');

        $verify = sha1(sha1($time).md5($string)."redrock");

        if ($verify != $secret) {
            $this->ajaxReturn(array(
                'status' => '-400',
                'info' => 'Secret is Error'
            ));
        }

        $info = M('t_ts_dz')->where("zjhm = '$readerId'")->select();
        $data['name'] = $info[0]['DZXM'];                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
        $data['history'] = $info[0]['LJCC'];
        $data['borrow'] = $info[0]['YJCS'];
        $data['qianfei'] = $info[0]['QKJE'];

        $this->ajaxReturn(array(
            "status" => 200,
            "info" => "success",
            "data" => $data
        ));
    }

    public function nameSearch() {
        $begin = I('post.begin');
        $time = I('post.timestamp');
        $string = I('post.string');
        $secret = I('post.secret');
        $bookName = I('post.bookName');

        $verify = sha1(sha1($time).md5($string)."redrock");

        if ($verify != $secret) {
            $this->ajaxReturn(array(
                'status' => '-400',
                'info' => 'Secret is Error'
            ));
        }
        $info = M('t_ts')->field("tm,ssh,zrz,gcdmc")->where("tm like '%$bookName%' AND ztbs = '41' AND gcdmc != '报损库' AND gcdmc != '丢失' AND gcdmc != '教阅室（教阅库）'")->group('tm,ssh,zrz,gcdmc')->limit($begin,6)->select();
        $i = 0;
        foreach ($info as $var) {
            $data[$i]['bookName'] = $var['TM'];
            $data[$i]['code'] = $var['SSH'];
            $data[$i]['writer'] = $var['ZRZ'];
            $data[$i]['place'] = $var['GCDMC'];
            $i++;
        }

        $this->ajaxReturn(array(
            "status" => 200,
            "info" => "success",
            "data" => $data
        ));

    }

    public function writerSearch() {
        $begin = I('post.begin');
        $time = I('post.timestamp');
        $string = I('post.string');
        $secret = I('post.secret');
        $bookWriter = I('post.bookWriter');
        $verify = sha1(sha1($time).md5($string)."redrock");

        if ($verify != $secret) {
            $this->ajaxReturn(array(
                'status' => '-400',
                'info' => 'Secret is Error'
            ));
        }
        $info = M('t_ts')->field("tm,ssh,zrz,gcdmc")->where("zrz like '%$bookWriter%' AND ztbs = '41' AND gcdmc != '报损库' AND gcdmc != '丢失' AND gcdmc != '教阅室（教阅库）'")->group('tm,ssh,zrz,gcdmc')->limit($begin,6)->select();
        $i = 0;
        foreach ($info as $var) {
            $data[$i]['bookName'] = $var['TM'];
            $data[$i]['code'] = $var['SSH'];
            $data[$i]['writer'] = $var['ZRZ'];
            $data[$i]['place'] = $var['GCDMC'];
            $i++;
        }

        $this->ajaxReturn(array(
            "status" => 200,
            "info" => "success",
            "data" => $data
        ));

    }

    public function Board() {
        $time = I('post.timestamp');
        $string = I('post.string');
        $secret = I('post.secret');

        $verify = sha1(sha1($time).md5($string)."redrock");

        if ($verify != $secret) {
            $this->ajaxReturn(array(
                'status' => '-400',
                'info' => 'Secret is Error'
            ));
        }

        $info = M('t_ts_dz')->order("ljcc + yjcs  desc")->limit(20)->select();

        $i = 0;
        foreach ($info as $var) {
            $data[$i]['name'] = $var['DZXM'];
            $data[$i]['xueyuan'] = $var['DWMC'];
            $data[$i]['rank'] = $var['LJCC'] + $var['YJCS'];
            $i++;
        }

        $this->ajaxReturn(array(
            "status" => 200,
            "info" => "success",
            "data" => $data
        ));
    }

    public function bookSearch(){
        $begin = I('post.begin');
        $time = I('post.timestamp');
        $string = I('post.string');
        $secret = I('post.secret');
        $content = I('post.content');
        $verify = sha1(sha1($time).md5($string)."redrock");
        if ($verify != $secret) {
            $this->ajaxReturn(array(
                'status' => '-400',
                'info' => 'Secret is Error'
            ));
        }
        $info = M('t_ts')->field("tm,ssh,zrz,gcdmc")->where("(zrz like '%$content%' OR tm like '%$content%') AND ztbs = '41' AND gcdmc != '报损库' AND gcdmc != '丢失' AND gcdmc != '教阅室（教阅库）'")->group('tm,ssh,zrz,gcdmc')->limit($begin,12)->select();
        $i = 0;
        foreach ($info as $var) {
            $data[$i]['bookName'] = $var['TM'];
            $data[$i]['code'] = $var['SSH'];
            $data[$i]['writer'] = $var['ZRZ'];
            $data[$i]['place'] = $var['GCDMC'];
            $i++;
        }

        $this->ajaxReturn(array(
            "status" => 200,
            "info" => "success",
            "data" => $data
        ));
    }






}
