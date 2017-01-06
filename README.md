# sendgrid-mailer
Quick &amp; Dirty email sender via sendgrid, you can find one running here : https://sendgrid.14159.ninja/

#Logs
This server does not log anything, your API Key and template id are safe on https://sendgrid.14159.ninja/, you are responsible for how you use your account. HTTPS is provided as a network listening protection but you should run your own instance of the software if you want to be 100% safe.

#Requirement
You need a sendgrid.com account (free plan : 12k email per month), and an API Key generated from this account. You also need to create a transactionnal template and copy paste the ID.

# Basic Recipients JSON format
Recipients should be specified as an array of object (use the following syntax):

```javascript
[
{"email":"email.recipient1@domain.com"},
{"email":"email.recipient2@domain.com"},
{"email":"email.recipient3@domain.com"},
{"email":"email.recipient4@domain.com"}
]
```

# Advanced Recipients JSON format
You can add as many substitutions code as you want in each "recipient object". Each "key" will try to replace "-key-" in your sendgrid email template:

```javascript
[
{"email":"email.recipient1@domain.com","name":"Arthur Juchereau"},
{"email":"email.recipient2@domain.com","role":"Ninja"},
{"email":"email.recipient3@domain.com","where":"PiNinja"},
{"email":"email.recipient4@domain.com","name":"Arthur Juchereau","role":"Ninja","where":"PiNinja"}
]
```

With the template

```
Hello -name-, you are -role- in -where-
```

Will send an email to :

```
email.recipient1@domain.com => "Hello Arthur Juchereau, you are -role- at -where-"
email.recipient2@domain.com => "Hello -name, you are Ninja at -where-"
email.recipient3@domain.com => "Hello -name-, you are -role- at PiNinja"
email.recipient4@domain.com => "Hello Arthur Juchereau, you are Ninja at PiNinja"
```


# Customize your script
If you plan on using this script extensively, it is recommended to fork the repository and custom fit to your needs (for intance, sending at a specific date, attach files, use sections in sendgrid,etc). We can help as well.

# How to contribute
Feel free to submit pull request in order to support more features from sendgrid.
