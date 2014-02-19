<?php
namespace Tracker\Command;

use Cilex\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Tracker\Data\Transformer\Logfile;

class Map extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('map')
            ->setDescription('Generate a Google static map URL.')
            ->addArgument('logFile');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $logFile = $input->getArgument('logFile');

        if (!is_file($logFile)) {
            echo "you must specify a logfile... \n";
            echo "example: tracker.php map logs/YYYY-MM-DD_post_capture_DOT_log\n";

            exit(1);
        } else {
            //begin processing
            $output->writeln('Processing...');

            $data            = new Logfile($logFile);
            $dataLineHandler = $data->lineHandler();
            $dataResults     = $data->getResults();

            //see https://developers.google.com/maps/documentation/staticmaps/
            $url = 'http://maps.googleapis.com/maps/api/staticmap?size=640x640&zoom=4&sensor=false&markers=';

            //append latitude and longitude from each line of the file
            foreach ($dataResults as $key => $value) {
                $url .= $value['latitude'] . ',' . $value['longitude'] . "|";
            }

            //strip last pipe from the foreach above
            $results = substr($url, 0, strlen($url)-1);

            echo $results . "\n";
        }
    }
}

