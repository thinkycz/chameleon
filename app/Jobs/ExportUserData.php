<?php

namespace App\Jobs;

use App\Exports\ProfileDataExport;
use App\Mail\ExportedUserDataMail;
use App\Models\User;
use Excel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Storage;

class ExportUserData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function handle()
    {
        $name = $this->name();

        Excel::store(new ProfileDataExport($this->user), $name, 'public');

        $path = Storage::disk('public')->url($name);

        Mail::send(new ExportedUserDataMail($this->user->email, $path));
    }

    protected function name()
    {
        $username = $this->user->email;
        $date = now()->format('Y-m-d');
        $random = str_random(4);
        $extension = '.xls';

        return "exports/{$username}-{$date}-{$random}.{$extension}";
    }
}
