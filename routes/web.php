<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Arr;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/values', function (Request $request) {
	
	try{

		$data = $request->all();

	    $redis =  app()->make('redis');
	    
	    if($data){
	    	$keys = explode(',', $data['keys']);
	    }else{
	    	$keys = $redis->keys('*');
	    }

		
	    
	    $values = [];
	    foreach ($keys as $key => $value) {
			$values[$value] = $redis->get($value);
		}

		$data = [
            'status'  => true,
            'data' => $values,
        ];

        return response()->json($data,200);

    }catch(\Exception $e){
        $data = [
            'status'  => false,
            'message' => $e->getMessage(),
        ];

        return response()->json($data, 404);
    }

});



Route::post('/values', function (Request $request) {

	try{
		$data = $request->all();
		$redis =  app()->make('redis');

		foreach ($data as $key => $value) {
			$redis->set($key,$value,"EX",300);
		}

		$data = [
            'status'  => true,
            'message' => 'Values Add Successfully',
        ];

        return response()->json($data,200);

	}
    catch(\Exception $e){
        $data = [
            'status'  => false,
            'message' => $e->getMessage(),
        ];

        return response()->json($data, 404);
    }
});

Route::patch('/values', function (Request $request) {
	
	try{
		$data = $request->all();
		$redis =  app()->make('redis');

		foreach ($data as $key => $value) {
			$redis->set($key,$value,"EX",300);
		}

		$data = [
            'status'  => true,
            'message' => 'Values Update Successfully',
        ];

        return response()->json($data,200);

	}
    catch(\Exception $e){
        $data = [
            'status'  => false,
            'message' => $e->getMessage(),
        ];

        return response()->json($data, 404);
    }
});

