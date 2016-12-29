<?php
// Logic side
//Check if action is set
if(!empty($_POST['action'])){
  $values = $_POST;
  //Check for required fields
  if(empty($values['APIKey'])){
    $error['APIKey'] = true;
  }
  if(empty($values['templateId'])){
    $error['templateId'] = true;
  }
  if(empty($values['from']) || !filter_var($values['from'],FILTER_VALIDATE_EMAIL)){
    $error['from'] = true;
  }
  if(empty($values['fromName'])){
    $error['fromName'] = true;
  }

  //Check optionnal fields
  if(empty($values['subject'])){
    $values['subject'] = " ";
  }
  if(empty($values['body'])){
    $values['body'] = " ";
  }
  if(empty($values['category'])){
    $values['category'] = "Sent via the PiNinja at ".date("d/m/y H:i");
  }

  //check recipients
  $recipients = json_decode($values['recipientsJSON']);
  if(empty($recipients)){
    $error['recipientsJSON'] = true;
  }


  if(empty($error)){
    require 'vendor/autoload.php';
    //require 'lib/SendGrid.php';
    $email = new SendGrid\Email();
    $subject = array();
    $body = array();
    $fromName = array();
    $rejected = array();
    $approved = array();
    foreach ($recipients as $recipient) {
      //get
      if(filter_var($values['email'],FILTER_VALIDATE_EMAIL)){
        $recipient['why'] = "Email check failed";
        $rejected[] = $recipient;
      }
      else{
        $subject[] = $values['subject'];
        $body[] = $values['body'];
        $toSendGrid[] = $recipient['email'];
        $fromName[] = $values['fromName'];
        $approved[] = $recipient;
      }
    }
    $email
        ->addTo(array('arthur@launchleap.com'))
        ->setSmtpapiTos($toSendGrid)
        ->setFrom('arthur@launchleap.com')
        ->setFromName($arthurLL)
        ->setSubject($subject)
        ->setText($body)
        ->setHtml($body)
        ->addFilter('templates', 'enabled', 1)
        ->addFilter('templates', 'template_id', $templateId)
        ->setSendAt($timethen)
        ->addSubstitution("-name-", $toSendGrid)
        ->addSubstitution("-datepresent-", $timenowSendGrid)
        ->addSubstitution("-datefutur-", $timethenSendGrid)
        //->addSubstitution("-owner-", $owner)
        //->addSubstitution("-campaign-", $campaign)
        //->addSubstitution("-comment-", $comment)
        //->addSubstitution("-answer-", $answer)
        //->addSubstitution("-company-", $company)
        ->addUniqueArg('type', 'future')
        ->addCategory('test Send in the future');

    /*if($sendgrid->send($email)){
      echo("hoho$i<br>");
    }*/
  }
  //reset values
  $values = $_POST;
}
else{
  $values = array(
    "APIKey" => "",
    "templateId" => "",
    "category" => "",
    "subject" => "",
    "body" => "",
    "from" => "",
    "fromName" => "",
    "JSONrecipient" => ""
  );
}
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
    <meta name="og:description" content="Quick &amp; dirty email sender using sendgrid.com">
    <meta name="description" content="Quick &amp; dirty email sender using sendgrid.com">
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
        <input type="hidden" name="action" value="send">
        <h1>General settings : </h1>
        <p class="inputSection">
            <label for="APIKey">SendGrid API Key : </label>
            <input type="text" name="APIKey" id="APIKey" value="<?=$values['APIKey']?>" placeholder="hwacwaWADSrndYAODJWC8HA (required)" <?=(empty($error['APIKey'])?:'class="error"')?>>
        </p>
        <p class="inputSection">
            <label for="templateId">Template ID : </label>
            <input type="text" name="templateId" id="templateId" value="<?=$values['templateId']?>" placeholder="kj3aw9876-5213-5dsf-9537-a1198af4378 (required)" <?=(empty($error['templateId'])?:'class="error"')?>>
        </p>
        <p class="inputSection">
            <label for="category">Category : </label>
            <input type="text" name="category" id="category" value="<?=$values['category']?>" placeholder="sent via https://sendgrid.14159.ninja/ (optional)">
        </p>
        <p class="inputSection">
            <label for="subject">Subject : </label>
            <input type="text" name="subject" id="subject" value="<?=$values['subject']?>" placeholder="(optional)">
        </p>
        <p class="inputSection">
            <label for="body">Body : </label>
            <input type="text" name="body" id="body" value="<?=$values['body']?>" placeholder="(optional)">
        </p>
        <p class="inputSection">
            <label for="from">From : </label>
            <input type="text" name="from" id="from" value="<?=$values['from']?>" placeholder="my.email@domain.com (required)" <?=(empty($error['from'])?:'class="error"')?>>
        </p>
        <p class="inputSection">
            <label for="fromName">From Name : </label>
            <input type="text" name="fromName" id="fromName" value="<?=$values['fromName']?>" placeholder="FirstName LastName(required)" <?=(empty($error['fromName'])?:'class="error"')?>>
        </p>
        <hr>
        <h1>Recipients:</h1>
        <p>
          Recipients information in JSON format (<a href="https://github.com/PiNinja/sendgrid-mailer" target="_blank">see here for more infos</a>):
        </p>
        <textarea name="recipientsJSON" rows="8" placeholder="[{'email':'arthur.juchereau@gmail.com','name':'Arthur Juchereau'}]" <?=(empty($error['recipientsJSON'])?:'class="error"')?>><?=$values['JSONrecipient']?></textarea>
        <p class="inputSubmit">
          <input type="submit" value="Send">
        </p>
      </form>
      <p>
        approved :
        <?echo print_r($approved); ?>
      </p>
      <p>
        rejected :
        <?php echo print_r($rejected); ?>
      </p>
    </main>
  </body>
</html>
