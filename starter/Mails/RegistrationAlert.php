<?php

namespace Mails\RegistrationAlert;

require 'vendor/autoload.php';
/** API Model For Mails
 *  Version 1.0.0
 *  March 2024
 *--------------------------------------------------------------------
 *  Mails Configuration
 *---------------------------------------------------------------------
**/

//Required Files
use Config\Mailer;
//require_once './Config/Mailer.php';

class RegistrationAlert
{



    //Mail to register new user account
    public function newmember_alert($data, $coyInfo)
    {
        $sendMail = new Mailer();

        //Send Email TO User    
        $sendMail->to = $data['email'];
        $sendMail->from = getenv('APP_NAME');
        $sendMail->replyto = getenv('APP_EMAIL');
        $sendMail->subject = 'Member Registration Details';
        // To send HTML mail, the Content-type header must be set
        $sendMail->message_body = '
            <html>
                <body>
                <head>
                     <img src="'.rtrim(getenv('MAIN_APP_URL')).'Images/Logo/favicon.png" alt="Logo" border="0"  style="margin: 20px; width:70px; height: 90px;"> 
                </head>

                <h3 style="margin: 10px; text-align: center;">Member Registration Details On '.getenv('APP_NAME').'</h3>
                <h3 style="margin: 10px;"><img src="'.rtrim(getenv('MAIN_APP_URL')).'Images/Body/network.png" alt="Banner" border="0" width="100%"> </h3>
                <p style="margin: 10px; font-size: 16px;">
                Hello '.$data['username'].',
                <br>
                Welcome To '.getenv('APP_NAME').'
                <br><br>
                Your Registration Is Almost Completed, All You Need To Do Now Is <a href="'.rtrim(getenv('MAIN_APP_URL')).'verify-email/?u='.$data['uniqueid'].'&h='.$data['hash'].'">Click This Link </a> Or Copy The Link Below Into A Browser To Confirm Your Account.
                <br><br>
                '.rtrim(getenv('MAIN_APP_URL')).'verify-email/?u='.$data['uniqueid'].'&h='.$data['hash'].'
                <br><br>  
                Your Membership Information Are 
                <br><br> 
                Membership ID: '.$data['uniqueid'].'
                <br>
                Username: '.$data['username'].' 
                <br>
                Email ID: '.$data['email'].'
                <br>  
                Password: '.$data['password'].'
                <br><br> 
                Keep These Information Secure. If you ever feel your password has been compromised, Reset it immediately and dont forget to turn on the 2FA system on your dashboard. 
                <br><br>
                Warm Regards!
                <br>
                Customer Relationship Team
                <br>
                '.getenv('APP_NAME').'
                <br><br> 
                <i style="font-size: 12px; color: darkred;">If You Found This Email In Your Spam Or Junk Folder, Move To Inbox Or Mark As Not Spam For Future Notifications.</i>
                </p>

                <p style="font-size: 11px; text-align: left; padding: 10px;">
                    Learn More About Us:
                    <br>
                     <a href="'.rtrim(getenv('MAIN_APP_URL')).'earn-money/" target="_blank" title="Earn Money">Earn Money</a> | <a href="'.rtrim(getenv('MAIN_APP_URL')).'index/#how-it-works" target="_blank" title="How It Works">How It Works</a> | <a href="'.rtrim(getenv('MAIN_APP_URL')).'post-task/" target="_blank" title="Post Task">Post a Task</a> | <a href="'.rtrim(getenv('MAIN_APP_URL')).'unsubscribe/" target="_blank" title="Unsubscribe">Unsubscribe</a> | 
                    <br><br> 
                     This message is intended for '.$data['email'].', you are receiving this message because you are using one or more of '.getenv('APP_NAME').' service. 

                    <br><br> 

                     Share Your '.getenv('APP_NAME').' Experience By Following Us On Social Media!
                     
                    <br> 
                    <center style="font-size: 12px;>
                        <a href="https://facebook.com/'.$coyInfo['facebook'].'" target="_blank" title="Facebook"><img src="'.rtrim(getenv('MAIN_APP_URL')).'Images/facebook.png" alt="Facebook" border="0"  style="padding-right: 20px; width:20px; height: 20px;"></a>

                       <a href="https://instagram.com/'.$coyInfo['instagram'].'" target="_blank" title="Instagram" class="instagram"><img src="'.rtrim(getenv('MAIN_APP_URL')).'Images/instagram.png" alt="Instagram" border="0"  style="padding-right: 20px; width:20px; height: 20px;"></a>

                       <a href="https://linkedin.com/'.$coyInfo['linkedin'].'" target="_blank" title="Linkedin"><img src="'.rtrim(getenv('MAIN_APP_URL')).'Images/linkedin.png" alt="LinkedIn" border="0"  style="padding-right: 20px; width:20px; height: 20px;"></a>

                       <a href="https://twitter.com/'.$coyInfo['twitter'].'" target="_blank" title="twitter"><img src="'.rtrim(getenv('MAIN_APP_URL')).'Images/twitter.png" alt="Twitter" border="0"  style="padding-right: 20px; width:20px; height: 20px;"></a>

                       <br><br> 
                        '.$coyInfo['address'].'

                        <br><br> 
                        &copy; Copyright '.date("Y").' '.getenv('APP_NAME').' All Rights Reserved. | <a href="'.rtrim(getenv('MAIN_APP_URL')).'unsubscribe/" target="_blank" title="Unsubscribe">Unsubscribe</a> | <a href="'.rtrim(getenv('MAIN_APP_URL')).'privacy-policy/" target="_blank" title="Privacy Policy">Privacy Policy</a> | <a href="'.rtrim(getenv('MAIN_APP_URL')).'terms-of-service/" target="_blank" title="Terms Of Service">Terms Of Service</a> | 
                    </center>

                    <br>
                </p>

                </body>
            </html>
            ';

        $sendMail->send();
    }









    //Mail to Verify new user account
    public function verification_alert($data, $coyInfo)
    {
        $sendMail = new Mailer();

        //Send Email TO User    
        $sendMail->to = $data['email'];
        $sendMail->from = getenv('APP_NAME');
        $sendMail->replyto = getenv('APP_EMAIL');
        $sendMail->subject = 'Account Confirmation';
        // To send HTML mail, the Content-type header must be set
        $sendMail->message_body = '
            <html>
                <body>
                <head>
                    <img src="'.rtrim(getenv('MAIN_APP_URL')).'Images/Logo/favicon.png" alt="Logo" border="0"  style="margin: 20px; width:70px; height: 90px;"> 
                </head>

                <h3 style="margin: 10px; text-align: center;">Account Confirmation  On '.getenv('APP_NAME').'</h3>
                <h3 style="margin: 10px;"><img src="'.rtrim(getenv('MAIN_APP_URL')).'Images/Body/network.png" alt="Banner" border="0" width="100%"> </h3>
                <p style="margin: 10px; font-size: 16px;">
                Hello '.$data['username'].',
                <br><br>
                Your Email Has Been Confirmed And Account Verified. 
                <br><br>
                Enjoy Full Membership Freebies As You Go.
                <br><br>
                Warm Regards!
                <br>
                Customer Relationship Team
                <br>
                '.getenv('APP_NAME').'
                <br><br> 
                <i style="font-size: 12px; color: darkred;">If You Found This Email In Your Spam Or Junk Folder, Move To Inbox Or Mark As Not Spam For Future Notifications.</i>
                </p>

                <p style="font-size: 11px; text-align: left; padding: 10px;">
                    Learn More About Us:
                    <br>
                    <a href="'.rtrim(getenv('MAIN_APP_URL')).'earn-money/" target="_blank" title="Earn Money">Earn Money</a> | <a href="'.rtrim(getenv('MAIN_APP_URL')).'index/#how-it-works" target="_blank" title="How It Works">How It Works</a> | <a href="'.rtrim(getenv('MAIN_APP_URL')).'post-task/" target="_blank" title="Post Task">Post a Task</a> | <a href="'.rtrim(getenv('MAIN_APP_URL')).'unsubscribe/" target="_blank" title="Unsubscribe">Unsubscribe</a> | 
                    <br><br> 
                    This message is intended for '.$data['email'].', you are receiving this message because you are using one or more of '.getenv('APP_NAME').' service. 

                    <br><br> 

                    Share Your '.getenv('APP_NAME').' Experience By Following Us On Social Media!
                    
                    <br> 
                    <center style="font-size: 12px;>
                        <a href="https://facebook.com/'.$coyInfo['facebook'].'" target="_blank" title="Facebook"><img src="'.rtrim(getenv('MAIN_APP_URL')).'Images/facebook.png" alt="Facebook" border="0"  style="padding-right: 20px; width:20px; height: 20px;"></a>

                    <a href="https://instagram.com/'.$coyInfo['instagram'].'" target="_blank" title="Instagram" class="instagram"><img src="'.rtrim(getenv('MAIN_APP_URL')).'Images/instagram.png" alt="Instagram" border="0"  style="padding-right: 20px; width:20px; height: 20px;"></a>

                    <a href="https://linkedin.com/'.$coyInfo['linkedin'].'" target="_blank" title="Linkedin"><img src="'.rtrim(getenv('MAIN_APP_URL')).'Images/linkedin.png" alt="LinkedIn" border="0"  style="padding-right: 20px; width:20px; height: 20px;"></a>

                    <a href="https://twitter.com/'.$coyInfo['twitter'].'" target="_blank" title="twitter"><img src="'.rtrim(getenv('MAIN_APP_URL')).'Images/twitter.png" alt="Twitter" border="0"  style="padding-right: 20px; width:20px; height: 20px;"></a>

                    <br><br> 
                        '.$coyInfo['address'].'

                        <br><br> 
                        &copy; Copyright '.date("Y").' '.getenv('APP_NAME').' All Rights Reserved. | <a href="'.rtrim(getenv('MAIN_APP_URL')).'unsubscribe/" target="_blank" title="Unsubscribe">Unsubscribe</a> | <a href="'.rtrim(getenv('MAIN_APP_URL')).'privacy-policy/" target="_blank" title="Privacy Policy">Privacy Policy</a> | <a href="'.rtrim(getenv('MAIN_APP_URL')).'terms-of-service/" target="_blank" title="Terms Of Service">Terms Of Service</a> | 
                    </center>

                    <br>
                </p>

                </body>
            </html>
            ';

        $sendMail->send();
    }











































    




    /*

        ******* 

        End oF file 

        ********

    */



}