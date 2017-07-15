<?php
/**
 * Created by PhpStorm.
 * User: nigel
 * Date: 2017/7/14
 * Time: 11:20
 */
header('content-type:text/html;charset=utf-8');
class Page{
    public $pageSize;
    public $total;
    public $curPage;//用于保存当前页，这样不需要重复调用函数来得到
    public $totalPage;
    public $offset;

    function __construct($pageSize,$total)
    {
        $this->pageSize = $pageSize;
        $this->total = $total;
        $this->getTotalPage();
        $this->getCurPage();
        $this->getOffset();
    }

    //共*页
    function getTotalPage(){
        //总页数 = ceil(总记录数/每页显示记录数)
        $this->totalPage = ceil($this->total/$this->pageSize);
    }
    //当前第*几页
    function  getCurPage(){
        $curPage = isset($_GET['page']) ? $_GET['page']:1;
        if($curPage<1){
            $curPage = 1;
        }else if( $curPage>$this->totalPage && $this->totalPage!=0){
            $curPage = $this->totalPage;
        }
        //对当前页加限制
        $this->curPage = $curPage;

    }
    //首页，上一页
    function flist(){
        //上一页 = 当前页-1
        if($this->curPage != 1){
            $prev = $this->curPage-1;
        }else{
            $prev = 1;
        }
        $list = "<a href='?page=1'>首页</a> <a href='?page=".$prev."'>上一页 </a>";
        echo $list;
    }

    //尾页，下一页
    function llist(){
        if($this->curPage != $this->totalPage){
            $next = $this->curPage+1;
        }else{
            $next = $this->totalPage;
        }
        $list = "<a href='?page={$this->totalPage}'> 尾页</a> <a href='?page=".$next."'>下一页</a>";
        echo $list;
    }

    //文字分页
    function mlist(){
        $num = 2;
        $list = "";
        //1,2,
        if($this->curPage>$num && $this->curPage<=$this->totalPage-$num){ //正常情况下
            for($i=$num;$i>0;$i--){
                $n = $this->curPage-$i;
                $list .= "&nbsp;<a href='?page={$n}'>".$n."</a>&nbsp;";
            }
            $list .= "&nbsp;<a style='color:red;' href='?page={$this->curPage}'>".$this->curPage."</a>&nbsp;";
            //3,4
            for($i=1;$i<=$num;$i++){
                $n = $this->curPage+$i;
                $list .= "&nbsp;<a href='?page={$n}'>".$n."</a>&nbsp;";
            }
        }else if($this->curPage<=$num){//如果当前页小于$num，也要同时显示5个
            for($i=$this->curPage-1;$i>0;$i--){
                $n = $this->curPage-$i;
                $list .= "&nbsp;<a href='?page={$n}'>".$n."</a>&nbsp;";
            }
            $list .= "&nbsp;<a style='color:red;' href='?page={$this->curPage}'>".$this->curPage."</a>&nbsp;";
            //3,4
            for($i=1;$i<=$num+($num-$this->curPage+1);$i++){//!!!
                $n = $this->curPage+$i;
                $list .= "&nbsp;<a href='?page={$n}'>".$n."</a>&nbsp;";
            }
        }else if( $this->curPage>$this->totalPage-$num ){ //如果当前页大于于$totoalPage，也要同时显示5个
            for($i=$num+($this->curPage-$this->totalPage+$num);$i>0;$i--){ //16,17,18||16,17,18,19--19-3,20-4
                $n = $this->curPage-$i;
                $list .= "&nbsp;<a href='?page={$n}'>".$n."</a>&nbsp;";
            }
            $list .= "&nbsp;<a style='color:red;' href='?page={$this->curPage}'>".$this->curPage."</a>&nbsp;";
            //3,4
            for($i=($this->curPage-$this->totalPage+$num);$i<$num;$i++){ //19-1,20-0
                $n = $this->curPage+$i;
                $list .= "&nbsp;<a href='?page={$n}'>".$n."</a>&nbsp;";
            }
        }
        echo $list;
    }
    function getOffset(){
        $this->offset = $this->pageSize*($this->curPage-1);
    }

    //写一个出口程序
    function pages(){
        echo "共".$this->totalPage."页 ";
        echo "当前第".$this->curPage."页 ";
        echo $this->flist();//首页 上一页
        echo $this->mlist();//1 2 3 4 5
        echo $this->llist();//下一页 尾页
    }
}

