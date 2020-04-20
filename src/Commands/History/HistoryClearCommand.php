<?php

namespace Jakmall\Recruitment\Calculator\Commands\History;

use Illuminate\Console\Command;
use Jakmall\Recruitment\Calculator\Repository\HistoryRepository as History;

class HistoryClearCommand extends Command
{
    public function __construct()
    {
        $this->signature = "history:clear";
        $this->description = "Clear saved history";
        parent::__construct();
    }

    public function handle(): void
    {
        History::clearHistory();
        $this->comment("History cleared.");
        return;
    }
}
