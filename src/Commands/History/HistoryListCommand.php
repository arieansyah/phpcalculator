<?php

namespace Jakmall\Recruitment\Calculator\Commands\History;

use Illuminate\Console\Command;
use Jakmall\Recruitment\Calculator\Repository\HistoryRepository as History;

class HistoryListCommand extends Command
{
    public function __construct()
    {
        $this->signature = "history:list {commands?* : Filter the history by commands}";
        $this->description = "Show Calculator History";

        parent::__construct();
    }

    public function handle(): void
    {
        $this->getHistory($this->argument("commands"));
        return;
    }

    protected function getHistory(array $input)
    {
        $data = History::getAll($input);
        if ($data) {
            $this->table(['No', 'Command', 'Description', 'Result', 'Output', 'Time'], $data);
        } else {
            $this->comment('History is empty');
        }
    }
}
