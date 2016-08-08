<?php
/**
 * Helper Classes
 *
 * @package		TheSoftwarePeople.Helpers
 * @filename	class.Mail.php
 * @version		1.0.0
 * @author		Sharron Denice, The Software People (www.thesoftwarepeople.com)
 * @copyright	Copyright 2016 The Software People (www.thesoftwarepeople.com). All rights reserved
 * @license		APACHE v2.0 (http://www.apache.org/licenses/LICENSE-2.0)
 * @brief		Global functions used by various services
 *
 */	

class TSP_Mail
{
    private $from = "no-reply@thesoftwarepeople.com";
    private $from_name = "The Software People";

    function __contruct()
    {
    }
    
    public function send($to, $subject, $body, $attachment = null)
    {
        try
        {
	        $mail = new PHPMailer();
			
	        if (TSP_Config::get('app.debug'))
	            TSP_Log::info("Preparing mail...");

	        $mail->setFrom($this->from, $this->from_name);
	        
	        if (TSP_Settings::$notify_admin)
	        {
                if (TSP_Config::get('app.debug'))
                    TSP_Log::info("Adding admin to BCC...");

	        	$admin = TSP_Config::get('app.global_contacts.sbsadmin');
	        	$mail->AddBCC($admin->email, "{$admin->fname} {$admin->lname}");
	        }
	        
	        $plain_text = strip_tags($body, "<br>");
	        $plain_text = preg_replace("/\<br\>/", "\n", $plain_text);
	        	
	        $mail->addReplyTo($this->from, $this->from_name);
	        $mail->addAddress($to);
	        $mail->Subject = utf8_decode($subject);
	        $mail->msgHTML($body);
	        $mail->AltBody = $plain_text;
	        
	        if (file_exists($attachment))
	        {
	            $mail->AddAttachment( $attachment , basename($attachment) );
	        }

            if (TSP_Config::get('app.debug'))
                TSP_Log::info("Sending mail...");

            if (TSP_Config::get('app.debug'))
                TSP_Log::info("Sending mail content {$plain_text}...");

	        if(!$mail->Send())
	        {
		        if (TSP_Config::get('app.debug'))
		            TSP_Log::info("DID NOT send email, Response: {$mail->ErrorInfo}.");
			}
			else
			{
		        if (TSP_Config::get('app.debug'))
		            TSP_Log::info("Message sent!");
			}   

			$mail->ClearAddresses();
			$mail->ClearAllRecipients();
        }
		catch (phpmailerException $e) 
		{
	        if (TSP_Config::get('app.debug'))
	            TSP_Log::info("PHPMailer: DID NOT send email, Response: {$e->errorMessage()}.");
		} 
		catch (Exception $e) 
		{
	        if (TSP_Config::get('app.debug'))
	            TSP_Log::info("DID NOT send email, Response: {$e->errorMessage()}.");
		}
 	}
}