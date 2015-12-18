<?php namespace Modules\Contabilidad\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Modules\Contabilidad\Entities\Sales;
use Modules\Contabilidad\Entities\SalesLog;
use Modules\Contabilidad\Entities\PaymentMethod;
use Carbon\Carbon;

class SalesReadCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'larus:salesRead';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		Log::info('Iniciando proceso de lectura de ventas');
		$disk = Storage::disk("sales");
		$files = $disk->allfiles();
		foreach ($files as $file){
			Log::info('Lectura de archivos para procesar');
			$sales_log = SalesLog::where("file_name", $file)->first();
    		if (!isset($sales_log)){
    			Log::info('Procesando archivo '. $file);
				$contents = $disk->get($file);
				$count = 0;
				$rows = str_getcsv($contents, "\n"); //parse the rows
				foreach ($rows as $row){
					$datas = str_getcsv($row, '|');
					if (count($datas) == 17){
						$sales = new Sales([
							'transaction_id'=>$datas[0],
							'reference'=>$datas[1],
							'ra_start_date'=>$datas[2],
							'ra_end_date'=>$datas[3],
							'factura_uuid'=>$datas[4],
							'ammount'=>$datas[5],
							'credit_debit'=>$datas[6],
							'payment_method'=>$datas[7],
							'ra_total'=>$datas[8],
							'customer_number'=>$datas[9],
							'op_location'=>$datas[10],
							'cl_location'=>$datas[11],
							'gl_account'=>$datas[12],
							'concept'=>$datas[13],
							'description'=>$datas[14],
							'date'=>$datas[15],
							'factura_number'=>$datas[16]
						]);
						$sales->save();
						$count++;
						
						$payment_method = PaymentMethod::where("payment_method", $datas[7])->first();
						if (!isset($payment_method)){
							Log::info('Agregando nuevo metodo de pago '. $datas[7]);
							$payment_method_ = new PaymentMethod([
								'payment_method' => $datas[7]
							]);
							$payment_method_->save();
						}
					}
				}
    			$sales_log_ = new SalesLog([
    				'file_name' => $file,
    				'process' => $count
    			]);
    			$sales_log_->save();
    			Log::info('Archivo procesado '. $file .' renglones procesados ' .$count);
    		}
		}
		Log::info('Finalizando proceso de lectura de ventas');
	}

}
