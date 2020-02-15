<?php

namespace App\Http\Controllers;

use Aws\Sqs\SqsClient; 
use Aws\Exception\AwsException;
use Illuminate\Http\Request;

class MeliController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
	
	public function enviaSQS( Request $request ){
		
		//dd( $request->all() );
		
		$client = SqsClient::factory([
			'credentials' => [ 'key' => 'AKIAQPFHDWZWVYYDFF6Y'
									, 'secret' => '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' ],
			'region' => 'us-east-1',
			'version' => '2012-11-05'
		]);
		
		$params = [
			
			'MessageAttributes' => [
				"titulo" => [
					'DataType' => "String",
					'StringValue' => $request->titulo
				],
				"categoria" => [
					'DataType' => "String",
					'StringValue' => $request->categoria
				],
				"preco" => [
					'DataType' => "String",
					'StringValue' => $request->preco
				],
				"quantidade" => [
					'DataType' => "String",
					'StringValue' => $request->quantidade
				],
				"descricao" => [
					'DataType' => "String",
					'StringValue' => $request->descricao
				],
				"token" => [
					'DataType' => "String",
					'StringValue' => $request->token
				],
				"fotos" => [
					'DataType' => "String",
					'StringValue' => json_encode( $request->fotos )
				]
			],
			'MessageBody' => "Invocacao do MAU.",
			'QueueUrl' => 'https://sqs.us-east-1.amazonaws.com/032562722413/sqstreinamento'
		];
		
		try {
			
			$result = $client->sendMessage($params);
			dump('DISPARADO');
			
			
		} catch (AwsException $e) {
			// output error message if fails
			dd($e->getMessage());
		}catch(Exception $e){
			dd($e->getMessage());
			}
		 
		
		dd('funcionando blau blau');
	
		
	}

    //
}
