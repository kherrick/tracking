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
    protected $pathToLogs = 'logs/';

    protected $results;

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
            $log = explode('=', $input->getArgument('log'));
            $file = $this->pathToLogs . $log[1];
            if (!file_exists($file)) {
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

        $this->results = $url . "\n";

        echo $this->results;
    }
}