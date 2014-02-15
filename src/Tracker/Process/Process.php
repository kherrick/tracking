<?php
namespace Tracker\Process;

use Cilex\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Tracker\Data\Transformer as Transformer;

class Process extends Command
{
    /**
     * the log file path
     * @var string
     */
    protected $pathToLogs;

    public function __construct($logPath)
    {
        $this->pathToLogs = $logPath;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('process')
            ->setDescription('Process the stuff')
            ->addArgument('log');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //check if the log argument was passed
        if ($input->getArgument('log')) {
            $logArgument = explode('=', $input->getArgument('log'));

            isset($logArgument[1])     ?
                $log = $logArgument[1] :
                $log = null;

            $file = $this->pathToLogs . $log;

            if (!is_file($file)) {
                echo "log file doesn't exist...\n";
                exit();
            }
        } else {
            echo "you must specify a log... e.g. 'log=YYYY-MM-DD_post_capture_DOT_log'\n";
            exit();
        }

        //begin processing
        $output->writeln('Processing...');

        $data            = new Transformer($file);
        $dataLineHandler = $data->lineHandler();
        $dataResults     = $data->getResults();

        //see https://developers.google.com/maps/documentation/staticmaps/
        $url = 'http://maps.googleapis.com/maps/api/staticmap?size=640x640&zoom=4&sensor=false&markers=';

        //append latitude and longitude from each line of the file
        foreach ($dataResults as $key => $value) {
            $url .= $value['latitude'] . ',' . $value['longitude'] . "|";
        }

        //strip last pipe from the foreach above
        $url = substr($url, 0, strlen($url)-1);

        $results = $url . "\n";

        echo $results;
    }
}

