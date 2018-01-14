<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>跳转提示</title>
    <style type="text/css">
        *{ padding:0; margin:0; }
        body{ background:#fff;font-family: '微软雅黑';color: #333;font-size:16px;padding: 50px}

    </style>
</head>
<body>
<div class="system-message">
    <present name="message">
        <table border="0" cellpadding="20" cellspacing="15">
            <tr>
                <td rowspan="3">
                    <img src="__WEBPUBLIC__/Common/images/dispatch_success.png">
                </td>
                <td>
                    <span style="color:#555555;font-size:20px"><?php echo($message); ?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <a id="href" href="<?php echo($jumpUrl); ?>">
                        <img src="__WEBPUBLIC__/Common/images/dispatch_click.png">
                    </a>
                </td>
            </tr>
            <tr>
                <td>
                    <span id="wait" style="color:#555555;font-size:15px;"><?php echo($waitSecond); ?></span>&nbsp;
                    <span style="color:#656565;font-size:13px;">秒钟后将自动返回上一页</span>
                </td>
            </tr>
        </table>
        <else/>
        <table border="0" cellpadding="20" cellspacing="15">
            <tr>
                <td rowspan="3">
                    <img src="__WEBPUBLIC__/Common/images/dispatch_error.png">
                </td>
                <td>
                    <span style="color:#555555;font-size:20px"><?php echo($error); ?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <a id="href" href="<?php echo($jumpUrl); ?>">
                        <img src="__WEBPUBLIC__/Common/images/dispatch_click.png">
                    </a>
                </td>
            </tr>
            <tr>
                <td>
                    <span id="wait" style="color:#555555;font-size:15px;"><?php echo($waitSecond); ?></span>&nbsp;
                    <span style="color:#656565;font-size:13px;">秒钟后将自动返回上一页</span>
                </td>
            </tr>
        </table>
    </present>

</div>
<script type="text/javascript">
    (function(){
        var wait = document.getElementById('wait'),href = document.getElementById('href').href;
        var interval = setInterval(function(){
            var time = --wait.innerHTML;
            if(time <= 0) {
                location.href = href;
                clearInterval(interval);
            };
        }, 1000);
    })();
</script>
</body>
</html>