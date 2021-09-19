<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SingleInvoices extends Component
{

    public $InvoiceSaved,$InvoiceUpdated;
    public function render()
    {
        return view('livewire.Single_Invoices.single-invoices');
    }
}
