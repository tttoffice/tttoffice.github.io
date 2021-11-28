<?php

namespace App\Exports;

use App\Models\Ticket;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\FromArray;

class TicketsExport implements FromArray , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Ticket code',
            'Employee Name',
            'Module Name',
            'Title',
            'Description',
            'Created At',
            'Status',
            'ClosedBy',
            'ClosedAt'
        ];
    }

    protected $tickets;

    public function __construct(array $tickets)
    {
        $this->tickets = $tickets;
    }

    public function array(): array
    {
        return $this->tickets;
    }
}
