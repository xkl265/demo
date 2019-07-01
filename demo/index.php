
<html>
<head>
        <script src="https://ssl.captcha.qq.com/TCaptcha.js"></script>
        <script>
            window.callback = function(res){
        
                // res（用户主动关闭验证码）= {ret: 2, ticket: null}
                // res（验证成功） = {ret: 0, ticket: "String", randstr: "String"}
                if(res.ret === 0){
                    // 票据
                     console.log(res);

                     //跳转到防水墙反馈页面
                     location.href="play.php?Ticket="+res.ticket+"&randstr="+res.randstr+"&appid="+res.appid+"&ret="+res.ret;
                     
                }
            }
    </script>
</head>

<body>
        <!--appid-->
        <button id="TencentCaptcha"
        data-appid="" 
        data-cbfn="callback"
        type="button"
        >验证</button>


</body>
</html>






