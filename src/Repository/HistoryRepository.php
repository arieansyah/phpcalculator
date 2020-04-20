<?php

namespace Jakmall\Recruitment\Calculator\Repository;

use Illuminate\Console\Command;

class HistoryRepository extends Command
{
    private static $fileName = './history.log';

    public function create(array $data): void
    {
        $data = array_merge($data, array("time" => date("Y-m-d H:i:s")));
        file_put_contents(self::$fileName, json_encode($data) . "\n", FILE_APPEND);
    }

    public function getAll(array $filter = array()): array
    {
        $history = fopen(self::$fileName, 'r');

        $result = [];
        $no = 0;
        while (($file_data = fgets($history)) !== false) {
            $data_array = json_decode($file_data, true);
            if ((empty($filter)) || (in_array(strtolower($data_array["command"]), $filter))) {
                $no++;
                $data = array_merge([$no], $data_array);
                $result[] = array_map(function ($res) {return ucfirst($res);}, $data);
            }
        }
        fclose($history);
        return $result;
    }

    /**
     * @return void
     */
    public function clearHistory(): void
    {
        file_put_contents(self::$fileName, '');
    }
}
