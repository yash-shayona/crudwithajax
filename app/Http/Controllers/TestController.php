<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function prodtocat()
    {
        $prod = Product::with('category')->get()->toArray();
        echo "<pre>";
        print_r($prod);
    }

    public function foreach()
    {
        $prod = Product::all()->where('status',1)->toArray();
        echo "<pre>";
        foreach ($prod as $v) {
            foreach ($v as $key => $value) {
                // echo $value;
                echo '['.$key.']->' . $value.'  ';
                echo "<br>";
            }
            echo "<br><br>";
        }
    }

    public function js(){
        echo "<!DOCTYPE html><a href='#'>hello</a><script>console.log(document.anchors);</script>";
        echo "<script>console.log(document.baseURI);</script>";
        echo "<script>console.log(document.body);</script>";
        echo "<script>console.log(document.cookie);</script>";
        echo "<script>console.log(document.doctype);</script>";
        echo "<script>console.log(document.documentElement);</script>";
        echo "<script>console.log(document.documentMode);</script>";
        echo "<script>console.log(document.documentURI);</script>";
        echo "<script>console.log(document.domain);</script>";
        echo "<script>console.log(document.head);</script>";
        echo "<script>console.log(document.implementation);</script>";
        echo "<script>console.log(document.inputEncoding);</script>";
        echo "<script>console.log(document.lastModified);</script>";
        echo "<script>console.log(document.links);</script>";
        echo "<script>console.log(document.readyState);</script>";
        echo "<script>console.log(document.referrer);</script>";
        echo "<script>console.log(document.scripts);</script>";
        echo "<script>console.log(document.strictErrorChecking);</script>";
        echo "<title>Title</title><script>console.log(document.title);</script>";
        echo "<script>console.log(document.URL);</script>";
    }
}
