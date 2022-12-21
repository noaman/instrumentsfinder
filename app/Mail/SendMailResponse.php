<?php

namespace App\Mail;

use App\products_master;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;



class SendMailResponse extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $recepient;
    public $emailMsg;

    public $lead_data;
    public function __construct($recepient,$emailMsg,$leadData)
    {
        $this->recepient = $recepient;
        $this->emailMsg = $emailMsg;
        $this->lead_data=$leadData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {


        $shipping = $this->lead_data["lead"]["country_shipping"];
        $rfqID = $this->lead_data["lead"]["order_id"];

        $leadfrom = $this->lead_data["lead"]["email"];
        //foreach($lead_data["products"] as $Product_in_Lead)
        //$Product_in_Lead = $this->lead_data["products"]["name"].$Product_in_Lead.", ";
        //endforeach

        $product_in_Lead='';

        foreach($this->lead_data["products"] as $product)
        {
            //$Product_in_Lead = $this->lead_data["products"]["name"].$Product_in_Lead.", ";
            $product_in_Lead .= $product["name"].", ";
        }

        return $this->from("enquiry@agisafety.com", "InstrumentFinder Team")
        ->subject("InstrumentsFinder.com RFQ-".$rfqID." Ship to : ".$shipping." Product : ".$product_in_Lead)
        ->view('email.emailresponsetemplate')->with('emailMsg', $this->emailMsg);;

    }
}
