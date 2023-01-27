<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class MasterExport implements FromView,ShouldAutoSize, WithHeadings, WithEvents
{
    private $records;
    private $cols;
    private $values;
    private $view;
    private $options;

    public function __construct($records, $view = 'master-excel' , $options = [])
    {
        $this->records = $records;
        $this->view = $view;
        $this->options = $options;
        $this->cols  = $this->inArray('cols', []);
        $this->values  = $this->inArray('values', []);
    }

    /**
     * @param $key
     * @param $array
     * @param $value
     * @return mixed
     */
    public function inArray($key, $value)
    {
        $return = array_key_exists($key, $this->options) ? $this->options[$key] : $value;
        return $return;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->setRightToLeft(true);
            },
        ];
    }

    public function view(): View
    {
        return view('admin.export.'.$this->view, [
            'records' => $this->records,
            'cols' => $this->cols,
            'values' => $this->values,
        ]);
    }
 

    /**
     * @return Collection
     */
    public function collection()
    {
        // TODO: Implement collection() method.
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // TODO: Implement headings() method.
    }
}
