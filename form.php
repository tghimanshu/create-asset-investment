<?php
/**
 * Contact Form Handler File.
 *
 * This file processes contact form submissions via POST requests.
 * It supports different forms identified by their field names.
 * It returns a JSON response indicating success or failure.
 */

/**
 * Handles contact form submissions.
 */
class ContactFormHandler {
    /**
     * @var array $response The response data to be returned as JSON.
     */
    private $response;

    /**
     * Constructor.
     * Initializes the response array.
     */
    public function __construct() {
        $this->response = array();
        $this->response['status'] = 'warning';
    }

    /**
     * Processes the POST data and sends an email if valid data is present.
     *
     * @param array $postData The $_POST data.
     * @return string JSON encoded response.
     */
    public function handle($postData) {
        // Contact form 1 ( Contacts section )
        if ( ( isset( $postData['cf-1-subject'] ) && $postData['cf-1-subject'] != "" ) && ( isset( $postData['cf-1-phone-no'] ) && $postData['cf-1-phone-no'] != "" ) && ( isset( $postData['cf-1-email'] ) && $postData['cf-1-email'] != "" ) ) {
            $to      = 'your@email.com'; // Your email
            $subject = 'Contact form';   // E-mail subject
            $message = '
                    <html>
                        <head>
                            <title>' . $subject . '</title>
                        </head>
                        <body>
                            <p>Subject: ' . $postData['cf-1-subject'] . '</p>
                            <p>Phone no.: ' . $postData['cf-1-phone-no'] . '</p>
                            <p>Email: ' . $postData['cf-1-email'] . '</p>
                        </body>
                    </html>';
            $headers = "Content-type: text/html; charset=utf-8 \r\n"; // Charset
            $headers .= "From: Ency <your@email.com>\r\n";            // Your name and email

            if ( mail( $to, $subject, $message, $headers ) ) {
                $this->response['status'] = 'success';
            } else {
                $this->response['status'] = 'error';
            }
        }

        // Contact form 2 ( Choose plan )
        else if ( isset( $postData['cf-2-first-name'] ) && isset( $postData['cf-2-last-name'] ) && isset( $postData['cf-2-email'] ) && isset( $postData['cf-2-company'] ) && isset( $postData['cf-2-phone-no'] ) && isset( $postData['cf-2-message'] ) ) {
            $to      = 'your@email.com'; // Your email
            $subject = 'Order plan';     // E-mail subject
            $message = '
                    <html>
                        <head>
                            <title>' . $subject . '</title>
                        </head>
                        <body>
                            <p>First name: ' . $postData['cf-2-first-name'] . '</p>
                            <p>Last name: ' . $postData['cf-2-last-name'] . '</p>
                            <p>Email: ' . $postData['cf-2-email'] . '</p>
                            <p>Company: ' . $postData['cf-2-company'] . '</p>
                            <p>Phone no.: ' . $postData['cf-2-phone-no'] . '</p>
                            <p>Message: ' . $postData['cf-2-message'] . '</p>
                        </body>
                    </html>';
            $headers = "Content-type: text/html; charset=utf-8 \r\n"; // Charset
            $headers .= "From: Ency <your@email.com>\r\n";            // Your name and email

            if ( mail( $to, $subject, $message, $headers ) ) {
                $this->response['status'] = 'success';
            } else {
                $this->response['status'] = 'error';
            }
        }

        // Comment form
        else if ( isset( $postData['comment'] ) && isset( $postData['comment-author'] ) && isset( $postData['comment-email'] ) && isset( $postData['comment-url'] ) ) {
            $to      = 'your@email.com'; // Your email
            $subject = 'Comment form';   // E-mail subject
            $message = '
                    <html>
                        <head>
                            <title>' . $subject . '</title>
                        </head>
                        <body>
                            <p>Comment: ' . $postData['comment'] . '</p>
                            <p>Author: ' . $postData['author'] . '</p>
                            <p>Email: ' . $postData['email'] . '</p>
                            <p>Url: ' . $postData['url'] . '</p>
                        </body>
                    </html>';
            $headers = "Content-type: text/html; charset=utf-8 \r\n"; // Charset
            $headers .= "From: Ency <your@email.com>\r\n";            // Your name and email

            if ( mail( $to, $subject, $message, $headers ) ) {
                $this->response['status'] = 'success';
            } else {
                $this->response['status'] = 'error';
            }
        }

        return json_encode( $this->response );
    }
}

$handler = new ContactFormHandler();
echo $handler->handle($_POST);
?>
