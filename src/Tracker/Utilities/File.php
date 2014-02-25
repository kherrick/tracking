<?php
namespace Tracker\Utilities;

/**
 * file operations
 */
class File
{
    /**
     * @var string
     */
    public $date;

    /**
     * @return null
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
     * debug('it works...');
     *
     * Append to the default logging file, same as above.
     * debug('it works...', FILE_APPEND,'/var/log/php.log');
     *
     * Overwrite the default logging file.
     * debug('it works...', null);
     *
     * Overwrite to temporary_logging_filename.log. Create if necessary.
     * debug($variable,null,'/var/log/temporary_logging_filename.log');
     *
     * Append to temporary_logging_filename.log. Create if necessary.
     * debug('it works...',FILE_APPEND,'/var/log/temporary_logging_filename.log');
     *
     */
    public function debug($data = null, $flags = FILE_APPEND, $file = '../../log.txt')
    {
        //get timestamp for logging purposes
        $timestamp = date('[d-m-Y H:i:s e]') . " debug data below:\n";

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
     * fileHandler
     * @param  string $file file to load as array
     * @return array
     */
    public function fileHandler($file)
    {
        return file($file);
    }

    /**
     * Write the contents of a variable to a file
     * @param mixed $data the data to write to the file
     * @param int|resource $flags optional flags to use for write operations
     * @param string $file the filename to write to
     * @return null
     *
     * Append to the default logging file.
     * write('it works...');
     *
     * Append to the default logging file, same as above.
     * write('it works...', FILE_APPEND,'/var/log/php.log');
     *
     * Overwrite the default logging file.
     * write('it works...', null);
     *
     * Overwrite to temporary_logging_filename.log. Create if necessary.
     * write($variable,null,'/var/log/temporary_logging_filename.log');
     *
     * Append to temporary_logging_filename.log. Create if necessary.
     * write('it works...',FILE_APPEND,'/var/log/temporary_logging_filename.log');
     *
     */
    public function write($data = null, $flags = FILE_APPEND, $file = '../../log.txt')
    {
        //identical to calling fopen(), fwrite() and fclose() successively
        file_put_contents($file, $data, $flags);
    }

}