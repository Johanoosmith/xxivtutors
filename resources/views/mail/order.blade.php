<!DOCTYPE html>
<html lang="en" dir="ltr">  
    <head>  
    <style type="">
        @import url('"https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Tajawal:wght@200;300;400;500;700;800;900&display=swap');   
    </style>
    </head>
    <body>
        <div style="margin: 0; padding: 0;font-family: 'Bebas Neue', sans-serif;">
            <table class="wrapper" style="position: relative ; background-color: #edf2f7 ; margin: 0 ; padding: 0 ; width: 100%;" width="100%" cellspacing="0" cellpadding="0" >
                <tbody>
                    <tr>
                        <td style="position: relative;" align="center">
                            <table class="content" style="position: relative ; margin: 0 ; padding: 0 ; width: 100%;" width="100%" cellspacing="0" cellpadding="0">
                                <tbody>
                                    <tr>
                                        <td class="header" style="position: relative ; padding: 25px 0 ; text-align: center">
                                            <a href="{{route('landingpage')}}" style="position: relative ; color: #3d4852 ; font-size: 19px ; font-weight: bold ; text-decoration: none ; display: inline-block" target="_blank" rel="nofollow">
                                                Test<br>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="body" style="position: relative ; background-color: #edf2f7 ; border-bottom: 1px solid #edf2f7 ; border-top: 1px solid #edf2f7 ; margin: 0 ; padding: 0 ; width: 100%;" width="100%">
                                            <table class="inner-body" style="position: relative ; background-color: #ffffff ; border-color: #e8e5ef ; border-radius: 2px ; border-width: 1px ; box-shadow: 0 2px 0 rgba(0 , 0 , 150 , 0.025) , 2px 4px 0 rgba(0 , 0 , 150 , 0.015) ; margin: 0 auto ; padding: 0 ; width: 570px;" width="570" cellspacing="0" cellpadding="0" align="center">
                                                <tbody>
                                                    <tr>
                                                        <td class="content-cell" style="padding: 32px">                          
                                                            {!! $emailcontent !!}
                                                            <br>                          
                                                            <p>Regards,<br>Test Team</p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table class="footer" style="position: relative ; margin: 0 auto ; padding: 0 ; text-align: center ; width: 570px" width="570" cellspacing="0" cellpadding="0" align="center">
                                                <tbody>
                                                    <tr>
                                                        <td class="content-cell" style="position: relative ; max-width: 100vw ; padding: 32px" align="center">
                                                            <p style="position: relative ; line-height: 1.5em ; margin-top: 0 ; color: #b0adc5 ; font-size: 12px ; text-align: center">© {{date('Y')}} All rights reserved </p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html>