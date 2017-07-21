/**
 * Created by nigel on 2016/11/28.
 */
;(function($){
    $.fn.extend({
        "advance_query":function(advanceQuery){
            //高级查询
            var formSearch = $(this),
                searchObj = advanceQuery.searchObj,
                statusObj = advanceQuery.statusObj,
                timeObj = advanceQuery.timeObj;
//添加普通查询
            formSearch.on("click","#addSearch", function () {
                var selectType = "",
                    selectRange = "",
                    type = searchObj.type,
                    range = searchObj.range;
                for(item in type){
                    selectType += ` <option value="${item}">${type[item]}</option>`;
                }
                for(item in range){
                    selectRange += item === "="?`<option value="${item}" selected>${range[item]}</option>`:
                        `<option value="${item}">${range[item]}</option>`;
                }
                var html = $(`<div>
         <div class="form-group">
            <select name="type" class="col-lg-2">
                ${selectType}
            </select>
            <select name="range" class="col-lg-2">
                ${selectRange}
            </select>
            <input type="text" name="value" class="col-lg-2" placeholder="请输入对应查询值...">
            <input type="button" class="btn btn-primary" value="-" readonly/>
        </div></div>`);
                formSearch.find("#advance_query_buttons").eq(0).before(html);
            });
//添加状态查询
            var  value = statusObj.value_status;  //默认是字段1 status的value值
            formSearch.on("click","#addStatus", function (){
                value = statusObj.value_status;//每次点击新增，初始化value;
                var type = statusObj.type,
                    range_status = statusObj.range_status,
                    selectType = "",
                    selectRange = "",
                    selectValue = "";
                for(item in type){
                    selectType += ` <option value="${item}">${type[item]}</option>`;
                }
                for(item in range_status){
                    selectRange += item === "="?`<option value="${item}" selected>${range_status[item]}</option>`:
                        `<option value="${item}">${range_status[item]}</option>`;
                }
                for(item in value){
                    selectValue += `<option value="${item}">${value[item]}</option>`;
                }
                var html = $(`<div><div class="form-group">
            <select name="type" class="col-lg-2 status">
               ${selectType}
            </select>
            <select name="range_status" class="col-lg-2">
               ${selectRange}
            </select>
            <select class="col-lg-2" name="value">
                ${selectValue}
            </select>
            <input type="button" class="btn btn-primary" value="-" readonly/>
        </div></div>`);
                formSearch.find("#advance_query_buttons").eq(0).before(html);
            });
//添加时间查询
            formSearch.on("click","#addTime", function (){ var time = timeObj.time,
                selectTime = "";
                for(item in time ){
                    selectTime += `<option value="${item}">${time[item]}</option>`;
                }
                var html = $(`<div><div class="form-group">
            <input class="col-lg-2" type="text" name="start_time" placeholder="起始时间" required readonly autocomplete="off"/>
            <select name="time" class="col-lg-2">
                  ${selectTime}
            </select>
            <input class="col-lg-2" type="text" name="end_time" placeholder="结束时间" required readonly autocomplete="off"/>
            <input type="button" class="btn btn-primary" value="-" readonly/>
        </div></div>`);
                formSearch.find("#advance_query_buttons").eq(0).before(html);
            });

            //监听日期获取焦点时，样式变化
            formSearch.on("focus",'input[name$=time]',function () {
                $(this).css({border:"1px solid #cccccc"});
            });


//监听状态事件的改变 ，勿删，以后如果拓展了状态字段2，可以用到，暂时先注释
            formSearch.on('change','select[class*=status]', function () {
                var selectValue = "";
                var type = statusObj.type;
                for(item in type){
                    if($(this).val() == item){
                        value = statusObj['value_'+item];
                    }
                }
                for(item in value){
                    selectValue += `<option value="${item}">${value[item]}</option>`;
                }
                $(this).next().next().html($(selectValue));
            });

//减少条件
            formSearch.on("click","input[type=button]", function () {
                $(this).parents(".form-group").remove();
            });

//日期限定
            var start = {
                format: 'YYYY-MM-DD hh:mm:ss',
                minDate: '1970-0-0 00:00:00', //设定最小日期为当前日期
                maxDate: $.nowDate(0), //最大日期
                choosefun: function(elem,datas){
                    end.minDate = datas; //开始日选好后，重置结束日的最小日期
                }
            };
            var end = {
                format: 'YYYY-MM-DD hh:mm:ss',
                minDate: $.nowDate(0), //设定最小日期为当前日期
                maxDate: '2099-06-16 23:59:59', //最大日期
                choosefun: function(elem,datas){
                    start.maxDate = datas; //将结束日的初始值设定为开始日的最大日期
                }
            };
            formSearch.on("click","input[name=start_time]",function () {
                $(".form-search input[name=start_time]").jeDate(start);
            });
            formSearch.on("click","input[name=end_time]",function () {
                $(".form-search input[name=end_time]").jeDate(end);
            });
//清空条件
            $('body').on('click',"#advance_query_empty",function () {
                formSearch.find(".form-group").remove();
            });
        }
    });
})(jQuery);

