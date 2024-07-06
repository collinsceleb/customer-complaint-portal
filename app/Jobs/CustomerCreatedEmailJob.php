<?php

namespace App\Jobs;

use App\Mail\NewCustomerCreated;
use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class CustomerCreatedEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $customer;
    protected $password;


    /**
     * Create a new job instance.
     */
    public function __construct(Customer $customer, $password)
    {
        $this->customer = $customer;
        $this->password = $password;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->customer->email)->send(new NewCustomerCreated($this->customer, $this->password));
    }
}
