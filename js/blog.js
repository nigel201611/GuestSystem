/**
 * Created by nigel on 2017/7/6.
 */
var pageCount;
function init(pageno){
    $.ajax({
        url:'data/getBloger.php?pageno='+pageno,
        type:"GET",
        dataType:"JSON",
        async:false,
        success:function (rsp) {
            var html = '';
            pageCount = rsp.pageCount;
            for(var i=0;i<rsp.pageInfo.length;i++){
                //用户头像随机
                var index = Math.floor(Math.random()*6+1);
                html +=` <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
        <img src="img/headPhoto/${index}.jpg" alt="${index}.jpg" style="width: 200px;height: 200px;">
        <div class="caption">
        <h3 class="username">${rsp.pageInfo[i].username}</h3>
        <p>
        <a href="#" class="btn btn-primary" role="button">发消息</a>
        <a href="#" class="btn btn-default pull-right" role="button">加好友</a>
        <a href="#" class="btn btn-primary" role="button">写留言</a>
        <a href="#" class="btn btn-default pull-right" role="button">送花</a>
        </p>
        </div>
        </div></div>`;
            }
            $(".blogerList>.row").html(html);
        }
    });
}
//初始化博友列表
init(1);

//初始化页面指标
function initPageNO(num,lastPageNO,direction){
    var pageList = '';
    //如果num>5了，那么需要改变页面指标
    var start = 1;
    if(direction == 1){ //1-向右翻页
        if(lastPageNO > 5){ //!!!
            start = lastPageNO-4;
        }
        //如果当前页面大于当前最后页面，需要处理下当前页面的active
        if(pageCount>5){
            pageList +=` <li><a href="#" class="pageToLeft">&laquo;</a></li>
                <li><a href="#" data-page="1" class="firstPage">第一页</a></li>`;
            for(var i = start;i<lastPageNO;i++){
                pageList += `<li pageno="${i}"><a href="#" data-page="${i}" class="pageItem">${i}</a></li>`;
            }
            //当前最后一页
            pageList += `<li pageno="${i}"><a href="#" data-page="${i}" class="pageItem endPage">${i}</a></li>`;
            //尾页
            pageList+=` <li><a href="#" data-page="${pageCount}" class="lastPage">尾页</a></li>
                <li><a href="#" class="pageToRight">&raquo;</a></li>`;

        }else{
            for(var i=0;i<pageCount;i++){
                pageList +=`<li><a href="#" data-page="${i}" class="pageItem">i</a></li>`;
            }
        }
        $(".blogerList .pagination").html(pageList);
        if(pageCount>5 && num < lastPageNO){
            $(".blogerList .pagination").find('li').eq(num+1).addClass("active");
        }else if( num >= lastPageNO ){ //当前页面比当前最后一页大
            $(".blogerList .pagination").find('li[pageno='+num+']').addClass("active");
        }
    }else{

        if(lastPageNO > 5){ //!!!
            start = lastPageNO-4;
        }
        //如果当前页面大于当前最后页面，需要处理下当前页面的active
        if(pageCount>5){
            pageList +=` <li><a href="#" class="pageToLeft">&laquo;</a></li>
                <li><a href="#" data-page="1" class="firstPage">第一页</a></li>`;
            for(var i = start;i<lastPageNO;i++){
                pageList += `<li pageno="${i}"><a href="#" data-page="${i}" class="pageItem">${i}</a></li>`;
            }
            //当前最后一页
            pageList += `<li pageno="${i}"><a href="#" data-page="${i}" class="pageItem endPage">${i}</a></li>`;
            //尾页
            pageList+=` <li><a href="#" data-page="${pageCount}" class="lastPage">尾页</a></li>
                <li><a href="#" class="pageToRight">&raquo;</a></li>`;

        }else{
            for(var i=0;i<pageCount;i++){
                pageList +=`<li><a href="#" data-page="${i}" class="pageItem">i</a></li>`;
            }
        }
        $(".blogerList .pagination").html(pageList);
        if(pageCount>5 && num < lastPageNO){
            $(".blogerList .pagination").find('li').eq(num+1).addClass("active");
        }else if( num >= lastPageNO ){ //当前页面比当前最后一页大
            $(".blogerList .pagination").find('li[pageno='+num+']').addClass("active");
        }
    }
}
//初始化页面指标
initPageNO(1,5,0);

//页面数字请求
$(".blogerList .pagination").on('click','a.pageItem',function (e) {
    e.preventDefault();
    var pageno = $(this).attr('data-page');
    $(this).parent().addClass('active').siblings().removeClass("active");
    init(pageno);
});
//左方向键
$(".blogerList .pagination").on('click','.pageToLeft',function (e) {
    e.preventDefault();
   //按照当前页面数字
    //如果已经是第一页了，那么单击无效
    var endPage = $(".blogerList .pagination").find(".endPage").attr('data-page');
    var currentPageNo = $(".pagination li.active").find("a").eq(0).attr('data-page');

    console.log(currentPageNo+"=>"+endPage);
    if(currentPageNo>1){
        currentPageNo--;
        init(currentPageNo);
        initPageNO(currentPageNo,endPage,0);
    }
});
//右方向键
$(".blogerList .pagination").on('click','.pageToRight',function (e) {
    e.preventDefault();
    //按照当前页面数字
    //如果已经是最后一页了，那么单击无效
    var endPage = $(".blogerList .pagination").find(".endPage").attr('data-page');
    var currentPageNo = $(".pagination li.active").find("a").eq(0).attr('data-page');
    if(currentPageNo < pageCount){
        currentPageNo++;
        init(currentPageNo);
        //如果当前页面大于当前最后一页，则使用当前页面
        currentPageNo>endPage?initPageNO(currentPageNo,currentPageNo,1):initPageNO(currentPageNo,endPage,1);
    }
});
//单击第一页
//单击尾页


// $(function() {
//     $(".pageBox").pageFun({ /*需要在本地服务器上才能浏览如:http://192.168.0.104/test/page1/index.html*/
//         interFace: "data/page.json",
//         /*接口*/
//         displayCount: 4,
//         /*每页显示总条数*/
//         maxPage: 5,
//         /*每次最多加载多少页*/
//         dataFun: function(data) {
//             var dataHtml = '<li>' + data.dataNum + '<>';
//             return dataHtml;
//         },
//         pageFun: function(i) {
//             var pageHtml = '<li class="pageNum">' + i + '<>';
//             return pageHtml;
//         }
//     })
// })





