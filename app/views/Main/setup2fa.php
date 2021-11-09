<html>
    <head>
    <title>2-Factor Authentication Setup</title>
    </head>
    <body>
       <img src='<?= BASE ?>/Main/makeQRCode?data=<?= $data ?>' />
        <p>Please scan the QR-code on the screen with your favorite
        Authenticator software, such as Google Authenticator. The
        authenticator software will generate codes that are valid for 30
        seconds only. Enter such a code while and submit it while it is
        still valid to confirm that the 2-factor authentication can be
        applied to your account.</p>
        <form method="post" action="">
            <label>Current code:<input type="text" name="currentCode"
            /></label>
            <input type="submit" name="action" value="Verify code" />
        </form>
    </body>
</html>
