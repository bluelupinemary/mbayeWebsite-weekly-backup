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
                        <p>Hello Major Tom/Thomasina, {{ $name }}</p>
                        <p>Greetings, my friend!</p>
                        <p>We would like to welcome you to the world of Mbaye</p>
                        <p>First you must know that it's really cool and awesome that you joined us in caring.</p>
                        <p>Here, you are Major Tom/Thomasina and you can explore and venture any part of the website.</p>
                        <p>Try to Design Panels, Create Blogs, Communicate, Share ideas and showcase your creativity and your!</p>
                        <p>But, before we launch, please verify your account by clicking the button below.</p>
                        <p>See you in space!</p>
                        <p style="color: gold;">Mbaye Team</p>
                    </div>
                    <div style=""></div>
                </div>
                <div class="verify-button" style="position: relative;text-align:center;">
                    <a class="button" href="{{ $confirmation_url }}" style=" background-color: gold;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;margin: 4px 2px;cursor: pointer;">Verify Email</a>
                </div>
            </div>
            <div class="footer" style="position: relative;text-align: center;margin: 0 auto;padding-top: 4%;">&#169; 2020 Mbaye All Rights are Reserved</div>
        </div>
    </body>
</html>