<?php

namespace RomanAPI\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use RomanAPI\RomanConversion;
use RomanAPI\IntegerConversion;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use RomanAPI\Transformers\RomanTransformer;

class RomanController extends Controller
{
	/**
     * @var Manager
     */
    private $fractal;

    /**
     * @var RomanTransformer
     */
    private $romanTransformer;

    function __construct(Manager $fractal, RomanTransformer $romanTransformer)
    {
        $this->fractal = $fractal;
        $this->romanTransformer = $romanTransformer;
    }

    /**
     * Display the roman Numeral for the given number in the url.
     *
     * @param   $integer  
     * @return  $romanNumeral
     */
    public function index($integer)
    {
    	$convert = new IntegerConversion();
    	if ($convert->isValid($integer)) {
    		$romanNumeral = $convert->toRomanNumerals($integer) ;
    		$record = $this->update($integer);
    		if($record == 0) {
    			$this->store($integer, $romanNumeral);
    		}

    		return $romanNumeral; 
    	}
    }

    /**
     * Save the new records in the storage.
     *
     * @param  $integer, $romanNumeral  
     * @return $roman;
     */
    public function store($integer, $romanNumeral)
    {
    	$roman = new RomanConversion;

        $roman->integer = intval($integer);
        $roman->roman = $romanNumeral;
        $roman->save();

        return $roman;

    } 

     /**
     * Show all the records from the storage.
     *
     * 
     * @return $datas
     */
    public function showAll()
    {
       $datas = RomanConversion::select('integer', 'roman')
        ->orderBy('updated_at','DESC')
        ->get();

        $datas = new Collection($datas, $this->romanTransformer); // Create a resource collection transformer
        $datas = $this->fractal->createData($datas);
        return $datas->toArray();
    }


    /**
     * Show top 10 recent search records from the storage.
     *
     * @return $datas
     */
    public function recentSearches()
    {
       $datas = RomanConversion::select('integer', 'roman')
       ->orderBy('count','DESC')
       ->take(10)
        ->get();

        $datas = new Collection($datas, $this->romanTransformer); // Create a resource collection transformer
        $datas = $this->fractal->createData($datas);
        return $datas->toArray();

    }

    /**
     * Update the record in the storage.
     *
     * @param  $integer
     * @return updation
     */
    public function update($integer)
    {
        return RomanConversion::where('integer',$integer)
        ->increment('count');;

    }
}
