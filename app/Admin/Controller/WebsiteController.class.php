<?php
namespace Admin\Controller;

use Think\Controller;
class WebsiteController extends AdminCommonController{
    //关于我们
    public function aboutlist(){
        $sty = I('get.sty', 1, 'intval');
        $this->pageDisplay(array('where' => array('sty' => $sty), 'sty' => $sty));
    }
    //资料添加
    public function aboutadd(){
        $send = I('post.send', '');
        $tables = I('request.tables', '');
        $sty = I('request.sty', 1);
        if ($tables == '') {
            $this->error('数据表为空，无法获取数据', U('index/main'), 2);
        }
        if ($send == '') {
            $this->assign('tables', $tables);
            $this->assign('sty', $sty);
            $this->assign('upload', true);
			$this->assign('editor', true);
            $this->assign('title', '添加资料');
            $this->display();
        } else {
            if ($send == '提交') {
                $result = M($tables)->add($this->fieldArr(array('domain', 'intro', 'pic', 'sty', 'content', 'keyword', 'metades')));
                if ($result) {
                    $this->success('资料添加成功', U('website/aboutlist', 'tables=' . $tables . '&sty=' . $sty), 2);
                } else {
                    $this->error('资料添加失败，请重新试试吧', U('website/aboutadd', 'tables=' . $tables . '&sty=' . $sty), 2);
                }
            }
        }
    }
    //资料编辑
    public function aboutmod(){
        $save = I('post.send', '');
        $tables = I('request.tables', '');
        $sty = I('request.sty', 1);
        $id = I('request.id', 0, 'intval');
        if ($tables == '') {
            $this->error('数据表为空，无法获取数据', U('index/main'), 2);
        }
        if ($id != 0) {
            if ($save == '') {
                $dobj = M($tables);
                $data = $dobj->field('*')->where(array('Id' => $id))->find();
                if ($data) {
                    $this->assign('title', '编辑信息');
                    $this->assign('editor', true);
                    $this->assign('upload', true);
                    $this->assign('tables', $tables);
                    $this->assign('data', $data);
                    $this->display();
                } else {
                    $this->error('资料不存在，请重新操作！');
                }
            } else {
                if ($save == '确定修改') {
                    $result = M($tables)->where(array('Id' => $id))->save($this->fieldArr(array('domain', 'intro', 'pic', 'sty', 'content', 'keyword', 'metades')));
                    if ($result) {
                        $this->success('数据更新成功', U('website/aboutlist', 'tables=' . $tables . '&sty=' . $sty), 2);
                    } else {
                        $this->error('数据更新失败，请重新试试吧', U('website/aboutmod', 'tables=' . $tables . '&sty=' . $sty . '&id=' . $id), 2);
                    }
                }
            }
        } else {
            $this->error('ID未指定,无法获取任何数据');
        }
    }
    //资料管理
    public function datalist(){
        $tables = I('request.tables', '');
        $sty = I('request.sty', 1, 'intval');
        $where = 'sty=' . $sty;
        $topic = I('get.topic', '');
		$enabled = I('get.enabled', 0,'intval');
		$istop = I('get.istop', 0,'intval');
        $inftype = I('get.inftype', 0, 'intval');
        if ($topic != '')  $where .= ' AND topic LIKE \'%' . $topic . '%\'';
        if ($inftype != 0) $where .= ' AND inftype=' . $inftype;
		if ( $enabled == 1 ) $where .= ' AND enabled=0';
		if ( $enabled == 2 ) $where .= ' AND enabled=1';
		if ( $istop == 1 ) $where .= ' AND istop=0';
		if ( $istop == 2 ) $where .= ' AND istop=1';
        $this->pageDisplay(array('where' => $where, 'martables' => $martables, 'sty' => $sty, 'title' => '资料列表'));
    }
    //添加资料
    public function dataadd(){
        $send = I('post.send', '');
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
            $this->assign('title', '添加资料');
            $this->display();
        } else {
            if ($send == '提交') {
                $result = M($tables)->add($this->fieldArr(array('inftype', 'source', 'author', 'intro', 'content', 'keyword', 'metades', 'istop', 'date', 'pic', 'linkurl', 'sty')));
                if ($result) {
                    $this->success('资料添加成功！', U('website/datalist', 'tables=' . $tables . '&sty=' . $sty . '&martables=' . $martables), 2);
                } else {
                    $this->error('资料添加失败，请重新试试吧', U('website/dataadd', 'tables=' . $tables . '&sty=' . $sty . '&martables=' . $martables), 2);
                }
            }
        }
    }
    //资料修改
    public function datamod(){
        $save = I('post.send', '');
        $tables = I('request.tables', '');
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
                    $this->assign('title', '资料修改');
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
                    $result = M($tables)->where(array('Id' => $id))->save($this->fieldArr(array('inftype', 'source', 'author', 'intro', 'content', 'keyword', 'metades', 'istop', 'date', 'pic', 'linkurl')));
                    if ($result) {
                        $this->success('资料修改成功！', U('website/datalist', 'tables=' . $tables . '&sty=' . $data['sty'] . '&martables=' . $martables));
                    } else {
                        $this->error('资料修改失败，请重新试试吧', U('website/datamod', 'tables=' . $tables . '&sty=' . $data['sty'] . '&martables=' . $martables . '&id=' . $id), 2);
                    }
                }
            }
        } else {
            $this->error('ID未指定,无法获取任何数据');
        }
    }
    //资料类别列表
    public function datatypelist(){
        $sty = I('get.sty', 1, 'intval');
        $this->pageDisplay(array('where' => array('sty' => $sty), 'sty' => $sty, 'title' => '类别管理'));
    }
    //添加资料类别
    public function datatypeadd(){
        $tables = I('request.tables', '');
        $send = I('post.send', '');
        $sty = I('request.sty', 1, 'intval');
        if ($tables == '') {
            $this->error('数据表为空，无法获取数据', U('index/main'), 2);
        }
        if ($send == '') {
            $this->assign('title', '添加类别');
            $this->assign('tables', $tables);
            $this->assign('sty', $sty);
            $this->display();
        } elseif ($send == '提交') {
            $result = M($tables)->add($this->fieldArr(array('domain', 'sty')));
            if ($result) {
                $this->success('资料添加成功', U('website/datatypelist', 'tables=' . $tables . '&sty=' . $sty), 2);
            } else {
                $this->error('类别添加失败，请重新试试吧', U('website/datatypeadd', 'tables=' . $tables . '&sty=' . $sty), 2);
            }
        }
    }
    //资料类别修改
    public function datatypemod(){
        $save = I('post.send', '');
        $tables = I('request.tables', '');
        $sty = I('request.sty', 1);
        $id = I('request.id', 0, 'intval');
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
                    $result = M($tables)->where(array('Id' => $id))->save($this->fieldArr(array('domain')));
                    if ($result) {
                        $this->success('资料修改成功', U('website/datatypelist', 'tables=' . $tables . '&sty=' . $sty), 2);
                    } else {
                        $this->error('资料修改失败', U('website/datatypemod', 'tables=' . $tables . '&sty=' . $sty . '&id=' . $id), 2);
                    }
                }
            }
        } else {
            $this->error('ID未指定,无法获取任何数据');
        }
    }
    //在线留言列表
    public function message(){
        $this->pageDisplay(array('title' => '留言信息管理', 'tables' => 'message', 'order' => 'date DESC'));
    }
    //查看留言信息
    public function messageshow(){
        $save = I('post.send', '');
        $id = I('request.id', 0, 'intval');
        $tables = 'message';
        if ($id != 0) {
            if ($save == '') {
                $dobj = M($tables);
                $data = $dobj->field('*')->where(array('Id' => $id))->find();
                $this->assign('title', '查看留言信息');
                $this->assign('data', $data);
                $this->display();
            } else {
                if ($save == '处理留言') {
                    $enabled = I('post.enabled', 0, 'intval');
                    $result = M($tables)->where(array('Id' => $id))->save(array('enabled' => $enabled, 'redate' => dates()));
                    if ($result) {
                        $this->success('留言处理成功', U('website/message'), 2);
                    } else {
                        $this->error('留言处理失败', U('website/messageshow', 'id=&' . $id), 2);
                    }
                }
            }
        } else {
            $this->error('ID未指定,无法获取任何数据');
        }
    }
    //友情链接管理
    public function linkslist(){
		$sty = I('get.sty',1,'intval');
        $this->pageDisplay(array('title' => '资料管理', 'tables' => 'links', 'where'=>'1=1 and sty='.$sty,'sty'=>$sty, 'systitle' => '资料', 'subtitle' => '资料'));
    }
    //添加友情链接
    public function linksadd(){
        $send     = I('post.send', '');
		$sty      = I('request.sty',1,'intval');
		$tables   = I('request.tables', 'links','');
        if ($send == '') {
			$this->assign('sty',$sty);
			$this->assign('tables',$tables);
			$this->assign('upload', true);
            $this->assign('title', '添加资料');
            $this->display();
        } elseif ($send == '提交') {
            $result = M($tables)->add($this->fieldArr(array('linkurl', 'pic', 'sty')));
            if ($result) {
                $this->success('资料添加成功', U('website/linkslist','sty='.$sty.'&tables='.$tables), 2);
            } else {
                $this->error('资料链接添加失败，请重新试试吧', U('website/linksadd','sty='.$sty.'&tables='.$tables), 2);
            }
        }
    }
    //编辑友情链接
    public function linksmod(){
        $save = I('post.send', '');
        $id   = I('request.id', 0, 'intval');
		$sty      = I('request.sty',1,'intval');
		$tables   = I('request.tables', 'links','');
        if ($id != 0) {
			$data = M($tables)->field('*')->where(array('Id' => $id))->find();
            if ($save == '') {
                $this->assign('title', '编辑资料');
				$this->assign('tables', $tables);
				$this->assign('upload', true);
                $this->assign('data', $data);
                $this->display();
            } else {
                if ($save == '确定修改') {
                    $result = M($tables)->where(array('Id' => $id))->save($this->fieldArr(array('linkurl', 'pic')));
                    if ($result) {
                        $this->success('资料修改成功', U('website/linkslist','sty='.$data['sty'].'&tables='.$tables), 2);
                    } else {
                        $this->error('资料修改失败', U('website/linksmod', 'sty='.$data['sty'].'&id='.$id.'tables='.$tables), 2);
                    }
                }
            }
        } else {
            $this->error('ID未指定,无法获取任何数据');
        }
    }
    //客服列表
    public function onlinelist(){
        $this->pageDisplay();
    }
    //客服添加
    public function onlineadd(){
        $send = I('post.send', '');
        $tables = I('request.tables', '');
        if ($tables == '') {
            $this->error('数据表为空，无法获取数据', U('index/main'), 2);
        }
        if ($send == '') {
            $this->assign('editor', true);
            $this->assign('tables', $tables);
            $this->assign('title', '添加在线客服');
            $this->display();
        } else {
            if ($send == '提交') {
                $result = M($tables)->add($this->fieldArr(array('amount','weixin','phone')));
                if ($result) {
                    $this->success('客服添加成功', U('website/onlinelist', 'tables=' . $tables), 2);
                } else {
                    $this->error('客服添加失败，请重新试试吧', U('website/onlineadd', 'tables=' . $tables), 2);
                }
            }
        }
    }
    //客服修改
    public function onlinemod(){
        $save = I('post.send', '');
        $tables = I('request.tables', '');
        $id = I('request.id', 0, 'intval');
        if ($tables == '') {
            $this->error('数据表为空，无法获取数据', U('index/main'), 2);
        }
        if ($id != 0) {
            if ($save == '') {
                $dobj = M($tables);
                $data = $dobj->field('*')->where(array('Id' => $id))->find();
                if ($data) {
                    $this->assign('title', '编辑在线客服');
                    $this->assign('tables', $tables);
                    $this->assign('data', $data);
                    $this->display();
                } else {
                    $this->error('资料不存在，请重新操作！');
                }
            } else {
                if ($save == '确定修改') {
                    $result = M($tables)->where(array('Id' => $id))->save($this->fieldArr(array('amount','weixin','phone')));
                    if ($result) {
                        $this->success('客服更新成功', U('website/onlinelist', 'tables=' . $tables), 2);
                    } else {
                        $this->error('客服更新失败，请重新试试吧', U('website/onlinemod', 'tables=' . $tables . '&id=' . $id), 2);
                    }
                }
            }
        } else {
            $this->error('ID未指定,无法获取任何数据');
        }
    }
	
}