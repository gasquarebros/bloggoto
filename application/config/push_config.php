<?php
/*
|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
|| FCM Push Notification Configurations
|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
*/
// $config['Akey'] = 'AIzaSyAD712SKyatGE2Jow5XBw8Aii';
$config['server_key'] = 'AAAAAP11DSU:APA91bEufU2wVzmJ9WhkCTSQDLOXpaaF4LTzR0Rm1iBRbYyK8rbjDakM0Y1g2s5KjebgWag6YtNVcERtvf8tISmYh9ff0W7g5HEwlvRbFrOrQ5gyZWjkuSQSCEbw5i-yVRm5NvAxSK6k';
$config['url'] = 'https://fcm.googleapis.com/fcm/send';
/*
|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
|| Apple Push Notification Configurations
|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
*/
/*
|--------------------------------------------------------------------------
| APN Permission file 
|--------------------------------------------------------------------------
|
| Contains the certificate and private key, will end with .pem
| Full server path to this file is required.
|
*/
//$config['PermissionFile_'] = APPPATH.'config'.'/bloggotoPro.pem';
$config['PermissionFile'] = realpath('.').'\bloggotoPro.pem';
$config['PassPhrase'] = 'admin123';
/*DORDEV*/
/*Production:DORPRO*/
/*
|--------------------------------------------------------------------------
| APN Services
|--------------------------------------------------------------------------
*/
$config['Sandbox'] = false;
/*development gate way*/
$config['PushGatewaySandbox'] = 'ssl://gateway.sandbox.push.apple.com:2195';
/*production gate way*/
$config['PushGateway'] = 'ssl://gateway.push.apple.com:2195';
$config['FeedbackGatewaySandbox'] = 'ssl://feedback.sandbox.push.apple.com:2196';
$config['FeedbackGateway'] = 'ssl://feedback.push.apple.com:2196';
/*
|--------------------------------------------------------------------------
| APN Connection Timeout
|--------------------------------------------------------------------------
*/
$config['Timeout'] = 300;
/*
|--------------------------------------------------------------------------
| APN Notification Expiry (seconds)
|--------------------------------------------------------------------------
| default: 86400 - one day
*/
$config['Expiry'] = 86400;
