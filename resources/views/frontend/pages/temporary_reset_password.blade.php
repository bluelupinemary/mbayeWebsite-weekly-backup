<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <div class="container" style="position:absolute;width:100%;height:100%;top:0;left:0;right:0;display:flex;flex-direction:column;">
            <div class="header-image" style="position:relative;border:1px solid green;width:100%;padding-top:2%;padding-bottom:2%;background-size:cover;background-image: url('{{ asset('front/images/skybox_bg1.jpg')}}')">
                <div class="header-text" style="color: green;text-align:center;position:relative;top:2%;font-size:2.5em;text-shadow: #f8f9fa 0 2px 11px;
                color: gold;">Welcome <br>to the <br>World of Mbaye!</div>
            </div>
            <div class="body-div" style="position: relative; display:flex;flex-direction:column">
                <div class="mbaye-logo" style="position: relative;padding-top:3%;text-align:center;">
                    <img src="{{ asset('front/icons/alert-icon.png') }}" alt="" style="width: 20%;height:auto;">
                </div>
                <div class="body-text" style="position: relative;display:flex;flex-direction:row;padding-top:3%;">
                    <div style=""></div>
                    <div style="min-width:90%; width:50%;margin:0 auto; font-size:1.2em;">
                        <p>Hello!</p>
                        <p>You are receiving this email because we recieved a password reset request for your account.</p>
                        <div class="verify-button" style="position: relative;text-align:center;">
                            <a class="button" href="" style=" background-color: gold;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;margin: 4px 2px;cursor: pointer;">Reset Password</a>
                        </div>
                        <p>If you did not request a password reset, no further action is required.</p>
                        <p>Regards,</p>
                        <p style="color: gold;">Mbaye Team</p>
                        <p>If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser.</p>
                        <a href="" style="position: relative;border:1px solid red;"></a>
                    </div>
                    <div style=""></div>
                </div>
                {{-- <div class="verify-button" style="position: relative;text-align:center;">
                    <a class="button" href="" style=" background-color: gold;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;margin: 4px 2px;cursor: pointer;">Verify Email</a>
                </div> --}}
            </div>
            <div class="footer" style="position: relative;text-align: center;margin: 0 auto;padding-top: 4%;">&#169; 2020 Mbaye All Rights are Reserved</div>
        </div>
    </body>
</html>