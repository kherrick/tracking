#!/usr/bin/php
<?php
namespace Cilex\Command;

if (!$loader = include __DIR__.'/vendor/autoload.php') {
    die('You must set up the project dependencies.');
}

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Tracker\Data\Transformer as Transformer;

class Process extends Command
{
    protected $pathToLogs = 'logs/YYYY-MM-DD_post_capture_DOT_log';

    protected $results;

    protected function configure()
    {
        $this
            ->setName('process')
            ->setDescription('Process the stuff');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Processing...');

        $data            = new Transformer(__DIR__ . '/' . $this->pathToLogs);
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

$app = new \Cilex\Application('Tracker');

$app->command(new \Cilex\Command\Process());

$app->run();

