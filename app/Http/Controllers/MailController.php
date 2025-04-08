<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;

class MailController extends Controller
{
   function sendEmail()
   {
	   $to = "khelesh.mehra@dotsquares.com";
	   $msg = "Test";
	   $subject = "code test";
	   $mail = new WelcomeEmail($msg,$subject);
	   //dd($mail);
	   Mail::to($to)->send($mail);
	   
	   exit;
   }
}
