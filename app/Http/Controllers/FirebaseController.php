<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;


class FirebaseController extends Controller
{
    public function index() {

        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/fir-test-8bc60-firebase-adminsdk-fd6yt-f0c302eade.json');
        $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->withDatabaseUri('https://fir-test-8bc60.firebaseio.com/')
        ->create();
        $database   =   $firebase->getDatabase();
        $createPost    =   $database
        ->getReference('posts')
        ->push([
            'title' =>  'test',
            'body'  =>  'test body'
        ]);
            
        echo '<pre>';
            print_r($createPost->getvalue());
        echo '</pre>';

    }

    public function getData() {
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/fir-test-8bc60-firebase-adminsdk-fd6yt-f0c302eade.json');
        $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->withDatabaseUri('https://fir-test-8bc60.firebaseio.com/')
        ->create();

        $database   =   $firebase->getDatabase();
        $createPost    =   $database->getReference('posts')->getvalue();      
        return response()->json($createPost);
    }
}
