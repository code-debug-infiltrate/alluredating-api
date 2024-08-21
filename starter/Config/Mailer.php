<?php

namespace Config\Mailer;

require 'vendor/autoload.php';

class Mailer {
      /**
       * Name of attachment (ex: test.txt)
       *
       * @var string $attachment_name
       */
      public $attachment_name;

      /**
       * Full path of attachment (ex: files/test.txt)
       *
       * @var string $attachment_path
       */
      public $attachment_path;

      /**
       * Mail message_body content
       *
       * @var string $message_body
       */
      public $message_body;

      /**
       * Last error (if error occurred)
       *
       * @var string $error
       */
      public $error;

      /**
       * Sender email address
       *
       * @var string $from
       */
      public $from;

      /**
       * Reply To email address
       *
       * @var string $replyto
       */
      public $replyto;

      /**
       * Email subject
       *
       * @var string $subject
       */
      public $subject;

      /**
       * Recipient email address
       *
       * @var string $to
       */
      public $to;


      /**
     * Accessing a Mail in model.
     * 
     * @param $name The name of Mail should be case sensitive.
     */

      // public static function mailer($name)
      // {
      //       $class = '.\Mails\\'.$name;
      //       return new $class;
      // }




      /**
       * Send email
       *
       * @return bool
       */
      public function send() {
            // check for valid params
            if($this->to) {
                  // set boundry
                  $boundary = md5(rand(5000, 500000000) . date("r"));

                  // set attachment if exists
                  $attachment = null;
                  if($this->attachment_path && $this->attachment_name) {
                        // check if attachment file exists
                        if(file_exists($this->attachment_path)) {
                              $attachment = chunk_split(base64_encode(file_get_contents($this->attachment_path)));
                        } else {
                              $this->error = "Failed to send mail, attachment file \"{$this->attachment_path}\" not found";
                              return false;
                        }
                  }

                  // set headers
                  $headers = null;
                  if($this->from) {

                     $headers[] = 'MIME-Version: 1.0';
                     $headers[] = 'Content-type: text/html; charset=iso-8859-1';
                     $headers[] = 'From: '.getenv('APP_NAME').' <'.getenv('APP_EMAIL').'>';

                  }
                  if($attachment) {
                        $headers .= "\r\nMIME-Version: 1.0\r\nContent-Type: multipart/mixed; boundary=\"_1_{$boundary}\"";
                  }

                  // set message_body
                  $message_body = null;
                  if($attachment) {
                        $message_body = "This is a multi-part message in MIME format.

                        --_1_{$boundary}
                        Content-Type: multipart/alternative; boundary=\"_2_{$boundary}\"

                        --_2_$boundary
                        Content-Type: text/plain; charset=\"iso-8859-1\"
                        Content-Transfer-Encoding: 7bit

                        {$this->message_body}

                        --_2_{$boundary}--
                        --_1_{$boundary}
                        Content-Type: application/octet-stream; name=\"{$this->attachment_name}\"
                        Content-Transfer-Encoding: base64
                        Content-Disposition: attachment

                        {$attachment}
                        --_1_{$boundary}--";
                  } else {
                        $message_body = $this->message_body;
                  }

                  // send mail
                  if(mail($this->to, $this->subject, $message_body,  implode("\r\n", $headers))) {
                        return true;
                  } else {
                        $this->error = "Failed to send mail (check SMTP settings)";
                        return false;
                  }

            // fail
            } else {
                  $this->error = "Failed to send mail, invalid params";
                  return false;
            }
      }




      /**

     * End of file.

    */



}