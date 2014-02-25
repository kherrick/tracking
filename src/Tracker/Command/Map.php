<?php
namespace Tracker\Command;

use Cilex\Command\Command;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Tracker\Entity\Post;
use Tracker\Service\Database;
use Tracker\Data\Transformer\Log;

class Map extends Command
{
    private $entityManager = null;

    public function __construct(\Doctrine\ORM\EntityManager $entityManager)
    {
        parent::__construct();

        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this
            ->setName('map')
            ->setDescription('Generate a Google static map URL.')
            ->setHelp('e.g. ./tracker.php map --database="2011-04-15"')
            ->addOption('database', '-d', 2, 'Use the database.', null)
            ->addOption('log-file', '-l', 2, 'Use a log file.', null);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $log      = $input->getOption('log-file');
        $database = $input->getOption('database');

        //no options provided
        if (!$log && !$database) {
            $output->writeln('you must specify a datasource using the log or database option...');
            $output->writeln('');

            exit(1);
        }

        //both options provided
        if ($log && $database) {
            $output->writeln('you cannot specify both the log-file and database options together...');
            $output->writeln('');

            exit(1);
        }

        /**
         * log file logic
         * @todo clean this up, look at using Service\Log instead of Transformer\Log directly
         */
        if ($log) {
            if (!is_file($log)) {
                $output->writeln('log file not found...');
                $output->writeln('');

                exit(1);
            } else {
                //begin processing
                $output->writeln('Processing...');

                $data            = new Log($log);
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

                $output->writeln($results);

                return 0;
            }
        }

        /**
         * database logic
         */
        if ($database) {
            $date = date('Y-m-d', strtotime($database));

            //setup new log container
            $container = new \Pimple();

            // define some parameters
            $container['entityManager'] = $this->entityManager;
            $container['data'] = new Post($_POST);

            $container['database'] = $container->share(function($c) {
                return new Database(
                    $c['entityManager'],
                    $c['data']
                );
            });

            //get locations by date provided
            $rows = $container['database']->query(
                "SELECT location FROM Tracker\Entity\Location location WHERE location.date like '" . $date . "'"
            );

            //see https://developers.google.com/maps/documentation/staticmaps/
            $url = 'http://maps.googleapis.com/maps/api/staticmap?size=640x640&zoom=4&sensor=false&markers=';

            //append latitude and longitude from selected rows
            foreach ($rows as $location) {
                $url .= $location->getLoc() . "|";
            }

            //strip last pipe from the foreach above
            $results = substr($url, 0, strlen($url)-1);

            $output->writeln($results);

            return 0;
        }
    }
}

