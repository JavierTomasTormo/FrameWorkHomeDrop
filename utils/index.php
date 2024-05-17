<?php

// Include Composer autoload file to load Resend SDK classes...
//require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/vendor/autoload.php';

// Assign a new Resend Client instance to $resend variable, which is automatically autoloaded...
$result = Resend::client('re_fbxk6T2X_3JrYeFR1659yRUxqTqpmSDTK');

try {
    $result->emails->send([
        'from' => 'onboarding@resend.dev',
        'to' => 'javiertomas2003@gmail.com',
        'subject' => 'Hello World',
        'html' => '<p>Verify new Account <strong> email</strong>!</p><br/><h1 style="font-family: "Plus Jakarta Sans", sans-serif; color: #ddba6b;">HomeDrop</h1>'
      ]);
} catch (\Exception $e) {
    exit('Error: ' . $e->getMessage());
}

// Show the response of the sent email to be saved in a log...
echo $result;
// echo $result;
