<!DOCTYPE html>
<html lang="en">

<head>
    <title>Jquery Ajax - PHP (with cross origin support)</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="scripts.js" type="text/javascript"></script>
</head>

<body>

    <div class="container form_holder">

        <center><h1>Jquery Ajax - PHP (with cross origin support)</h1></center>

        <form id="register">

            <div class="form-group" id="first_name_group">
                <label for="first_name">First Name:</label>
                <input type="text" class="form-control" id="first_name" name="first_name">
            </div>

            <div class="form-group" id="last_name_group">
                <label for="last_name">Last Name:</label>
                <input type="text" class="form-control" id="last_name" name="last_name">
            </div>

            <div class="form-group" id="email_group">
                <label for="email">Email address:</label>
                <input type="email" class="form-control" id="email">
            </div>

            <div class="form-group" id="zip_group">
                <label for="zip">Zip:</label>
                <input type="tel" class="form-control" id="zip" name="zip">
            </div>

            <div class="form-group" id="phone_group">
                <label for="phone">Phone:</label>
                <input type="tel" class="form-control" id="phone" name="phone">
            </div>

            <div class="checkbox form-group" id="age_group">
                <label>
                    <input type="checkbox" id="age">I am over 18.
                </label>
            </div>

            <!-- Change this as needed (the current one works on localhost) -->
            <div class="form-group" id="recaptcha_group">
              <div class="g-recaptcha" data-sitekey="6LcEHG8UAAAAAF2_E-TGWEJdNyy7qEdduAgazqKG"></div>
            </div>

            <button type="submit" class="btn btn-default">Submit</button>

        </form>

    </div>

</body>

</html>