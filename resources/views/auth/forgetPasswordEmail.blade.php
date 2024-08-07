<body style="background:#2a2a2a;font-family: sans-serif;">
    <div style="text-align: center;width: 45%; margin: 0 auto; background: #fff;">
        <img src="'.$imagePath.'" alt="" style="width: 100px;margin-top: 10px;">
        <div style="margin-top: 30px;">
            <h2>Forget Password<a style="color: #31456a;">Email</a></h2>
        </div>
        <div style="margin-top: 30px;">
            <p>You can reset password from bellow link: </p>
        </div>
        <div><a href="{{ route('reset.password.get', $token) }}" target="_blank"
                style="background:#31456a;color:#fff;padding:10px;text-decoration:none;line-height:24px;">Reset Password</a></div>

        <div style="width: 50%;border-bottom: 2px solid ##31456a;padding: 40px 0px;margin: 0 auto;">
            <p style="margin: 0;font-weight: 600;color: #3a3a3a;">&nbsp;</p>
            <p style="margin: 0;font-weight: 600;color: #3a3a3a;">Sincerly,</p>
            <p style="margin: 0;margin-top: 5px;font-weight: 600;color: #3a3a3a;">The SearchUP Team</p>
        </div>
        <div style="margin-top: 40px;">
            <h2><a style="color: ##31456a;">Search</a> UP</h2>
        </div>
        <div style="margin-top: 20px; padding-bottom: 20px;">
            <p style="font-size:15px;">© 2022 SearchUP | <a href="'.$terms.'" target="_blank"
                    style="color: #000;text-decoration: none;">Terms and Conditions</a> | <a target="_blank"
                    href="'.$privacy.'" style="color: #000;text-decoration: none;">Privacy Policy</a></p>
        </div>
    </div>
</body>
