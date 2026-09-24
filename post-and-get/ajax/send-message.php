<?php
include '../../class/Helper.php';

// Escape visitor input before it is placed into the HTML email bodies.
$_POST = array_map(fn($v) => is_string($v) ? htmlspecialchars(trim($v), ENT_QUOTES, 'UTF-8') : $v, $_POST);
$company_subject = "You Have An Enquiry.";
$visitor_subject = "Thank You For Your Enquiry.";

$company_mail_body = '<tr>';
$company_mail_body .= '<td  style="color:#6d6e70;font-family:Arial,Helvetica,sans-serif;font-size:14px;font-style:normal;font-weight:500;line-height:22px;padding:0px 40px 20px 40px;text-align:justify" align="left">We are delighted to inform you that a customer has enquire about your services through the website. The details of your enquiry are shown below.';
$company_mail_body .= '</td>';
$company_mail_body .= '</tr>';
$company_mail_body .= '<tr>';
$company_mail_body .= '<td style="color:#000;font-family:Arial,Helvetica,sans-serif;font-size:15px;font-style:normal;font-weight:500;line-height:22px;padding:0px 40px 20px 40px;text-align:justify" align="left">';
$company_mail_body .= '<hr>';
$company_mail_body .= '<p>Name: ' . $_POST['name'] . '  </p> ';
$company_mail_body .= '<p>Email: ' . $_POST['email'] . '  </p>';
$company_mail_body .= '<p>Phone: ' . $_POST['phone'] . '  </p>';
if (!empty($_POST['product'])) $company_mail_body .= '<p>Product: ' . $_POST['product'] . '  </p>';
// $company_mail_body .= '<p>Organization: ' . $_POST['organization'] . '  </p>';
$company_mail_body .= '<hr>';
$company_mail_body .= '<p>Message: ' . $_POST['message'] . '  </p>';
$company_mail_body .= '<hr>';
$company_mail_body .= '</td>';
$company_mail_body .= '</tr>';

$visitor_mail_body = '<tr>';
$visitor_mail_body .= '<td  style="color:#6d6e70;font-family:Arial,Helvetica,sans-serif;font-size:14px;font-style:normal;font-weight:500;line-height:22px;padding:0px 40px 20px 40px;text-align:justify" align="left">Hello, and thank you for your enquiry. Your enquiry has been sent to LANKA SPECIAL STEELS LIMITED and one of representative will be contact you shortly. ';
$visitor_mail_body .= '<br> <span style="color:#000;font-family:Arial,Helvetica,sans-serif;font-size:14px;font-style:normal;font-weight:600;line-height:28px; text-align:justify">The details of your enquiry are shown below.</span></td>';
$visitor_mail_body .= '</tr>';
$visitor_mail_body .= '<tr>';
$visitor_mail_body .= '<td style="color:#000;font-family:Arial,Helvetica,sans-serif;font-size:15px;font-style:normal;font-weight:500;line-height:22px;padding:0px 40px 20px 40px;text-align:justify" align="left">';
$visitor_mail_body .= '<hr>';
$visitor_mail_body .= '<p>Name: ' . $_POST['name'] . '  </p> ';
$visitor_mail_body .= '<p>Email: ' . $_POST['email'] . '  </p>';
$visitor_mail_body .= '<p>Phone: ' . $_POST['phone'] . '  </p>';
// $visitor_mail_body .= '<p>Organization: ' . $_POST['organization'] . '  </p>';
$visitor_mail_body .= '<hr>';
$visitor_mail_body .= '<p>Message: ' . $_POST['message'] . '  </p>';
$visitor_mail_body .= '<hr>';
$visitor_mail_body .= '</td>';
$visitor_mail_body .= '</tr>';


$HELPER = new Helper(null);
$company_mail = $HELPER->sendEmail('noreply@onespencer.co.uk', 'LANKA SPECIAL STEELS LIMITED', 'noreply@onespencer.co.uk', 'LANKA SPECIAL STEELS LIMITED', $company_subject, $company_mail_body, 'LANKA SPECIAL STEELS LIMITED');
$visitor_mail = $HELPER->sendEmail('noreply@onespencer.co.uk', 'LANKA SPECIAL STEELS LIMITED', $_POST['email'], $_POST['name'], $visitor_subject, $visitor_mail_body, $_POST['name']);

$result = ["status" => 'success'];
echo json_encode($result);
exit();
