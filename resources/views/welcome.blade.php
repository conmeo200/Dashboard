<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="https://www.google.com/recaptcha/api.js?render={{ env('RECAPTCHA_SITE_KEY') }}"></script>


        <script src="/js/BO/jquery.min.js"></script>
        <script src="/js/BO/validateForm.js"></script>
        <link href="/css/app.css" rel="stylesheet">
    </head>
    <body>
            <div id="app"></div>
    </body>
    <script src="{{ mix('/js/app.js') }}"></script>
</html>
