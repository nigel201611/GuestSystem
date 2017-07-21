/**
 * Created by nigel on 2017/7/21.
 */
;(function ($) {
    $.extend({
        "addFFM":function ($wrap,username) {
            //   关闭模态框，清空数据
            var to_user;
            function clearModal($modal){
                $modal.on('show.bs.modal',function () {
                    //输入之前，清空表单内容
                    $modal.find("input[name=to_user]").eq(0).val("");
                    $modal.find("textarea[name=content]").eq(0).val("");
                    $modal.find("input[name=yzcode]").eq(0).val("");
                    $modal.find("input[name=yzcode]").eq(0).val("");
                    $modal.find("img.yzcodeImg").eq(0).attr('src',"data/yzCode.php");
                    $modal.find(".errcheck").hide();
                });
            }
            //   验证码验证相关函数
            function yzcodeCheck($form){
                //验证码判断
                $form.on('blur keyup','input[name=yzcode]',function () {
                    var yzcode = $(this).val();
                    //验证用户输入的验证码是否和服务器端生成的一样
                    if(yzcode != getCookie('yzcode')){
                        $form.find(".yzcodeErr").show();
                        //提交禁用
                        $form.find("button[type=submit]").attr('disabled',true);
                        return;
                    }else{
                        $form.find(".yzcodeErr").hide();
                        $form.find("button[type=submit]").attr('disabled',false);
                    }
                });
                $form.on('focus','input[name=yzcode]',function () {
                    $form.find(".yzcodeErr").hide();
                });
                $form.on('click','.yzcodeImg',function () {
                    this.src= "data/yzCode.php";
                });

            }
            //   提示函数
            function notyInfo(data){
                noty({
                    text: data,
                    layout: "center",
                    type: "warning",
                    modal: true,
                    buttons: [
                        {
                            addClass: 'btn btn-primary btn-xs',
                            text: '关闭',
                            onClick: function ($noty) {
                                $noty.close();
                            }
                        }
                    ]
                });
            }
            //   表单提交--信息提交和加好友
            function formSubmit($form,$modal,url,flag){
                $form.submit(function (e) {
                    e.preventDefault();
                    var data = $(this).serializeArray();
                    var postData;
                    if(flag==0){
                        var content = data[1].value,
                            yzcode = data[2].value;
                        postData = {
                            'to_user':to_user,
                            'content':content
                        };
                    }else if(flag==1){
                        var  flowerCount = data[1].value,
                            content = data[2].value,
                            yzcode = data[3].value;
                        postData = {
                            'to_user':to_user,
                            'content':content,
                            'flowerCount':flowerCount
                        };
                    }

                    //验证码判断
                    if(yzcode != getCookie('yzcode') || yzcode==''){
                        $form.find(".yzcodeErr").show();
                        //提交禁用
                        $form.find("button[type=submit]").attr('disabled',true);
                        return;
                    }else{
                        $form.find(".yzcodeErr").hide();
                        //提交禁用
                        $form.find("button[type=submit]").attr('disabled',false);
                    }
                    //发送的消息内容不能为空
                    if(!content){
                        $form.find(".contentEmptyErr").show();
                        return;
                    }else{
                        $form.find(".contentEmptyErr").hide();
                    }


                    $.ajax({
                        type:"POST",
                        url:url,
                        dataType:"JSON",
                        data:postData,
                        success:function (rsp) {
                            if(rsp.code == 1){
                                //关闭发送消息模态框
                                $modal.modal("hide");
                                notyInfo("发送成功");
                                //使能发送消息按钮
                            }else if(rsp.code == 2){
                                //登录状态失效，重新登录
                                $modal.modal("hide");
                                $("#loginModal").modal('show');
                            }else if(rsp.code == -1){
                                notyInfo("发送失败");
                            }
                        }
                    });

                });
            }

            /*---------------------发信息--------------------------------------*/
            //发送消息
            var $sendMessageModal = $("#sendMessageModal");
            var $sendMessageForm = $("#sendMessageForm");

            $wrap.on('click','.sendMessage',function () {
                //打开发送消息模态框
                var to_user = $(this).parents(".thumbnail").find(".username").eq(0).text();
                var from_user = username;
                //判断发送者不能和接收者相同
                if(to_user==from_user){
                    notyInfo('不能向自己发送消息');
                    return;
                }
                $sendMessageModal.modal('show');
                $sendMessageForm.find("input[name=to_user]").attr('readonly',true);
                $sendMessageForm.find("input[name=to_user]").val(to_user);
            });
            //提交数据，发送消息
            var messageurl = "data/sendMessage.php";
            formSubmit($sendMessageForm,$sendMessageModal,messageurl,0);
            //验证码相关判断
            yzcodeCheck($sendMessageForm);
            //关闭模态框，清空数据
            clearModal($sendMessageModal);
            /*---------------------加好友--------------------------------------*/
            var $addFriendModal = $("#addFriendModal");
            var $addFriendForm = $("#addFriendForm");

            $wrap.on('click','.addFriend',function (e) {
                e.preventDefault();
                //打开发送消息模态框
                to_user = $(this).parents(".thumbnail").find(".username").eq(0).text();
                //验证是否已经是好友
                $.ajax({
                    type:"POST",
                    url:"data/isFriend.php",
                    dataType:"JSON",
                    async:false,
                    data:{
                        to_user:to_user
                    },
                    success:function (rsp) {
                        if(rsp.code == 3){
                            notyInfo("已经是好友或者还处于待验证状态");
                        }else if(rsp.code == 0){
                            var from_user = username;
                            //判断发送者不能和接收者相同
                            if(to_user==from_user){
                                notyInfo('不能和自己加好友');
                                return;
                            }
                            $addFriendModal.modal('show');
                            $addFriendForm.find("input[name=to_user]").attr('readonly',true);
                            $addFriendForm.find("input[name=to_user]").val(to_user);
                        }else if(rsp.code == 2){
                            //登录状态失效，重新登录
                            $("#loginModal").modal('show');
                        }else if(rsp.code == -1){
                            notyInfo("添加失败,尝试关闭浏览器重新登录试试");
                        }
                    }
                });

            });
            var friendUrl = "data/addFriend.php";
            // 发送好友请求
            formSubmit($addFriendForm,$addFriendModal,friendUrl,0);
            //提交数据前验证码验证
            yzcodeCheck($addFriendForm);
            //关闭模态框失，清空数据
            clearModal($addFriendModal);
            /*---------------------送花--------------------------------------*/
            //送花功能
            var $sendFlowerModal = $("#sendFlowerModal");
            var $sendFlowerForm = $("#sendFlowerForm");

            $wrap.on('click','.addFlower',function (e) {
                e.preventDefault();
                //打开发送消息模态框
                to_user = $(this).parents(".thumbnail").find(".username").eq(0).text();
                var from_user = username;
                //判断发送者不能和接收者相同
                if(to_user==from_user){
                    notyInfo('不能向自己送花');
                    return;
                }
                $sendFlowerModal.modal('show');
                $sendFlowerForm.find("input[name=to_user]").attr('readonly',true);
                $sendFlowerForm.find("input[name=to_user]").val(to_user);
            });
            var flowerUrl = "data/sendFlower.php";
            // 发送好友请求
            formSubmit($sendFlowerForm,$sendFlowerModal,flowerUrl,1);
            //提交数据前验证码验证
            yzcodeCheck($sendFlowerModal);
            //关闭模态框失，清空数据
            clearModal($sendFlowerModal);
            //单击送花，弹出送花列表
            function initSendFlower() {
                $("body").on('click','input[name=flowerCount]',function () {
                    if(!$(this).hasClass("open")){
                        $(this).addClass("open");
                        $("#flowerMenuMask").show();
                        $("#flowerMenu").show();
                    }
                });
                function closeflowerMenu(){
                    $("input[name=flowerCount]").removeClass("open");
                    $("#flowerMenuMask").hide();
                    $("#flowerMenu").hide();
                }
                $("body").on('click','#flowerMenuMask',function () {
                    closeflowerMenu();
                });
                //回写下拉菜单数量
                $("body").on("click",'#flowerMenu li',function () {
                    var value = $(this).attr("data-value");
                    closeflowerMenu();
                    $("input[name=flowerCount]").val(value);
                });

                $sendFlowerModal.on('hide.bs.modal',function () {
                    //清空表单内容
                    $sendFlowerModal.find("input[name=flowerCount]").val("");
                    closeflowerMenu();
                });
            }
            initSendFlower();
        }
    });
})(jQuery);

