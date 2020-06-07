<?php
require_once 'wp-load.php';

$siteUrl = site_url();
//Hejhej!

/****** INSTALLATION ******/
// Lägg denna fil samt bilden mail_social_sprite.png i rooten i din WordPress installation
// Se även filen smtp_wp_mailer-instruktioner.txt

/****** CAPTCHA ******/
// REGISTER SITE AT https://www.google.com/recaptcha/
//$secret = '';
// Lägg till ett recaptcha() anrop i if-satsen där du validerar de olika fälten.

// Content Type - Ändra ifall det inte ska vara HTML 
function emailContentType($contentType) { return 'text/html'; }
add_filter('wp_mail_content_type', 'emailContentType');

// From - Ändra till epostadressen det ska stå att mejlet kommer ifrån
function emailFrom($from) { return 'wp@noboxsolutions.se'; }
add_filter('wp_mail_from', 'emailFrom');

// From Name - Ändra till namnet det ska stå att mejlet kommer ifrån
function emailFromName($from) { return 'Noboxsolutions'; }
add_filter('wp_mail_from_name', 'emailFromName');

/* /kontakt - Kontaktformulär */
if (isset($_GET['contact'])) {
    $fromUrl = $_POST['url'];

    if (stristr($_SERVER['HTTP_REFERER'], $siteUrl) &&
        validate($_POST['fornamn']) &&
        validate($_POST['efternamn']) &&
        validate($_POST['email'], 'email') &&
        validate($_POST['telefon']) &&
        validate($_POST['meddelande']) &&
        recaptcha()) {

        $fornamn    = $_POST['fornamn'];
        $efternamn  = $_POST['efternamn'];
        $telefon    = $_POST['telefon'];
        $email      = $_POST['email'];
        $meddelande = nl2br($_POST['meddelande']);

        // TITLE IN MAIL
        $subject = 'Meddelande från ' . $fornamn;

        // SHORT EXCERPT VIEWED IN EG. GMAIL
        $excerpt = 'Meddelande från ' . $fornamn;

        // MAIN MESSAGE IN MAIL
        $message = '<h1 style="font-size:24px;line-height:30px;margin:0 0 0;">' . $subject . '</h1>
        <strong>Namn: </strong>' . $fornamn . ' ' . $efternamn . '<br />
        <strong>E-post: </strong>' . $email . '<br />
        <strong>Telefon: </strong>' . $telefon . '<br /><br />
        <strong>Meddelande:</strong><br/>' . $meddelande . '<br />';

        $mailBody = createContactMail($subject, $message, $excerpt);

        wp_mail('wp@noboxsolutions.se', $subject, $mailBody);

        finish($fromUrl . '?success');
    } else {
        finish($fromUrl . '?failed');
    }
}

// Direct access fallback
header( "Location: $siteUrl" );
exit;

// Mejl funktioner
// ---------------
// Dessa bestämmer hur meljen ska se ut. Skapa en för varje mejltyp som ska skickas.

// Kontaktmejl
function createContactMail($subject, $message, $excerpt)
{
    ob_start();
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldnt be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <title><?= $subject ?></title> <!-- the <title> tag shows on email notifications on Android 4.4. -->
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgcolor="#f4f4f4" style="margin:20px 0; padding:0; -webkit-text-size-adjust:none; -ms-text-size-adjust:none;">
    <table cellpadding="0" cellspacing="0" border="0" height="100%" width="100%" bgcolor="#f4f4f4" id="bodyTable" style="border-collapse: collapse;table-layout: fixed;margin:0 auto;">
        <tr>
            <td>
                <!-- Hidden Preheader Text : BEGIN -->
                <div style="display:none; visibility:hidden; opacity:0; color:transparent; height:0; width:0;line-height:0; overflow:hidden;mso-hide: all;">
                    <?= $excerpt ?>
                </div>
                <!-- Hidden Preheader Text : END -->

                <!-- Outlook and Lotus Notes dont support max-width but are always on desktop, so we can enforce a wide, fixed width view. -->
                <!-- Beginning of Outlook-specific wrapper : BEGIN -->
                <!--[if (gte mso 9)|(IE)]>
                <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td>
                <![endif]-->
                <!-- Beginning of Outlook-specific wrapper : END -->

                <!-- Email wrapper : BEGIN -->
                <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" style="max-width: 600px;margin: auto;" class="email-container">

                    <tr>
                        <td style="text-align:left;padding:20px 40px;font-family:sans-serif;font-size:16px;line-height:24px;color:#fff;background:#222"></td>
                    </tr>

                    <tr>
                        <td>
                            <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
                                <!-- Full Width, Fluid Column : BEGIN -->
                                <tr>
                                    <td style="padding: 40px; font-family: sans-serif; font-size: 16px; line-height: 24px; color: #666666;">
                                        <?= $message ?>
                                    </td>
                                </tr>
                                <!-- Full Width, Fluid Column : END -->
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align:center;padding:20px 40px;font-family:sans-serif;font-size:12px;line-height:18px;color:#fff;background:#222;border-top:4px solid #222;">
                            <table border="0" width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:20px;">
                                <tr>
                                    <td style="width:50%;padding:0 10px 0 0;text-align:left;vertical-align:top;">
                                        <div style="display:block;width:100%;margin-bottom:15px;"></div>
                                    </td>
                                    <td style="width:50%;padding:0 0 0 10px;text-align:left;color:#fff;"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align:center;padding:10px 0;font-family:sans-serif;font-size:12px;line-height:18px;color:#444;background:transparent;"></td>
                    </tr>

                </table>
                <!-- Email wrapper : END -->

                <!-- End of Outlook-specific wrapper : BEGIN -->
                <!--[if (gte mso 9)|(IE)]>
                        </td>
                    </tr>
                </table>
                <![endif]-->
                <!-- End of Outlook-specific wrapper : END -->

            </td>
        </tr>
    </table>
</body>
</html>
<?php
    $body = ob_get_clean();
    return $body;
}

// Övriga funktioner
// -----------------
// Dessa behövs i regel aldrig ändras på.

function finish($callbackUrl)
{
    remove_filter('wp_mail_content_type', 'emailContentType');
    remove_filter('wp_mail_from', 'emailFrom');
    remove_filter('wp_mail_from_name', 'emailFromName');

    header("Location: $callbackUrl");
    exit;
}

function validate($contents, $fieldType = null)
{
    return (!empty($contents) && isSpamFree($contents) && validateField($contents, $fieldType));
}

function isSpamFree($search)
{
    $strings_to_search = array('href=', '[/url');

    foreach ($strings_to_search as $needle) {
        if (stristr($search, $needle)) {
            return false;
        }
    }

    return true;
}

function validateField($contents, $fieldType)
{
    if ($fieldType === 'email') {
        return filter_var($contents, FILTER_VALIDATE_EMAIL);
    }

    return true;
}

function recaptcha()
{
    global $secret;

    if (!isset($_POST['g-recaptcha-response'])) {
        return false;
    }

    $captchaResponse = $_POST['g-recaptcha-response'];

    $verificationUrl = 'https://www.google.com/recaptcha/api/siteverify';
    $body = [
        'secret' => $secret,
        'response' => $captchaResponse,
        'remoteip' => $_SERVER['REMOTE_ADDR']
    ];

    $response = wp_remote_post($verificationUrl, [
        'body' => $body,
    ]);

    $body = wp_remote_retrieve_body($response);
    $obj = json_decode($body);

    return $obj->success;
}