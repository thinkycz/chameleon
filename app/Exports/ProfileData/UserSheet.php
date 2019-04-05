<?php

namespace App\Exports\ProfileData;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class UserSheet implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return Builder
     */
    public function collection()
    {
        return collect([[
            $this->user->email,
            $this->user->first_name,
            $this->user->last_name,
            $this->user->phone,
        ]]);
    }

    public function headings(): array
    {
        return [
            trans('exports.email'),
            trans('exports.first_name'),
            trans('exports.last_name'),
            trans('exports.phone'),
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return trans('exports.personal');
    }
}
