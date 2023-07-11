<?php

namespace App\Controllers;

use App\Controller;
use \App\Models\Product as ProductModel;

class Product extends Controller 
{

    public function __invoke($view)
	{

        if ($_SERVER["REQUEST_METHOD"] == 'GET') {
            $ctrlArray = \App\Controllers\ControllerFunctions::ctrlArray();
            if (count($ctrlArray) > 2) {
                header('Content-Type: application/json');
                if($ctrlArray[2] == 'all'){
                    http_response_code(200);
                    $data = [];
                    $dataToDo = \App\Models\Product::findAll();
                    foreach ($dataToDo as $key => $value) {
                        $data[] = json_decode(json_encode($dataToDo[$key]));
                    }
                    echo json_encode($data);
                    exit;
                }
                else{
                    echo json_encode('Bad request');
                    http_response_code(400);
                    exit;
                }
            }
        }
        
        if ($_SERVER["REQUEST_METHOD"] == 'POST') {
            header('Content-Type: application/json');

            
            $fn = array_key_first($_FILES);
            $answer = json_encode('Something went wrong');
            http_response_code(400);


            if (count($_FILES)) {
                
                $this->configArr = (include __DIR__ . '/../../config.php');
				$dir = $this->configArr['dir'];
                
				$tempFile = '';
				// if (!file_exists($dir.'\FILES')) { 
                //     http_response_code(503);
                //     $answer = json_encode('No folder to copy file');
                // }
                // else
                if ($_FILES[$fn]["error"] != 0) {
                    http_response_code(409);
                    $answer = json_encode('Error copying file on server');
                }
                else{
                    $tempFile = $dir . '/FILES/' . $_FILES[$fn]['name'];
					if (move_uploaded_file($_FILES[$fn]['tmp_name'], $tempFile)) {
                        http_response_code(200);
                        $answer = json_encode('File copied');
						$product = new ProductModel;
        				$product->parseAndCreate($tempFile);
                        
						
					}
					else{
                        http_response_code(409);
                        $answer = json_encode('File copy error');
					}
				}	
			} 

            if(array_key_exists('HTTP_REFERER', $_SERVER)){

                if (substr_count($_SERVER["HTTP_REFERER"], \App\Controllers\ControllerFunctions::homePath())) {
                    header('Location: '.\App\Controllers\ControllerFunctions::homePath()."/home/add");
                } 

            }
            else{
                echo $answer;
            }
            
        }
        else{

            $view->assignConst();
            $this->assign($view);
            $view->renderAndAssign('footer', '/Templates/');
            
            $classNameArray = explode('\\',static::class);
            $template = end($classNameArray);
            
            $this->configArr = (include __DIR__ . '/../../config.php');
			$dir = $this->configArr['dir'];
            
            $view->display($dir . '/App/Templates/' .strtolower($template).'.php');
        }

    }
    

}
