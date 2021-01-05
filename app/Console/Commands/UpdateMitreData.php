<?php

namespace App\Console\Commands;

use App\Service\MitreService;
use App\Support\Mitre\Content\Tactics;
use App\Support\Mitre\Content\Techniques;
use App\Support\Mitre\UpdateContent;
use Illuminate\Console\Command;

/**
 * Class UpdateMitreData
 * @package App\Console\Commands
 */
class UpdateMitreData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:mitre-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update data in database from remote source';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $updateContent = new UpdateContent(new MitreService());
        $updateContent
            ->add(new Tactics())
            ->add(new Techniques())
            ->updateContent();

        return 0;
    }
}
