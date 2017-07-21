/**
 * Created by nigel on 2017/7/21.
 */

//分页相关函数
function mlist(list,totalPages,curPage) {
    if(totalPages>=5){  //总页数大于等于5的情况下
        var num = 2;//一个中间分隔数
        //1,2,
        if(curPage>num && curPage<=(totalPages-num) ){ //正常情况下
            for(var i=num;i>0;i--){
                var n = curPage-i;
                list += `<li><a href="#" data-page="${n}">${n}</a></li>`;
            }
            list += `<li class="nowPage active"><a href="#" data-page="${curPage}">${curPage}</a></li>`;
            //3,4
            for(var i=1;i<=num;i++){
                var n = curPage+i;
                list += `<li><a href="#" data-page="${n}">${n}</a></li>`;
            }
        }else if(curPage<=num){//如果当前页小于$num，也要同时显示5个
            for(var i=curPage-1;i>0;i--){
                var n = curPage-i;
                list += `<li><a href="#" data-page="${n}">${n}</a></li>`;
            }
            list += `<li class="nowPage active"><a href="#" data-page="${curPage}">${curPage}</a></li>`;
            //3,4
            for(var i=1;i<=num+(num-curPage+1);i++){//!!! 2-3,1-4
                var n = curPage+i;
                list += `<li><a href="#" data-page="${n}">${n}</a></li>`;
            }
        }else if( curPage>totalPages-num ){ //如果当前页大于于$totoalPage，也要同时显示5个
            for(var i=num+(curPage-totalPages+num);i>0;i--){ //16,17,18||16,17,18,19--19-3,20-4
                var n = curPage-i;
                list += `<li><a href="#" data-page="${n}">${n}</a></li>`;
            }
            list += `<li class="nowPage active"><a href="#" data-page="${curPage}">${curPage}</a></li>`;
            //3,4
            for(var i=(curPage-totalPages+num);i<num;i++){ //19-1,20-0
                var n = curPage+i;
                list += `<li><a href="#" data-page="${n}">${n}</a></li>`;
            }
        }
    }else{ //总页数小于5时
        for(var i=1;i<curPage;i++){
            list += `<li><a href="#" data-page="${i}">${i}</a></li>`;
        }
        list += `<li class="nowPage active"><a href="#" data-page="${curPage}">${curPage}</a></li>`;
        for(var i=curPage+1;i<=totalPages;i++){
            list += `<li><a href="#" data-page="${i}">${i}</a></li>`;
        }

    }
    return list;
}
function flist(list, totalPages,curPage) {
    list += `<ul class="pagination">
                             <span class="totalPage" data-total="${totalPages}">共${totalPages}页</span>
                             <span class="curPage">当前第${curPage}页</span>
                             <li>
                             <a href="#" aria-label="first" data-page="1">
                             <span aria-hidden="true">首页</span>
                             </a>
                             </li>
                           <li>
                             <a href="#" aria-label="Previous" class="prev">
                             <span aria-hidden="true">上一页</span>
                             </a>`;
    return list;
}
function llist(list,totalPages){
    list += `<li>
                             <a href="#" aria-label="Next" class="next">
                             <span aria-hidden="true">下一页</span>
                             </a>
                             </li>
                             <li>
                             <a href="#" aria-label="end" data-page="${totalPages}">
                             <span aria-hidden="true">尾页</span>
                             </a>
                             </li>`;
    return list;
}
function pages(totalPages,curPage) {
    var list = "";
    //首页，上一页
    list = flist(list,totalPages,curPage);
    //中间分页
    list =mlist(list,totalPages,curPage);
    //下一页尾页
    list =llist(list,totalPages);

    return list;
}