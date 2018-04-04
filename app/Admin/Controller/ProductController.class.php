<?php
namespace Admin\Controller;

use Think\Controller;
class ProductController extends AdminCommonController{
	
    public function proctaglist(){
        $sty = I('get.sty', 1, 'intval');
        $this->pageDisplay(array('where' => array('sty' => $sty), 'sty' => $sty, 'title' => '类别管理'));
    }
    public function proctagadd(){
        $tables = I('request.tables', '');
        $send = I('post.send', '');
        $sty = I('request.sty', 1, 'intval');
        if ($tables == '') {
            $this->error('数据表为空，无法获取数据', U('index/main'), 2);
        }
        if ($send == '') {
        	$this->assign('upload', true);
            $this->assign('title', '添加类别');
            $this->assign('tables', $tables);
            $this->assign('sty', $sty);
            $this->display();
        } elseif ($send == '提交') {
            $result = M($tables)->add($this->fieldArr(array('domain', 'sty', 'pic')));
            if ($result) {
                $this->success('资料添加成功', U('Product/proctaglist', 'tables=' . $tables . '&sty=' . $sty), 2);
            } else {
                $this->error('类别添加失败，请重新试试吧', U('Product/proctagadd', 'tables=' . $tables . '&sty=' . $sty), 2);
            }
        }
    }
    public function proctagmod(){
    	$this->assign('upload', true);
        $save   = I('post.send', '');
        $tables = I('request.tables', '');
        $sty    = I('request.sty', 1);
        $id     = I('request.id', 0, 'intval');
        if ($tables == '') {
            $this->error('数据表为空，无法获取数据', U('index/main'), 2);
        }
        if ($id != 0) {
            if ($save == '') {
                $data = M($tables)->field('*')->where(array('Id' => $id))->find();
                if (!$data) {
                    $this->error('无法获取数据', U('index/main'), 2);
                }
                $this->assign('tables', $tables);
                $this->assign('data', $data);
                $this->display();
            } else {
                if ($save == '确定修改') {
                    $result = M($tables)->where(array('Id' => $id))->save($this->fieldArr(array('domain','pic')));
                    if ($result) {
                        $this->success('资料修改成功', U('Product/proctaglist', 'tables=' . $tables . '&sty=' . $data['sty']), 2);
                    } else {
                        $this->error('资料修改失败', U('Product/proctagmod', 'tables=' . $tables . '&sty=' . $data['sty'] . '&id=' . $id), 2);
                    }
                }
            }
        } else {
            $this->error('ID未指定,无法获取任何数据');
        }
    }
	
    public function promtaglist(){
        $tables = I('request.tables', '');
        $sty = I('request.sty', 1, 'intval');
        $where = 'sty=' . $sty;
        $topic = I('get.topic', '');
        $ctag = I('get.ctag', 0, 'intval');
        if ($topic != '')  $where .= ' AND topic LIKE \'%' . $topic . '%\'';
        if ($ctag != 0) $where .= ' AND ctag=' . $ctag;
		$this->assign('infdata',$this->getSelect('proctag',$sty));
        $this->pageDisplay(array('where' => $where, 'tables' => $tables, 'sty' => $sty, 'title' => '子类列表'));
    }
    public function promtagadd(){
        $tables = I('request.tables', '');
        $send = I('post.send', '');
        $sty = I('request.sty', 1, 'intval');
        if ($tables == '') {
            $this->error('数据表为空，无法获取数据', U('index/main'), 2);
        }
        if ($send == '') {
		    $this->assign('infdata',$this->getSelect('proctag',$sty));
            $this->assign('title', '添加类别');
            $this->assign('tables', $tables);
            $this->assign('sty', $sty);
            $this->display();
        } elseif ($send == '提交') {
            $result = M($tables)->add($this->fieldArr(array('sty','ctag')));
            if ($result) {
                $this->success('资料添加成功', U('Product/promtaglist', 'tables=' . $tables . '&sty=' . $sty), 2);
            } else {
                $this->error('类别添加失败，请重新试试吧', U('Product/promtagadd', 'tables=' . $tables . '&sty=' . $sty), 2);
            }
        }
    }
    public function promtagmod(){
        $save   = I('post.send', '');
        $tables = I('request.tables', '');
        $sty    = I('request.sty', 1);
        $id     = I('request.id', 0, 'intval');
        if ($tables == '') {
            $this->error('数据表为空，无法获取数据', U('index/main'), 2);
        }
        if ($id != 0) {
			$data = M($tables)->field('*')->where(array('Id' => $id))->find();
			if (!$data) {
				$this->error('无法获取数据', U('index/main'), 2);
			}
            if ($save == '') {
				$this->assign('infdata',$this->getSelect('proctag',$data['sty']));
				$this->assign('ctopic',gtopic('proctag',$data['ctag']));
                $this->assign('tables', $tables);
                $this->assign('data', $data);
                $this->display();
            } else {
                if ($save == '确定修改') {
                    $result = M($tables)->where(array('Id' => $id))->save($this->fieldArr(array('ctag')));
                    if ($result) {
                        $this->success('资料修改成功', U('Product/promtaglist', 'tables=' . $tables . '&sty=' . $data['sty']), 2);
                    } else {
                        $this->error('资料修改失败', U('Product/promtagmod', 'tables=' . $tables . '&sty=' . $data['sty'] . '&id=' . $id), 2);
                    }
                }
            }
        } else {
            $this->error('ID未指定,无法获取任何数据');
        }
    }
	
    //资料管理
    public function productlist(){
        $tables = I('request.tables', '');
        $sty = I('request.sty', 1, 'intval');
        $where = 'sty=' . $sty;
        $topic = I('get.topic', '');
        $ctag = I('get.ctag', 0, 'intval');
		$mtag = I('get.mtag', 0, 'intval');
        if ($topic != '')  $where .= ' AND topic LIKE \'%' . $topic . '%\'';
        if ($ctag != 0) $where .= ' AND ctag=' . $ctag;
		if ($mtag != 0) $where .= ' AND mtag=' . $mtag;
		$this->assign('infdata',$this->getSelect('inftype',$sty));
        $this->pageDisplay(array('where' => $where, 'sty' => $sty, 'title' => '产品列表'));
    }
    //添加资料
    public function productadd(){
        $send = I('post.send', '');
        $pics = I('post.atlas','');
        $pics = ($pics!='') ? serialize($pics) : '';
        $tables = I('request.tables', '');
        $martables = I('request.martables', '');
        $sty = I('request.sty', 1, 'intval');
        if ($tables == '') {
            $this->error('数据表为空，无法获取数据', U('index/main'), 2);
        }
        if ($send == '') {
            $datashow = array();
            $datashow['mdata'] = $this->getSelect($martables, $sty);
            $this->assign('dshow', $datashow);
            $this->assign('upload', true);
            $this->assign('date', true);
            $this->assign('editor', true);
            $this->assign('tables', $tables);
            $this->assign('martables', $martables);
            $this->assign('sty', $sty);
            $this->assign('title', '添加产品');
            $this->display();
        } else {
            if ($send == '提交') {
                $result = M($tables)->add($this->fieldArr(array('inftype', 'source', 'author', 'intro', 'content', 'keyword', 'metades', 'istop', 'date', 'pic', 'linkurl', 'sty'),array('atlas'=>$pics)));
                if ($result) {
                    $this->success('资料添加成功！', U('Product/productlist', 'tables=' . $tables . '&sty=' . $sty), 2);
                } else {
                    $this->error('资料添加失败，请重新试试吧', U('Product/productadd', 'tables=' . $tables . '&sty=' . $sty), 2);
                }
            }
        }
    }
    //资料修改
    public function productmod(){
        $save = I('post.send', '');
        $tables = I('request.tables', '');
        $pics = I('post.atlas','');
        $pics = ($pics!='') ? serialize($pics) : '';
        $martables = I('request.martables', '');
        $id = I('request.id', 0);
        if ($tables == '') {
            $this->error('数据表为空，无法获取数据', U('index/main'), 2);
        }
        if ($id != 0) {
			$dabj = M($tables);
            $data = $dabj->field('*')->where(array('Id' => $id))->find();
            if ($save == '') {
                if ($data) {
                    $datashow = array();
                    $datashow['mdata'] = $this->getSelect($martables, $data['sty']);
                    $datashow['tables'] = $tables;
                    $datashow['martables'] = $martables;
                    $this->assign('inftopic', $this->gettopic($martables, $data['inftype']));
                    $this->assign('title', '编辑产品');
                    $this->assign('upload', true);
                    $this->assign('date', true);
                    $this->assign('editor', true);
                    $this->assign('dshow', $datashow);
                    $this->assign('data', $data);
                    $this->display();
                } else {
                    $this->error('资料不存在，请重新操作！');
                }
            } else {
                if ($save == '确定修改') {
                    $result = M($tables)->where(array('Id' => $id))->save($this->fieldArr(array('inftype', 'source', 'author', 'intro', 'content', 'keyword', 'metades', 'istop', 'date', 'pic', 'linkurl'),array('atlas'=>$pics)));
                    if ($result) {
                        $this->success('资料修改成功！', U('Product/productlist', 'tables=' . $tables . '&sty=' . $data['sty']. '&martables=' . $martables));
                    } else {
                        $this->error('资料修改失败，请重新试试吧', U('Product/productmod', 'tables=' . $tables . '&sty=' . $data['sty'] . '&id=' . $id), 2);
                    }
                }
            }
        } else {
            $this->error('ID未指定,无法获取任何数据');
        }
    }
	
}