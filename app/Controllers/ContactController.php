<?php

namespace App\Controllers;

use App\Validation\Validator;

class COntactController extends Controller{

    public function showContactForm()
    {
        return $this->view('blog.contact'); 
    }

    public function checkContactForm()
    {
        $dataPost = (new Globals())->getPostData();

        $validator = new Validator($dataPost);

        $errors = $validator->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required'],
            'message' => ['required', 'min:20'],
        ]);

        $result = $this->sendContactMail($dataPost);

        if ($result) {
            return $this->redirect('?mailSent=true');
        }  return $this->redirect('contact/');
    }

    public function sendContactMail($mailInfo)
    {
        $to      = 'chrishb.rey@gmail.com';
        $subject = 'Contact mail from '. $mailInfo['name'];
        $message = $mailInfo['message'];
        $headers = 'From: ' . $mailInfo['email'] . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
        
        mail($to, $subject, $message, $headers);
        return true;
    }
}
