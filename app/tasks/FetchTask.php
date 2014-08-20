<?php namespace App\Tasks;

//use Illuminate\Support\Facades\File;
use \Illuminate\Filesystem\Filesystem;

Class FetchTask
{
	public static $path = [
		'jquery' => 'http://code.jquery.com/jquery.js'
	];

	public function run($query = null)
	{
		if(!$query)
		{
			throw new \InvalidArgumentException('Please pass an asset to download.');
		}

		// $this->asset = strtolower($query[0]);

		// if($this->recognizesAsset($this->asset))
		// {
		// 	$content = $this->fetch(static::$path[$this->asset]);
		// 	$this->createFile($this->asset, $content);
		// }
	}

	public function recognizesAsset($asset)
	{
		return array_key_exists($asset, static::$path);
	}

	public function fetch($asset_path)
	{
		return file_get_contents($asset_path);
	}

	public function createFile($asset, $content)
	{
		$file_extension = pathinfo(static::$path[$asset], PATHINFO_EXTENSION);

		if($file_extension === 'js')
		{
			$path = "public/js/vendors/{$asset}.{$file_extension}";
		}

		//File::mkdir(dirname($path));
		//File::put($path, $content);

		$file_system = new Filesystem;

		if(!$file_system::exists($path)){
			throw new Exception("Error Processing Request");			
		}
	}
}