<?php
/**
 * Created by PhpStorm.
 * User: Tony
 * Date: 7/3/2015
 * Time: 9:09 AM
 */

class Contact extends OpenSms_Abstract_Module_Controller {
    public function index(){
        $this->data['pageTitle'] = "Contact us";
        $this->renderTemplate();
    }

    public function send(){
        $name = @trim(stripslashes($_POST['name']));
        $email = @trim(stripslashes($_POST['email']));
        $subject = @trim(stripslashes($_POST['subject']));
        $message = @trim(stripslashes($_POST['message']));

        $email_from = $email;
        $email_to = 'contact@glapnigeria.org';//replace with your email

        $body = 'Name: ' . $name . "\n\n" . 'Email: ' . $email . "\n\n" . 'Subject: ' . $subject . "\n\n" . 'Message: ' . $message;

        $success = @mail($email_to, $subject, $body, 'From: <'.$email_from.'>');

        if($success) $this->setNotification('Your message have been sent. We will get back to you soon', 'contact_send');
        else $this->setError('Error in sending mail. Please give us call or visit any of our offices', 'contact_send');

        $this->redirectToAction('index');
    }
} 