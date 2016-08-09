<?php
/**
 * Helper Classes
 *
 * @package		TheSoftwarePeople.Helpers
 * @filename	Mail.php
 * @version		1.0.2
 * @author		Sharron Denice, The Software People (www.thesoftwarepeople.com)
 * @copyright	Copyright 2016 The Software People (www.thesoftwarepeople.com). All rights reserved
 * @license		APACHE v2.0 (http://www.apache.org/licenses/LICENSE-2.0)
 * @brief		Global functions used by various services
 *
 */	
class TSP_Mail
{
    private $mail;
    private $from_email;
    private $from_name;

    /**
     * Constructor
     *
     * @since 1.0.1
     *
     * @param string $from - From email
     * @param string $name - From name
     * @param bool $smtp_on - SMTP on/off
     *
     * @return none
     *
     */
    function __construct($from, $name, $smtp_on) 
    {
        $this->mail = new PHPMailer( true );

        $this->from_email = $from;
        $this->from_name = $name;

        $this->configContact();

        if ($smtp_on)
            $this->configSMTP();
    }

    /**
     * Configure SMTP
     *
     * @since 1.0.1
     *
     * @param none
     *
     * @return none
     *
     */
    private function configSMTP()
    {
        if (isset($this->mail))
        {
            // Additional settings…
            $this->mail->isSMTP();
    
        	//if (TSP_Config::get('app.debug'))
        	//    $this->mail->SMTPDebug  = 2;
    
            $this->mail->Host = TSP_Settings::$smtp_host;
            $this->mail->SMTPAuth = true; // Force it to use Username and Password to authenticate
            $this->mail->Port = TSP_Settings::$smtp_port;
            $this->mail->Username = TSP_Settings::$smtp_user;
            $this->mail->Password = TSP_Settings::$smtp_pass;        
            $this->mail->SMTPSecure = TSP_Settings::$smtp_secure;
        }
    }

    /**
     * Configure SMTP
     *
     * @since 1.0.1
     *
     * @param none
     *
     * @return none
     *
     */
    private function configContact()
    {
        if (isset($this->mail))
        {
            // Additional settings…
            $this->mail->From = $this->from_email;
            $this->mail->FromName = $this->from_name;
        }
    }

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
	        if (TSP_Config::get('app.debug'))
	            TSP_Log::info("Preparing mail...");

	        $this->mail->setFrom(TSP_Settings::$admin_from_email, TSP_Settings::$admin_from_name);
	        
	        if (TSP_Settings::$admin_notify)
	        {
                if (TSP_Config::get('app.debug'))
                    TSP_Log::info("Adding admin to BCC...");

	        	$this->mail->AddBCC(TSP_Settings::$admin_email, TSP_Settings::$admin_email);
	        }
	        
	        $plain_text = strip_tags($body, "<br>");
	        $plain_text = preg_replace("/\<br\>/", "\n", $plain_text);
	        	
	        $this->mail->addReplyTo(TSP_Settings::$admin_from_email, TSP_Settings::$admin_from_name);
	        $this->mail->addAddress($to);
	        $this->mail->Subject = utf8_decode($subject);
	        $this->mail->msgHTML($body);
	        $this->mail->AltBody = $plain_text;
	        
	        if (file_exists($attachment))
	        {
	            $this->mail->AddAttachment( $attachment , basename($attachment) );
	        }

            if (TSP_Config::get('app.debug'))
                TSP_Log::info("Sending mail...");

            if (TSP_Config::get('app.debug'))
                TSP_Log::info("Sending mail content {$plain_text}...");

	        if(!$this->mail->Send())
	        {
		        if (TSP_Config::get('app.debug'))
		            TSP_Log::info("DID NOT send email, Response: {$this->mail->ErrorInfo}.");
			}
			else
			{
		        if (TSP_Config::get('app.debug'))
		            TSP_Log::info("Message sent!");
			}   

			$this->mail->ClearAddresses();
			$this->mail->ClearAllRecipients();
        }
		catch (phpmailerException $e) 
		{
	        if (TSP_Config::get('app.debug'))
	            TSP_Log::info("PHPMailer: DID NOT send email, Response: {$e->errorMessage()}.");
		} 
		catch (Exception $e) 
		{
	        if (TSP_Config::get('app.debug'))
	            TSP_Log::info("Exception: DID NOT send email, Response: {$e->errorMessage()}.");
		}
 	}
}