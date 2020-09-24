@extends('emails.layouts.app')
@section('before-styles')

<style>
 .heading{
     background-image: url("skybox.png");
     border:2px solid white;
     height: 10vw;
     width: 10vw;
     display: flex;
 }  
 .mbaye_logo{
            width: 13vw;
          
 }
</style>
@endsection


@section('content')
<div class="content" style="display:none">
    <td align="left">
        <table border="0" width="80%" align="center" cellpadding="0" cellspacing="0" class="container590">
            <tr>
                
                <td align="center"  style="color: #888888; width:20px; font-size: 16px; line-height: 24px;">
                    <img  class="mbaye_logo" src="{{ asset('front/icons/alert-icon.png') }}" />

                </td>
            </tr>
            <tr>

                <td align="left" style="color: #888888; width:20px; font-size: 16px; line-height: 24px;">
                    <!-- section text ======-->

                    <p style="line-height: 24px; margin-bottom:15px;padding-left: 5%;padding-right: 5%">
                        Hello Major Tom/Thomasina,
                    </p>
                    <p style="line-height: 24px; margin-bottom:15px;padding-left: 5%;padding-right: 5%">
                        Greetings my friend!
                    </p>
                    <p style="line-height: 24px; margin-bottom:15px;padding-left: 5%;padding-right: 5%">
                        We would like you to invite you to the world of Mbaye!
                    </p>

                    <p style="line-height: 24px; margin-bottom:15px;padding-left: 5%;padding-right: 5%">
                        First, you must know that it's really cool and awesome that you joined us in caring.
                    </p>

                    <p style="line-height: 24px; margin-bottom:15px;padding-left: 5%;padding-right: 5%">
                        Here, you are Major Tom/Thomasina and you can explore and venture any part of the website.
                    </p>

                    <p style="line-height: 24px; margin-bottom:15px;padding-left: 5%;padding-right: 5%">
                      Try to Design panels, Create Blogs, Communicate, Share Ideas and Showcase your creativity and your care!
                    </p>

                    <p style="line-height: 24px; margin-bottom:15px;padding-left: 5%;padding-right: 5%">
                      But, Before we launch, please verify your account by clicking the button below 
                    </p>

                    <p style="line-height: 24px; margin-bottom:15px;padding-left: 5%;padding-right: 5%">
                    See you in space!
                    </p>

                    <p style="line-height: 24px; margin-bottom:15px;padding-left: 5%;padding-right: 5%;font-size:1.5em;
                    color: #ffc705db;
                    font-family: 'Nasalization' !important;">
                       Mbaye Team
                        </p>
                </td>
            </tr>
            <tr>
                <td  align="center" style="width:20px; font-size: 16px; line-height: 24px;">
               
                    <a href="{{ $confirmation_url }}" style="color: #ffffff; text-decoration: none;">
                    <input type="button" value="VERIFY EMAIL" style="background-color: #ffb240;
                    width: 10vw;
                    height: 3vw;
                    color: white;
                    font-size: 1vw;
                    font-weight: bold;
                    border: 4px solid #ebfdffa3;"> 
                    </a>
                </td>
            </tr>
            <br/>
            <tr>
                <td  align="center" style="width:20px; font-size: 16px; line-height: 60px;">
                   
            <p class="small center" style="line-height: 60px; margin-bottom: 20px;">
                ©2020 Mbaye All Rights are Reserved.
            </p>
        </td>
    </tr>

                        <tr>
                            <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                        </tr>

               
                    <br/>
                    {{-- @include('emails.layouts.footer') --}}
                </td>
            </tr>
        </table>
    </td>
</div>
@endsection
                        