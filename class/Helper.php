<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once dirname(__FILE__) . '/PHPMailer/src/Exception.php';
require_once dirname(__FILE__) . '/PHPMailer/src/PHPMailer.php';
require_once dirname(__FILE__) . '/PHPMailer/src/SMTP.php';

class Helper
{
    public static function sendEmail($from, $fromName, $to, $toName, $subject, $message, $name, $file = null)
    {

        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;
        //Set PHPMailer to use SMTP.
        $mail->isSMTP();
        //Set SMTP host name                          
        $mail->isSMTP();
        //Set SMTP host name                          
        $config = require __DIR__ . '/mail-config.php';
        $mail->Host = $config['host'];
        //Set this to true if SMTP host requires authentication to send email
        $mail->SMTPAuth = true;
        $mail->Username = $config['username'];
        $mail->Password = $config['password'];
        $mail->SMTPSecure = $config['secure'];
        $mail->Port = $config['port'];

        $mail->From = $from;
        $mail->FromName = $fromName;

        $mail->addAddress($to, $toName);

        if(isset($file) && $file['error'] == UPLOAD_ERR_OK) {
            $pdf_file_tmp = $file['tmp_name'];
            $pdf_file_name = $file['name'];
            $mail->addAttachment($pdf_file_tmp, $pdf_file_name); // Add the uploaded file as attachment
        }

        $mail->isHTML(true);

        $mail->Subject = $subject;

        $body = '<html>';
        $body .= '<body>';
        $body .= '<table width="100%" cellspacing="0" cellpadding="0" border="0"  >';
        $body .= '<tbody>';
        $body .= ' <tr>';
        $body .= '<td align="center">';
        $body .= '<table style="max-width:660px;" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">';
        $body .= '<tbody>';
        $body .= '<tr>';
        $body .= '<td bgcolor="#023982">';
        $body .= '<table width="100%" cellspacing="0" cellpadding="0" border="0">';
        $body .= '<tbody>';
        $body .= '<tr>';
        $body .= '<td>';
        $body .= '<table width="100%" cellspacing="0" cellpadding="0" border="0">';
        $body .= '<tbody>';
        $body .= '<tr>';
        $body .= '<td><h1 style="margin-top:20px;margin-bottom:0px;color: #fff;font-size: 38px;font-family: Arial,Helvetica,sans-serif;letter-spacing: 2px" align="center">LANKA SPECIAL STEELS LIMITED</h1>';
        $body .= '<h2 style="text-align:center;color: #fff;margin: 5px 0px 15px 0px;font-size: 24px;font-family: Arial,Helvetica,sans-serif;letter-spacing: 2px"><span class="il"></span></h2>';
        $body .= '</td>';
        $body .= '</tr>';
        $body .= '</tbody>';
        $body .= '</table>';
        $body .= '</td>';
        $body .= '</tr>';
        $body .= '</tbody>';
        $body .= '</table>';
        $body .= '</td>';
        $body .= '</tr>';
        $body .= '</tbody>';
        $body .= '</table>';

        $body .= '<table style="max-width:660px;border: 1px solid #999;" width="100%" cellspacing="0" cellpadding="0" border="0">';
        $body .= '<tbody>';
        $body .= '<tr>';
        $body .= '<td>';
        $body .= '<table width="100%" cellspacing="0" cellpadding="0" border="0">';
        $body .= '<tbody>';
        $body .= '<tr>';
        $body .= '<td style="color:#6d6e70;font-family:Arial,Helvetica,sans-serif;font-size:16px;font-style:normal;font-weight:500;line-height:28px;padding:10px 40px 5px 40px" align="left">Hi,<span style="color:#023982"><b> ' . $name . ',</b></span></td>';
        $body .= '</tr>';
        $body .= $message;
        $body .= '<tr>';
        $body .= '<td style="color:#000;font-family:Arial,Helvetica,sans-serif;font-size:14px;font-style:normal;font-weight:600;line-height:28px;padding:0px 40px 0px 40px;text-align:justify" align="left"> Best regards,<br/>Team Lanka Special Steels Ltd</td>';
        $body .= '</tr>';
        $body .= '<tr>';
        $body .= '<td style="color:#000;font-family:Arial,Helvetica,sans-serif;font-size:14px;font-style:normal;font-weight:600;line-height:28px;padding:0px 40px 0px 40px;text-align:justify" align="left"> NOTE: Please Do not reply to this email</td>';
        $body .= '</tr>';
        $body .= '<tr>';
        $body .= '<td style="color:#6d6e70;font-family:Arial,Helvetica,sans-serif;font-size:12px;font-style:normal;font-weight:500;line-height:18px;padding:0px 40px 25px 40px" align="left">This email was generated for notification purpose. You are receiving this email because you are contacting us. </td>';
        $body .= '</tr>';
        $body .= '<tr bgcolor="#023982">';
        $body .= '<td   align="center">';
        $body .= '<table style="max-width:660px;margin-bottom: 15px;margin-top: 15px;" width="100%" cellspacing="0" cellpadding="0" border="0">';
        $body .= '<tbody>';
        $body .= '<tr>';
        $body .= '<td style="color:#7f8c8d;font-family:Helvetica,Arial,sans-serif;font-size:12px;line-height:18px;"   align="left">';
        $body .= ' <table cellspacing="0" cellpadding="0" border="0" align="center">';
        $body .= ' <tbody>';
        $body .= '<tr style="padding-bottom:10px;padding-top:10px;color:#fff">';
        $body .= '<td align="center">lankaspecialsteelsltd.com</td>';
        $body .= '</tr>';
        $body .= '<tr  >';
        $body .= '<td style="padding-bottom:10px;padding-top:10px; display:none"> ';
        $body .= '<a style="color:#fff !important" href="https://paidera.com/?utm_source=email_footer&amp;utm_medium=email" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://paidera.com/?utm_source%3Demail_footer%26utm_medium%3Demail&amp;source=gmail&amp;ust=1594794652476000&amp;usg=AFQjCNE2Eeo0vCvm-jZeZYWoOvpn7ANjdw"><span class="il">lankaspecialsteelsltd</span>.com</a> |';
        $body .= '<a style="color:#fff" href="https://paidera.com/dashboard/tickets?utm_source=email_footer&amp;utm_medium=email" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://paidera.com/dashboard/tickets?utm_source%3Demail_footer%26utm_medium%3Demail&amp;source=gmail&amp;ust=1594794652476000&amp;usg=AFQjCNFPDzomxLpw8Kh4TZnvv4CGcN2EfQ">Help &amp; Support</a> |';
        $body .= '<a style="color:#fff" href="https://paidera.com/policy?utm_source=email_footer&amp;utm_medium=email" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://paidera.com/policy?utm_source%3Demail_footer%26utm_medium%3Demail&amp;source=gmail&amp;ust=1594794652476000&amp;usg=AFQjCNF1y6JPOlUk9aAnkMK6fsrNzzJNFA">Privacy Policy</a> |';
        $body .= '<a style="color:#fff"  href="https://t.me/paidera" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://t.me/paidera&amp;source=gmail&amp;ust=1594794652476000&amp;usg=AFQjCNHFn1rQKnJdlBmETqBK7L9vOkKzAw">Term and Conditions</a>';
        $body .= '</td>';
        $body .= '</tr>';
        $body .= ' </tbody>';
        $body .= '</table>';
        $body .= '</td>';
        $body .= '</tr>';
        $body .= '</tbody>';
        $body .= '</table>';
        $body .= '</td>';
        $body .= '</tr>';
        $body .= '</tbody>';
        $body .= '</table>';
        $body .= '</td> ';
        $body .= '</tr>';
        $body .= ' </tbody>';
        $body .= '</table>  ';
        $body .= '</td>';
        $body .= '</tr>';
        $body .= '</tbody>';
        $body .= '</table><div class="yj6qo"></div><div class="adL">';
        $body .= '</div>';

        $body .= '</body>';
        $body .= '</html>';




        $mail->Body = $body;
        $mail->AltBody = $message;

        try {
            if ($mail->send()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
    }
}
