<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;



class SendMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $lead_data;
    public function __construct($data)
    {
        $this->lead_data = $data;
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

        $leadfrom = $this->lead_data["lead"]["country_emoji"]."|".$this->lead_data["lead"]["country"];

        $product_in_Lead='';


        foreach($this->lead_data["products"] as $product)
        {
            //$Product_in_Lead = $this->lead_data["products"]["name"].$Product_in_Lead.", ";
            $product_in_Lead .= $product["name"].", ";
        }



        return $this->from("hussainsali@gmail.com", "InstrumentFinder Teams")
        ->subject("InstrumentsFinder.com RFQ-".$rfqID." Ship to : ".$shipping." Product : ".$product_in_Lead)
         ->view('email.emailtemplate');



    }
}
