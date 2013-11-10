<?php

/**
 * File operations
 */
class fileOps
{

    /**
     * Date
     * @var string
     */
    public $date;

    /**
     *
     * Constructor
     *
     */
    public function __construct()
    {
        $this->date = date('Y-m-d');
    }

    /**
    * Write the contents of a variable to a file
    * @param mixed $data the data to write to the file
    * @param int|resource $flags optional flags to use for write operations
    * @param string $file the filename to write to
    * @return null
    *
    * Append to the default logging file.
    * debugToFile('it works...');
    *
    * Append to the default logging file, same as above.
    * debugToFile('it works...', FILE_APPEND,'/usr/local/zend/var/log/php.log');
    *
    * Overwrite the default logging file.
    * debugToFile('it works...', null);
    *
    * Overwrite to temporary_logging_filename.log. Create if necessary.
    * debugToFile($variable,null,'/usr/local/zend/var/log/temporary_logging_filename.log');
    *
    * Append to temporary_logging_filename.log. Create if necessary.
    * debugToFile('it works...',FILE_APPEND,'/usr/local/zend/var/log/temporary_logging_filename.log');
    *
    */
    public function debugToFile($data = null, $flags = FILE_APPEND, $file = '../../log.txt')
    {
        //get timestamp for logging purposes
        $timestamp = date('[d-m-Y H:i:s e]') . " debugToFile data below:\n";

        //turn on output buffering, get the buffer contents, and delete output buffer
        ob_start();
        print_r($data);
        $content = ob_get_clean();

        //setup file contents
        $fileContents .= $timestamp . $content . "\n";

        //identical to calling fopen(), fwrite() and fclose() successively
        file_put_contents($file, $fileContents, $flags);
    }

    /**
    * Write the contents of a variable to a file
    * @param mixed $data the data to write to the file
    * @param int|resource $flags optional flags to use for write operations
    * @param string $file the filename to write to
    * @return null
    *
    * Append to the default logging file.
    * writeToFile('it works...');
    *
    * Append to the default logging file, same as above.
    * writeToFile('it works...', FILE_APPEND,'/usr/local/zend/var/log/php.log');
    *
    * Overwrite the default logging file.
    * writeToFile('it works...', null);
    *
    * Overwrite to temporary_logging_filename.log. Create if necessary.
    * writeToFile($variable,null,'/usr/local/zend/var/log/temporary_logging_filename.log');
    *
    * Append to temporary_logging_filename.log. Create if necessary.
    * writeToFile('it works...',FILE_APPEND,'/usr/local/zend/var/log/temporary_logging_filename.log');
    *
    */
    public function writeToFile($data = null, $flags = FILE_APPEND, $file = '../../log.txt')
    {
        //identical to calling fopen(), fwrite() and fclose() successively
        file_put_contents($file, $data, $flags);
    }

}

/**
 * postUtility Class
 */
class postUtility
{
    const SETTINGS = '../../config/settings.ini';
    public $config;
    public $post;

    /**
     *
     * Constructor
     *
     */
    public function __construct()
    {
        $this->config  = $this->loadConfig();
        $this->post    = $_POST;
    }

    private function loadConfig()
    {
        return parse_ini_file(self::SETTINGS, true);
    }

    /**
     * Post data in $_POST
     *
     * example: $post->send_data_in_post($url, $info, $name, $employer, $organization) {
     * $post = new post();
     * $post->send_data_in_post($url_parms[0], $url_parms[1], $url_parms[2], $url_parms[3], $url_parms[4]);
     *
     * @param  string $url
     * @param  string $info
     * @param  string $name
     * @param  string $employer
     * @param  string $organization
     * @return null
     */
    private function send_data_in_post($url, $info, $name, $employer, $organization)
    {
        $fields = array(
            'i' => urlencode($info),
            'n' => urlencode($name),
            'e' => urlencode($employer),
            'o' => urlencode($organization)
        );

        //initialize variable
        $fields_string = '';

        //url-ify the data for the POST
        foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
        rtrim($fields_string, '&');

        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, count($fields));
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

        //execute post
        $result = curl_exec($ch);

        //close connection
        curl_close($ch);
    }

    /**
     * Post data in url (get?)
     *
     * example: $post->send_data_in_url($url_parms[0], $url_parms[1], $url_parms[2], $url_parms[3], $url_parms[4])
     * $post = new post();
     * $post->send_data_in_url($url_parms[0], $url_parms[1], $url_parms[2], $url_parms[3], $url_parms[4]);
     *
     * @param  string $url
     * @param  string $info
     * @param  string $name
     * @param  string $employer
     * @param  string $organization
     * @return null
     */
    private function send_data_in_url($url, $info, $name, $employer, $organization)
    {

        $i = 'i=' . $info;
        $n = 'n=' . $name;
        $e = 'e=' . $employer;
        $o = 'o=' . $organization;

        $location = $url . '?' . $i . '&' . $n . '&' . $e . '&' . $o;

        //simply post the user to the url built
        header("Location: " . $location);
    }

}

//Instantiate a new fileOps class
$fileOps = new fileOps();

//Instantiate a new postUtility class
$postUtility = new postUtility();

//Check the key passed via the post
if ($postUtility->config['global']['key'] == $postUtility->post['key'])
{
    //setup content to be wrote the file
    $date    = $postUtility->post['DATE'];
    $time    = $postUtility->post['TIME'];
    $batt    = $postUtility->post['BATT'];
    $smsrf   = $postUtility->post['SMSRF'];
    $loc     = $postUtility->post['LOC'];
    $locacc  = $postUtility->post['LOCACC'];
    $localt  = $postUtility->post['LOCALT'];
    $locspd  = $postUtility->post['LOCSPD'];
    $loctms  = $postUtility->post['LOCTMS'];
    $locn    = $postUtility->post['LOCN'];
    $locnacc = $postUtility->post['LOCNACC'];
    $locntms = $postUtility->post['LOCNTMS'];
    $cellid  = $postUtility->post['CELLID'];
    $cellsig = $postUtility->post['CELLSIG'];
    $cellsrv = $postUtility->post['CELLSRV'];

    $content = 'DT:' . $date . "_$time@BATT:$batt,SMSRF:$smsrf,LOC:$loc,LOCACC:$locacc,LOCALT:$localt,LOCSPD:$locspd,LOCTMS:$loctms,LOCN:$locn,LOCNACC:$locnacc,LOCNTMS:$locntms,CELLID:$cellid,CELLSIG:$cellsig,CELLSRV:$cellsrv\n";

    $fileOps->writeToFile($content, FILE_APPEND, '../../logs/' . $fileOps->date . '_post_capture.log');
}