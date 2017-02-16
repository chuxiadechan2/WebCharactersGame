<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width"/>
    <!-- NOTE: external links are for testing only -->
    <link href="{{ URL::asset('/')}}css/mui-email-styletag.css" rel="stylesheet"/>
    <link href="{{ URL::asset('/')}}css/mui-email-inline.css" rel="stylesheet"/>
    <link href="{{ URL::asset('/')}}css/emailStyle.css" rel="stylesheet"/>
</head>
<body>
<table class="mui-body" cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td>
            <center>
                <!--[if mso]>
                <table>
                    <tr>
                        <td class="mui-container-fixed"><![endif]-->
                <div class="mui-container">
                    <h3 class="mui--text-center">voi.im</h3>
                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                        <tr>
                            <td class="mui-panel">
                                <table
                                        id="content-wrapper"
                                        border="0"
                                        cellpadding="0"
                                        cellspacing="0"
                                        width="100%"
                                >
                                    <tbody>
                                    <tr>
                                        <td>
                                            <h2>欢迎加入{{ $title }}!</h2>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="mui--divider-top">
                                            你好 {{ $username }},
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            首先感谢你的注册,你收到这封邮件,是由于在voi.im注册新用户时,使用了这个邮箱地址.
                                            如果您并没有访问过voi.im,或是没有进行上述操作,请忽略这封邮件,您不需要进行退订
                                            或是进行其他进一步的操作.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table
                                                    class="mui-btn mui-btn--primary"
                                                    border="0"
                                                    cellspacing="0"
                                                    cellpadding="0"
                                            >
                                                <tr>
                                                    <td>
                                                        <a href="{{ $verifyUrl }}">验证你的邮箱地址</a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            如果你是voi.im的新用户,或是修改您的注册Email邮箱时使用了本地址,我们需要对你的
                                            地址有效性进行验证以避免垃圾邮件或地址被滥用.
                                            <br>====================================================================<br>
                                            你只需要点击上边的按钮就可以完成验证,如果上边都按钮无法点击,请复制下边的链接到
                                            浏览器来完成验证. <br>
                                            {{ $verifyUrl }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td id="last-cell">
                                            <br>
                                            voi.im.{{ $sendTime }}. <br>
                                            http://voi.im
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
                <!--[if mso]></td></tr></table><![endif]-->
            </center>
        </td>
    </tr>
</table>
</body>
</html>
