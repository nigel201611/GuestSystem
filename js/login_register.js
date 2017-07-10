/**
 * Created by Administrator on 2017/7/5.
 */

function delCookie(name) {
    var exp = new Date();
    exp.setTime(exp.getTime() - 1);
    var cval = getCookie(name);
    if (cval != null) {
        document.cookie = name + "=" + cval + ";expires=" + exp.toGMTString();
    }
}
function setCookie(name,value) {
    var Days = 10;
    var exp = new Date();
    exp.setTime(exp.getTime() +3600);
    document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString()+";path=/";
}


function getCookie(name) {
    var arr,
        reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
    if(arr=document.cookie.match(reg)) {
        return unescape(arr[2]);
    } else{
        return null;
    }
}


/*----------------------------注册--------------------------------------------*/
var $registerForm = $('#register_form');
var emailPreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
var phonePreg = /^1[34578]\d{9}$/;

//验证登陆手机号，邮箱格式，开发阶段，暂时不处理
// $registerForm.on('blur','input[name=username]',function () {
//     if( !emailPreg.test(this.value) && !phonePreg.test(this.value) ){
//         $('.phoneAndEmailErr').show();
//     }else{
//         $('.phoneAndEmailErr').hide();
//     }
// });

//如果用户输入的是邮箱，那么验证码输入框隐藏
$registerForm.on('blur','input[name=username]',function () {
    var userAcount = $(this).val();
    //隐藏验证码输入框
    if(emailPreg.test(userAcount)){
        $registerForm.find("input[name=code]").parent().hide();
    }else{
        $registerForm.find("input[name=code]").parent().show();
    }
});

//确认密码是否一致
$registerForm.on('blur','input[name=repassword]',function () {
    var repassword = $(this).val();
    var password = $registerForm.find('input[name=password]').eq(0).val();
    if( repassword != password ){
        $('.confirmPwd').show();
        return;
    }else{
        $('.confirmPwd').hide();
    }
});
$registerForm.on('submit',function(e){
    e.preventDefault();
    var data = $(this).serializeArray();
    var userAcount = data[0].value,
        password = data[1].value;

    //1 手机验证码验证，暂时跳过
    //2 邮箱注册激活验证，才能登陆，暂时跳过
    //3 调用接口,注册用户，添加用户

    $.ajax({
        type:'POST',
        url:'data/register.php',
        dataType:'JSON',
        data:{
            username: userAcount,
            pwd: password
        },
        success:function (rsp) {
            if(rsp.code == 0){ //注册成功
                //隐藏注册模态框
                $("#registerModal").modal('hide');
                //自动登录，将用户名显示在顶部导航上
                $('.username').text(userAcount);
                //将‘登录’，‘注册’隐藏，‘退出’显示
                $('.login').hide();
                $('.register').hide();
                $(".loginOut").removeClass('hidden');

                //注册成功，自动登陆
                var userInfo = {
                    username:userAcount,
                    isAutoLogin:1
                };
                window.localStorage.setItem('userInfo',JSON.stringify(userInfo)); //1-代表自动登陆
                window.location.reload();
            }
            //注册失败给出相应提示
            if(rsp.code == 2){  //用户名，手机号，邮箱已经存在
                $(".repeatUser").show();
            }
        }
    })
})

//退出登录状态
$(document.body).on('click','.loginOut',function () {
    $('.username').text('用户信息');
    $('.login').show();
    $('.register').show();
    $(".loginOut").addClass('hidden');
    var userInfo = {
        username:"",
        isAutoLogin:0
    };
    window.localStorage.setItem('userInfo',JSON.stringify(userInfo));
});

$registerForm.on('click','#goLogin',function () {
    $('#registerModal').modal('hide');
})

/*---------------------------------------登录-----------------------------------------------*/
var $loginForm = $('#login_form');
var emailPreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
var phonePreg = /^1[34578]\d{9}$/;
$loginForm.on('click','input[name=autoLogin]',function () {
    $(this).attr('data-value')==0?$(this).attr('data-value',1):$(this).attr('data-value',0);
});

//验证登陆手机号，邮箱格式
// $loginForm.on('blur','input[name=username]',function () {
//     if( !emailPreg.test(this.value) && !phonePreg.test(this.value) ){
//         $('.phoneAndEmailErr').show();
//     }else{
//         $('.phoneAndEmailErr').hide();
//     }
// });
$loginForm.on('submit',function(e){
    e.preventDefault();
    var data = $(this).serializeArray();
    var userAcount = data[0].value,
        password = data[1].value,
        isAutoLogin = $loginForm.find('input[name=autoLogin]').attr('data-value');

    //对密码进行加密，后台解密-暂时不做
    var userInfo = {
        username:"",
        isAutoLogin:0
    };
    if(isAutoLogin == 1){ //将用户名保存到本地存储中
        userInfo = {
            username:userAcount,
            isAutoLogin:1
        };
        window.localStorage.setItem('userInfo',JSON.stringify(userInfo)); //1-代表自动登陆
    }else{
        window.localStorage.setItem('userInfo',JSON.stringify(userInfo));
    }


    //实现qq,微信，微博登陆
    //调用接口,登陆
    //如果有登录过,而且勾选了下次‘自动登陆’，自动登录

    $.ajax({
        type:'POST',
        url:'data/login.php',
        dataType:'JSON',
        data:{
            username: userAcount,
            pwd: password
        },
        success:function (rsp) {
            if( rsp.code == 0){ //登陆成功
                //隐藏登录模态框
                $("#loginModal").modal('hide');
                // 将‘注册’，‘登录’隐藏，显示‘退出’，同时显示用户名
                $('.username').text(userAcount);
                $('.login').hide();
                $('.register').hide();
                $(".loginOut").removeClass('hidden');
//              登录成功，重新加载页面
                window.location.reload();
            }else if( rsp.code == 2){  //手机号，邮箱不存在， //登录失败给出相应提示
                $('.passwordInput').hide();
                $('.loginUsername').show();
            }else{  //否则密码错误
                $('.loginUsername').hide();
                $('.passwordInput').show();
            }

        }
    })
});

$loginForm.on('click','#goRegister',function () {
    $('#loginModal').modal('hide');
})

