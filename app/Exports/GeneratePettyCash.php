<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

use App\Models\PettyCashInfo; 
class GeneratePettyCash implements FromCollection
{
	protected $id;

	function __construct($id){
		
		$this->id =$id;
	}
    /**
    * @return \Illuminate\SWFSound(filename)upport\Collection
    */
    public function collection()
    {

        return PettyCashInfo::where('petty_cash_id', $this->id)->get();
    }
}
