<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('items')->where('user_id', auth()->id())->get();

        return inertia('Invoice/Index', [
            'invoices' => $invoices
        ]);
    }

    public function create()
    {
        return inertia('Invoice/Create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'invoice_number' => 'required|numeric|integer',
            'invoice_date' => 'required|date|date_format:Y-m-d',
            'due_date' => 'required|date|date_format:Y-m-d',
            'from' => 'required',
            'bill_to' => 'required',
            'terms' => 'required',
//            'ship_to' => 'required',
            'items.*.quantity' => 'required|numeric|integer',
            'items.*.description' => 'required',
            'items.*.unit_price' => 'required|numeric',
        ]);

        $invoice = new Invoice();
        $invoice->user_id = auth()->id();
        $invoice->number = $request->invoice_number;
        $invoice->invoice_date = $request->invoice_date;
        $invoice->due_date = $request->due_date;
        $invoice->from = $request->from;
        $invoice->bill_to = $request->bill_to;
        $invoice->ship_to = $request->ship_to;
        $invoice->terms = $request->terms;
        $invoice->save();

        foreach ($request->items as $item) {

            $invoiceItem = new InvoiceItem();
            $invoiceItem->invoice_id = $invoice->id;
            $invoiceItem->quantity = $item['quantity'];
            $invoiceItem->description = $item['description'];
            $invoiceItem->unit_price = $item['unit_price'];
            $invoiceItem->save();
        }

        return Redirect::route('invoices.index');
    }

    public function print(Invoice $invoice)
    {
        $pdf = PDF::loadView('pdfs.invoices.template_default', [
            'invoice' => $invoice
        ]);
        return $pdf->stream('invoice.pdf');
    }
}
