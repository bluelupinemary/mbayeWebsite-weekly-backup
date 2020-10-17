@extends('emails.layouts.app')
@section('before-styles')
{{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=nasalization">
<link href="https://allfont.net/allfont.css?fonts=nasalization-free"
 rel="stylesheet" type="text/css" /> --}}
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
 
    @font-face {
        font-family: Nasalization;
        src: url('{{ asset('fonts/nasalization-rg.tff') }}');
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
                <td align="left" style="color: #888888; width:20px; font-size: 16px; line-height: 24px; font-family: Nasalization">
                    <!-- section text ======-->

                    <p style="line-height: 24px; margin-bottom:15px;padding-left: 5%;padding-right: 5%">
                        Hello!
                    </p>
                    
                    <p style="line-height: 24px; margin-bottom:20px;padding-left: 5%;padding-right: 5%">
                        You are receiving this email because we received a password reset request for your account.
                    </p>
                </td>
            </tr>
            <br/>
                    <tr>
                        <td  align="center" style="width:20px; font-size: 16px; line-height: 24px;">
                           
                            <a href=" {{ $reset_password_url}}" style="color: #ffffff; text-decoration: none;">
                            <input type="button" value="RESET PASSWROD" style="background-color: #ffb240;
                            /* width: 14vw; */
                        
                            /* height: 4vw; */
                            color: white;
                            font-size: 0.9em;
                            font-weight: bold;
                            border: 4px solid #ebfdffa3;
                            padding: 1%;"> 
                            </a>
                        </td>
                        <br/>
                    </tr>
                    <br/>
                    <br/>
                    <tr>
                        <td align="left" style="color: #888888; width:20px; font-size: 16px; line-height: 24px;">
                            <!-- section text ======-->
        
                            <p style="line-height: 24px; margin-bottom:15px;padding-left: 5%;padding-right: 5%">
                                If you did not request a password reset, no further action is required.
                
                            </p>
                        </td>
                    </tr>
                    <br/>
                    <tr>
                        <td align="left" style="color: #888888; width:20px; font-size: 16px; line-height: 24px;">
                            <!-- section text ======-->
        
                            <p style="line-height: 24px; margin-bottom:15px;padding-left: 5%;padding-right: 5%">
                              Regards,
                            </p>
                            <p style="line-height: 24px; margin-bottom:15px;padding-left: 5%;padding-right: 5%;font-size:1.5em;
                            color: #ffc705db;
                            font-family: 'Nasalization' !important;">
                               Mbaye Team
                                </p>

                                <p class="" style="line-height: 24px; margin-bottom:20px;padding-left: 5%;padding-right: 5%;font-size:0.5em">
                                    If you’re having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:
                                </p>
                                <p class="small" style="line-height: 24px; margin-bottom:20px;padding-left: 5%;padding-right: 5%">
                                    <a href="{{ $reset_password_url }}" target="_blank" class="lap"  style="line-height: 24px; margin-bottom:20px;padding-left: 5%;padding-right: 5%;font-size: 0.7vw;;">
                                        {{ $reset_password_url}}
                                    </a>
                                </p>
            
                                {{-- @include('emails.layouts.footer') --}}
                        </td>
                    </tr>
                   
        </table>
    </td>
</div>
@endsection
                        