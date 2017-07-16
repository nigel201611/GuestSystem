<?php 
//分页类
// 共*页 当前第*页 首页 上一页 1 2 3 4 5 6 7 下一页 尾页
class  Page{
     //声明分页类的成员属性
     public $totalPage; //总页数
     public $curPage; //当前页
     public $total; //总记录数
     public $pageSize; //每页显示记录数
     public $offset; //存储偏移量
     public $url; //存储URL地址
     
     //定义构造函数,给成员属性赋初值
     function __construct($pageSize,$total){
         $this->pageSize = $pageSize;
         $this->total = $total;
         //计算总页数
         $this->totalPage = $this->getTotalPage();
         $this->curPage = $this->getCurPage();
         $this->offset = $this->getOffset();
         $this->url = $this->getUrl();
     }
         
     function getUrl(){
         //获取地址栏中路径和参数的成员方法.         
         //获取URL地址
         $url = $_SERVER['REQUEST_URI'];
         //将获取到的地址进行拆分
         $parse = parse_url($url);
         //若parse数组中仅仅含有下标path,那么翻页的url地址与翻页
         //参数之间的连接符号就是"?"
         if(isset($parse['query'])){
             //如果请求的地址中含有query,去掉query中的page参数
             //将参数转换为数组
             parse_str($parse['query'],$result);
             //将数组中的下标page去掉
             unset($result['page']);
             if(empty($result)){
                 //请求的url地址里面只有page一个参数
                 $url = $parse['path']."?";
             }else{
                 var_dump($result);
                 $query = http_build_query($result);
                 $url = $parse['path'].'?'.$query."&";
             }
             
         }else{
             $url = $parse['path']."?";
         }
         return $url;
     }
     //计算偏移量$offset
     function getOffset(){
         //偏移量 = (当前页-1)*每页显示记录数
         return ($this->curPage-1)*$this->pageSize;
     }
     function getTotalPage(){
         //总页数 = ceil(总记录数/每页显示记录数)
         return ceil($this->total/$this->pageSize);
     }
     
     //获取当前页
     function getCurPage(){
         $curPage = isset($_GET['page'])?$_GET['page']:1;
         
         /*
          * 最小值 1
          * 最大值总页数
          */
         //$curPage = 1 0
         if($curPage<1){
             $curPage = 1;
         }else if($curPage>$this->totalPage&&$this->totalPage!=0){
             $curPage = $this->totalPage;//0
         }         
         return $curPage;
     }
     
     //首页 上一页
     function flist(){
         //上一页 = 当前页 -1 
         $prev = $this->curPage - 1;//1-1 = 0
                                    //2-1 = 1
         $list = "";
         if($prev>=1){
             $list = "<a href='".$this->url."page=1'>首页</a>&nbsp;
                  <a href='".$this->url."page=$prev'>上一页</a>";
         }
         return $list;
     }
     
     // 1 2 3 4 5 6 7
     function mlist(){
         $num = 3;
         $list = "";
         // 1 2 3
         for($i=$num;$i>=1;$i--){
             $n = $this->curPage - $i;
             if($n>=1){
                $list.= "&nbsp;<a href='".$this->url."page=$n'>$n</a>&nbsp;";
             }
         }
         
         $list .= $this->curPage; //4
         //5 6 7
         for($i=1;$i<=$num;$i++){
             $n = $this->curPage + $i;//21
             if($n<=$this->totalPage){
                $list .= "&nbsp;<a href='".$this->url."page=$n'>$n</a>&nbsp;";
             }
         }
         return $list;
     }
     
     //下一页 尾页
     function llist(){
         //下一页 = 当前页+1; //19+1 = 20 
                             //20+1 = 21 
         $next = $this->curPage + 1;
         //当 next的值小于等于总页数时,可以出现文字链接
         $list = "";
         if($next<=$this->totalPage){
            $list = "<a href='".$this->url."page=$next'>下一页</a>&nbsp;
                  <a href='".$this->url."page=$this->totalPage'>尾页</a>";
         }
         return $list;
     }
     
     function  pages(){
         echo "共".$this->totalPage."页&nbsp;";
         echo "第".$this->curPage."页&nbsp;";
         echo $this->flist();//首页 上一页
         echo $this->mlist();//1 2 3 4 5 6 7 
         echo $this->llist();//下一页 尾页
     }     
}

//$p->getCurPage();













