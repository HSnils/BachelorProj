<!DOCTYPE html>
<html>
<head>
    <title>Verify e-mail</title>
</head>
 
<body>
<!-- Mofified template from: https://reallygoodemails.com/wp-content/uploads/welcome-you-re-all-set.html-->

  <style type="text/css">
    .apple-footer a {
        text-decoration: none !important;
        color: #999999 !important;
        border: none !important;
      }
      .apple-email a {
        text-decoration: none !important;
        color: #448BFF !important;
        border: none !important;
      }
  </style>
  <div id="wrapper" style="background-color:#ffffff; margin:0 auto; text-align:center; width:100%" bgcolor="#ffffff" align="center" width="100%">
    <table class="main-table" align="center" style="-premailer-cellpadding:0; -premailer-cellspacing:0; background-color:#ffffff; border:0; margin:0 auto; max-width:480px; mso-table-lspace:0; mso-table-rspace:0; padding:0; text-align:center; width:480" cellpadding="0"
      cellspacing="0" bgcolor="#ffffff" width="480">

      <tbody>
        <tr>
          <td class="spacer-lg" style="-premailer-height:75; -premailer-width:100%; line-height:30px; margin:0 auto; padding:0" height="75" width="100%">&nbsp;</td>
        </tr>
        <tr>
          <td class="logo" align="center" style="background-color:#ffffff; text-align:center; width:480" bgcolor="#ffffff" width="480">
            <a href="https://www.ntnu.no/" target="_blank"><img src="{asset('images/ntnu_logo.png')}}" width="40%" title="NTNU" alt="NTNU"></a>
          </td>
        </tr>
        <tr>
          <td class="spacer-lg" style="-premailer-height:75; -premailer-width:100%; line-height:30px; margin:0 auto; padding:0" height="75" width="100%">&nbsp;</td>
        </tr>
        <tr>
          <td class="spacer-lg" style="-premailer-height:75; -premailer-width:100%; line-height:30px; margin:0 auto; padding:0" height="75" width="100%">&nbsp;</td>
        </tr>

        <tr>
          <td>

          </td>
        </tr>
        <tr>
          <td class="headline" style="color:#444444; font-family:&quot;Roboto&quot;, Helvetica, Arial, san-serif; font-size:30px; font-weight:100; line-height:36px; margin:0 auto; padding:0; text-align:center" align="center">Thanks for signing up {{ $user['name'] }}.</td>
        </tr>
        <tr>
          <td class="spacer-sm" style="-premailer-height:20; -premailer-width:100%; line-height:10px; margin:0 auto; padding:0" height="20" width="100%">&nbsp;</td>
        </tr>
        <tr>
          <td class="copy" style="color:#666666; font-family:&quot;Roboto&quot;, Helvetica, Arial, san-serif; font-size:18px; line-height:30px; text-align:center" align="center">
              <br/>
        	        Your registered email-id is {{ $user['email'] }} , Please click on the below link to verify your email account
	          <br/>
                <br>
            <a href="{{ url('user/verify', $user->verifyUser->token) }}" style="text-decoration: none; text-align: center; font-family:&quot;Roboto&quot;, Helvetica, Arial, san-serif; font-size:20px;">Verify e-mail</a> </td>
        </tr>
        


        <tr>
          <td class="spacer-lg" style="-premailer-height:75; -premailer-width:100%; line-height:30px; margin:0 auto; padding:0" height="75" width="100%">&nbsp;</td>
        </tr>
        <tr>
          <td class="spacer-lg" style="-premailer-height:75; -premailer-width:100%; line-height:30px; margin:0 auto; padding:0" height="75" width="100%">&nbsp;</td>
        </tr>
        <tr>
          <td>
            <table class="footer-table" style="-premailer-width:480; background-color:#ececec; margin:0 auto; text-align:center" width="480" bgcolor="#ececec" align="center">
              <tbody>
                <tr>
                  <td class="spacer-sm" style="-premailer-height:20; -premailer-width:100%; line-height:10px; margin:0 auto; padding:0" height="20" width="100%">&nbsp;</td>
                </tr>
                <tr>
                  <td class="spacer-sm" style="-premailer-height:20; -premailer-width:100%; line-height:10px; margin:0 auto; padding:0" height="20" width="100%">&nbsp;</td>
                </tr>
                <tr>
                  <td>
                    <a href="http://colourlab.no" target="_blank"><img src="{asset('images/Colourlab.png')}}" width="90%" alt="NTNU ColourLab" title="NTNU ColourLab"></a>
                  </td>
                </tr>
                <tr>
                  <td class="spacer-sm" style="-premailer-height:20; -premailer-width:100%; line-height:10px; margin:0 auto; padding:0" height="20" width="100%">&nbsp;</td>
                </tr>
                <tr>
                  <td class="border-line" style="-premailer-height:1px; -premailer-width:480; background-color:#e5e5e5; font-size:1px; line-height:1px; margin:0; padding:0" height="1px" width="480" bgcolor="#e5e5e5">&nbsp;</td>
                </tr>
                <tr>
                  <td class="spacer-sm" style="-premailer-height:20; -premailer-width:100%; line-height:10px; margin:0 auto; padding:0" height="20" width="100%">&nbsp;</td>
                </tr>
                <tr>
                  <td>
                    <table class="footer-content" align="center" style="-premailer-width:420; margin:0 auto; padding:0; text-align:center" width="420">
                      <tbody>
                        <tr>
                          <td class="footer-text" style="-webkit-text-size-adjust:100%; color:#999999; font-family:&quot;Roboto&quot;, Helvetica, Arial, san-serif; font-size:10px; line-height:16px; text-align:center" align="center">

                            The Norwegian Colour and Visual Computing Laboratory, Department of Computer Science and Media Technology, NTNU in Gjøvik, Teknologivegen 22, N-2815 Gjøvik.
                            <br><br> This email was sent to <span class="apple-email"><a style="border:none; color:#448bff; text-decoration:none" target="_blank">{{ $user['email'] }}</a></span>
                          </td>

                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td class="spacer-sm" style="-premailer-height:20; -premailer-width:100%; line-height:10px; margin:0 auto; padding:0" height="20" width="100%">&nbsp;</td>
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