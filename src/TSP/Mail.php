<?php
/**
 * Helper Classes
 *
 * @package		TheSoftwarePeople.Helpers
 * @filename	Mail.php
 * @version		1.0.0
 * @author		Sharron Denice, The Software People (www.thesoftwarepeople.com)
 * @copyright	Copyright 2016 The Software People (www.thesoftwarepeople.com). All rights reserved
 * @license		APACHE v2.0 (http://www.apache.org/licenses/LICENSE-2.0)
 * @brief		Global functions used by various services
 *
 */	
class TSP_Mail
{
    /**
     * Funciton to send mail using PHPMailer
     *
     * @since 1.0.0
     *
     * @param string $to - the email address
     * @param string $subject - the email subject
     * @param string $body - the email body
     * @param optional string $attachment - the email attachment
     *
     * @return none
     *
     */
    public function send($to, $subject, $body, $attachment = null)
    {
        try
        {
	        $mail = new PHPMailer();
			
	        if (TSP_Config::get('app.debug'))
	            TSP_Log::info("Preparing mail...");

	        $mail->setFrom(TSP_Settings::$admin_from_email, TSP_Settings::$admin_from_name);
	        
	        if (TSP_Settings::$admin_notify)
	        {
                if (TSP_Config::get('app.debug'))
                    TSP_Log::info("Adding admin to BCC...");

	        	$mail->AddBCC(TSP_Settings::$admin_email, TSP_Settings::$admin_email);
	        }
	        
	        $plain_text = strip_tags($body, "<br>");
	        $plain_text = preg_replace("/\<br\>/", "\n", $plain_text);
	        	
	        $mail->addReplyTo(TSP_Settings::$admin_from_email, TSP_Settings::$admin_from_name);
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