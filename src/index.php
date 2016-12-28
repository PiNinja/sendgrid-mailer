<?php
/* Logic side

if(!empty($_POST['action'])){
//Check for required fields

}
require 'vendor/autoload.php';
require 'lib/SendGrid.php';
*/
?>

<html>
  <head>
    <meta charset="utf-8">
    <title>PiNinja, sendgrid mailer</title>
    <meta property="og:title" content="PiNinja, sendgrid mailer" />
    <meta property="og:image" content="https://3.14159.ninja/pininja.jpg" />
    <link rel="canonical" href="https://sendgrid.14159.ninja/" />
    <meta property="og:url" content="https://sendgrid.14159.ninja/" />
    <meta property="og:site_name" content="PiNinja"/>
    <meta name="og:description" content="Quick & dirty email sender using sendgrid.com">
    <meta name="description" content="Quick & dirty email sender using sendgrid.com">
    <meta property="og:locale" content="en_CA" />
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <link href="/side/style.css" rel="stylesheet" type="text/css" />
    <link rel="icon" type="image/png" href="https://3.14159.ninja/favicon.png" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha256-/SIrNqv8h6QGKDuNoLGA4iret+kyesCkHGzVUUV0shc=" crossorigin="anonymous"></script>
  </head>
  <body>
    <header class="padded wrapper">
      SendGrid mailer
    </header>
    <main class="padded wrapper">
      <form class="" action="/" method="post">
        <h1>General settings : </h1>
        <p class="inputSection">
            <label for="APIkey">SendGrid API Key : </label>
            <input type="text" name="APIKey" id="APIKey" value="" placeholder="hwacwaWADSrndYAODJWC8HA (required)">
        </p>
        <p class="inputSection">
            <label for="templateId">Template ID : </label>
            <input type="text" name="templateId" id="templateId" value="" placeholder="kj3aw9876-5213-5dsf-9537-a1198af4378 (required)">
        </p>
        <p class="inputSection">
            <label for="category">Category : </label>
            <input type="text" name="category" id="category" value="" placeholder="sent via https://sendgrid.14159.ninja/ (optional)">
        </p>
        <p class="inputSection">
            <label for="subject">Subject : </label>
            <input type="text" name="subject" id="subject" value="" placeholder="(optional)">
        </p>
        <p class="inputSection">
            <label for="body">Body : </label>
            <input type="text" name="body" id="body" value="" placeholder="(optional)">
        </p>
        <p class="inputSection">
            <label for="from">From : </label>
            <input type="text" name="from" id="from" value="" placeholder="my.email@domain.com (required)">
        </p>
        <p class="inputSection">
            <label for="fromName">From Name : </label>
            <input type="text" name="fromName" id="fromName" value="" placeholder="FirstName LastName(required)">
        </p>
        <hr>
        <h1>Recipients:</h1>
        <p>
          Recipients information in JSON format (<a href="https://github.com/PiNinja/sendgrid-mailer" target="_blank">see here for more infos</a>):
        </p>
        <textarea name="recipientsJSON" rows="8" placeholder="[{'email':'arthur.juchereau@gmail.com','name':'Arthur Juchereau'}]"></textarea>
        <p class="inputSubmit">
          <input type="submit" value="Send">
        </p>
      </form>
    </main>
  </body>
</html>
