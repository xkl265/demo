
<html>
<head>
        <script src="https://ssl.captcha.qq.com/TCaptcha.js"></script>
        <script src="http://pv.sohu.com/cityjson?ie=utf-8"></script>
        <script>
            window.callback = function(res){
        
                // res（用户主动关闭验证码）= {ret: 2, ticket: null}
                // res（验证成功） = {ret: 0, ticket: "String", randstr: "String"}
                if(res.ret === 0){
                    // 票据
                     console.log(res);
                     location.href="play.php?Ticket="+res.ticket+"&randstr="+res.randstr+"&appid="+res.appid+"&ret="+res.ret+"&UserIP="+returnCitySN["cip"];
                     
                }
            }
    </script>
</head>

<body>

        <button id="TencentCaptcha"
        data-appid=""
        data-cbfn="callback"
        type="button"
        >验证</button>


</body>
</html>






