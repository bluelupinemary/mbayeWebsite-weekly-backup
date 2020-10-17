<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:v="urn:schemas-microsoft-com:vml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    {{-- <meta http-equiv="Content-Security-Policy" content="default-src *; style-src 'self' http://* 'unsafe-inline'; script-src 'self' http://* 'unsafe-inline' 'unsafe-eval'"> --}}
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
    <meta name="viewport" content="width=600,initial-scale = 2.3,user-scalable=no">
    <!--<![if !mso]-->
    <link href='https://fonts.googleapis.com/css?family=Electrolize' rel='stylesheet'>
    <!--<![endif]-->
    @extends('frontend.layouts.app')
    <title>@yield('title', app_name())</title>
    @trixassets
    <style type="text/css">
        body {
            width: 100%;
            margin: 0;
            padding: 0;
            mso-margin-top-alt: 0px;
            mso-margin-bottom-alt: 0px;
            mso-padding-alt: 0px 0px 0px 0px;
            -webkit-font-smoothing: antialiased;
            /* background-color: #495867;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Cg fill-rule='evenodd'%3E%3Cg fill='%23a594c1' fill-opacity='0.4'%3E%3Cpath opacity='.5' d='M96 95h4v1h-4v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9zm-1 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9z'/%3E%3Cpath d='M6 5V0H5v5H0v1h5v94h1V6h94V5H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"); */
            background-image: none !important;
            background-color: black !important;

        }

        p,
        h1,
        h2,
        h3,
        h4 {
            margin-top: 0;
            margin-bottom: 0;
            padding-top: 0;
            padding-bottom: 0;
            font-family: "Electrolize";
        }

        span.preheader {
            display: none;
            font-size: 1px;
        }

        html {
            width: 100%;
        }

        table {
            font-size: 14px;
            border: 0;
            /* padding:10px; */
            width: 100%;
        }

        .lap{
            color: #007bff;
            text-decoration: none;
            background-color: transparent;
        }

        .container{
            margin-top: 25px;
            margin-left: 25px;
            margin-right: 25px;
        }

        .main-header {
            /* color: #343434;  */
            font-size: 24px;
            font-weight: 300;
            line-height: 35px;
            width: 12vw;
            height: 12vw;
            /* background: url(../../front/images/skybox_bg1.jpg); */
            background-repeat: no-repeat;
            background-size: cover;
        }

        .main-header .brand {
            letter-spacing: 6px;
            font-size: 1.6em;
            color: #ecb800;
            line-height: normal;
            font-family: 'Electrolize' !important;
            -webkit-filter: drop-shadow(0px 0px 3px #aebdbfed);
            filter: drop-shadow(0px 0px 3px #aebdbfed);

        }
        @font-face {
                font-family: "Electrolize";
                src: url("../../fonts/nasalization-rg.ttf");
            }

        .main-header .tagline {
            font-size: 16px;
        }

        .small {
            font-size: 10px;
        }

        .center {
            text-align: center;
        }

        .trix-content .attachment--preview .attachment__caption {
            display: none;
        }

        /* ----------- responsivity ----------- */

        @media only screen and (max-width: 640px) {
            /*------ top header ------ */
            .main-header {
                font-size: 20px !important;
            }
            .main-section-header {
                font-size: 28px !important;
            }
            .show {
                display: block !important;
            }
            .hide {
                display: none !important;
            }
            .align-center {
                text-align: center !important;
            }
            .no-bg {
                background: none !important;
            }
                 
            /* ====== divider ====== */
            .divider img {
                width: 440px !important;
            }
            /*-------- container --------*/
            .container590 {
                width: 440px !important;
            }
            .container580 {
                width: 400px !important;
            }
            .main-button {
                width: 220px !important;
            }
            
        }

        @media only screen and (max-width: 479px) {
            /*------ top header ------ */
            .main-header {
                font-size: 18px !important;

            }
            .main-section-header {
                font-size: 26px !important;
            }
            
            /*-------- container --------*/
            
            .container590 {
                width: 273px !important;
            }
            .container580 {
                width: 260px !important;
            }
            .mbaye_logo {
                width: 50vw !important;
            }
            .main-header .brand
            {
                letter-spacing: 2px !important;
                font-size: 1.2em !important;
            }
            .container
            {
                margin-top: 14px !important;
                margin-left: 14px !important;
                margin-right: 14px !important;
            }
        }
    </style>
</head>
<body class="respond" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

    <div class="container">
        <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff" style="width:60%; margin: 0 auto;" class="bg_color">
            <tr>
                <td align="center">
                    <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
                        <tr>
                            <td align="center">
                                <table border="0" width="40" align="center" cellpadding="0" cellspacing="0" bgcolor="eeeeee">
                                    <tr>
                                        <td align="center" style="background-image: url('{{ asset('front/images/skybox_bg1.jpg')}}');"
                                            class="main-header">
                                            <!-- section text ======-->    
                                            <div class="brand">Welcome<br/>
                                                 to the<br/>
                                                  World of Mbaye!</div>
                                        
                                            <div class="tagline">
                                                {{-- {{ app_name() }} --}}
                                            </div>
                                        </td>
                                    </tr>
                                </table>    
                            </td>
                        </tr>
                        <tr>
                            @yield('content')
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td height="40" style="font-size: 40px; line-height: 40px;">&nbsp;</td>
            </tr>
        </table>
    </div>
    <!-- end section -->
</body>
</html>