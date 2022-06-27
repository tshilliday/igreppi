<?php
use Respect\Validation\Validator as Validator;
use Respect\Validation\Exceptions\NestedValidationException;

$mailchimpApiKey = '041b69566e471ca6001f41e5659b4219-us3';
$mailchimpListId = '9ce82b3e95';

if (!empty($mailchimpApiKey) && !empty($mailchimpListId)) {
    $mailchimpBaseUrl = 'https://<dc>.api.mailchimp.com/3.0/';
    $mailchimpDataCentre = substr(strrchr($mailchimpApiKey, '-'), 1);
    $mailchimpUrl = str_replace('<dc>', $mailchimpDataCentre, $mailchimpBaseUrl);
    $mailchimp = array(
        'key' => $mailchimpApiKey,
        'url' => $mailchimpUrl
    );
}

$forms = array(
    array(
        'form_slug' => 'contact',
        'form_name' => 'Contact',
        'fields' => array(
            'first_name' => FILTER_SANITIZE_STRING,
            'last_name' => FILTER_SANITIZE_STRING,
            'email' => FILTER_SANITIZE_STRING,
            'phone' => FILTER_SANITIZE_STRING,
            'message' => FILTER_SANITIZE_STRING,
            'consent' => FILTER_SANITIZE_STRING,
            'newsletter' => FILTER_SANITIZE_STRING
        ),
        'labels' => array(
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'message' => 'Message',
            'newsletter' => 'I would like to sign up to the newsletter',
            'consent' => 'Consent for processing data',
        ),
        'validation' => Validator::arrayVal()
            ->key('first_name', $n = Validator::stringType()->notEmpty())
            ->key('last_name', $n = Validator::stringType()->notEmpty())
            ->key('email', $n = Validator::email())
            ->key('message', $n = Validator::stringType()->notEmpty())
            ->key('consent', $n = Validator::notBlank())
            ->setName('contact'),
        'mainError' => 'Oops... There are errors. Please try again.',
        'successMessage' => 'Thank you for your enquiry.',
        'errors' => array(
            'first_name' => "{{name}}",
            'last_name' => "{{name}}",
            'email' => "{{name}}",
            'phone' => "{{name}}",
            'message' => "{{name}}",
            'consent' => "{{name}}"
        ),
        'email' => get_field('to_email', 'form-settings'),
        'from' => array(
            'name' => get_field('from_name', 'form-settings'),
            'email' => get_field('from_email', 'form-settings')
        )
    ),
    array(
        'form_slug' => 'newsletter-signup',
        'form_name' => 'Newsletter Signup',
        'fields' => array(
            'first_name' => FILTER_SANITIZE_STRING,
            'last_name' => FILTER_SANITIZE_STRING,
            'email' => FILTER_SANITIZE_STRING,
            'consent' => FILTER_SANITIZE_STRING,
        ),
        'labels' => array(
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'consent' => 'Consent for newsletter',
        ),
        'validation' => Validator::arrayVal()
            ->key('first_name', $n = Validator::stringType()->notEmpty()->setName("first_name"))
            ->key('last_name', $n = Validator::stringType()->notEmpty()->setName("last_name"))
            ->key('email', $n = Validator::email()->setName("email"))
            ->key('consent', $n = Validator::notBlank())
            ->setName('newsletter-signup'),
        'errors' => array(
            'first_name' => "{{name}}",
            'last_name' => "{{name}}",
            'email' => "{{name}}",
            'consent' => "{{name}}"
        ),
        'mainError' => 'Oops... There are errors. Please try again.',
        'successMessage' => 'Thank you for signing up!',
        'sendDefaultAdminNotification' => false,
        'email' => get_field('to_email', 'form-settings'),
        'from' => array(
            'name' => get_field('from_name', 'form-settings'),
            'email' => get_field('from_email', 'form-settings')
        )
    ),
    array(
        'form_slug' => 'product-enquiry',
        'form_name' => 'Product Enquiry',
        'fields' => array(
            'source' => FILTER_SANITIZE_STRING,
            'first_name' => FILTER_SANITIZE_STRING,
            'last_name' => FILTER_SANITIZE_STRING,
            'email' => FILTER_SANITIZE_STRING,
            'phone' => FILTER_SANITIZE_STRING,
            'post_code' => FILTER_SANITIZE_STRING,
            'message' => FILTER_SANITIZE_STRING,
            'newsletter' => FILTER_SANITIZE_STRING,
            'consent' => FILTER_SANITIZE_STRING,
        ),
        'labels' => array(
            'source' => 'Enquiring From',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'post_code' => 'Post Code',
            'message' => 'Message',
            'newsletter' => 'I would like to sign up to the newsletter',
            'consent' => 'Consent for processing data',
        ),
        'validation' => Validator::arrayVal()
            ->key('source', $n = Validator::stringType()->notEmpty())
            ->key('first_name', $n = Validator::stringType()->notEmpty())
            ->key('last_name', $n = Validator::stringType()->notEmpty())
            ->key('email', $n = Validator::email())
            ->key('message', $n = Validator::stringType()->notEmpty())
            ->key('consent', $n = Validator::notBlank())
            ->setName('product-enquiry'),
        'mainError' => 'Oops... There are errors. Please try again.',
        'successMessage' => 'Thank you for your enquiry.',
        'errors' => array(
            'source' => "{{name}}",
            'first_name' => "{{name}}",
            'last_name' => "{{name}}",
            'email' => "{{name}}",
            'message' => "{{name}}",
            'newsletter' => "{{name}}",
            'consent' => "{{name}}"
        ),
        'email' => get_field('to_email', 'form-settings'),
        'from' => array(
            'name' => get_field('from_name', 'form-settings'),
            'email' => get_field('from_email', 'form-settings')
        )
    )
);

if (!empty($mailchimp)) {
    $forms[0]['mailchimp'] = array(
        'enabled' => true,
        'list_id' => $mailchimpListId,
        'fields'  => array(
            'fname' => 'first_name',
            'lname' => 'last_name',
            'email' => 'email'
        ),
        'trigger' => 'newsletter' // if checkbox consent is on
    );
    $forms[1]['mailchimp'] = array(
        'enabled' => true,
        'list_id' => $mailchimpListId,
        'fields'  => array(
            'fname' => 'first_name',
            'lname' => 'last_name',
            'email' => 'email'
        ),
        'trigger' => 'email'
    );
}
