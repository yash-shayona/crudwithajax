<?php

namespace App\Http\Controllers;

use App\Models\form;
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
        $prod = Product::all()->where('status', 1)->toArray();
        echo "<pre>";
        foreach ($prod as $v) {
            foreach ($v as $key => $value) {
                // echo $value;
                echo '[' . $key . ']->' . $value . '  ';
                echo "<br>";
            }
            echo "<br><br>";
        }
    }

    public function js()
    {
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

    public function sandleavearr()
    {
        $sandleavearr = [
            "2024-02-01" => [
                "day" => "Thursday",
                "company_working" => true,
                "employee_working" => true,
                "note" => "present",
                "isabsent" => false,
                "isleave" => false,
            ],
            "2024-02-02" => [
                "day" => "Friday",
                "company_working" => true,
                "employee_working" => false,
                "note" => "absent",
                "isabsent" => true,
                "isleave" => false,
            ],
            "2024-02-03" => [
                "day" => "Saturday",
                "company_working" => false,
                "employee_working" => false,
                "note" => "saturday week off",
                "isabsent" => false,
                "isleave" => false,
            ],
            "2024-02-04" => [
                "day" => "Sunday",
                "company_working" => false,
                "employee_working" => false,
                "note" => "sunday week off",
                "isabsent" => false,
                "isleave" => false,
            ],
            "2024-02-05" => [
                "day" => "Monday",
                "company_working" => false,
                "employee_working" => false,
                "note" => "company holiday",
                "isabsent" => false,
                "isleave" => false,
            ],
            "2024-02-06" => [
                "day" => "Tuesday",
                "company_working" => true,
                "employee_working" => false,
                "note" => "absent",
                "isabsent" => true,
                "isleave" => false,
            ],
            "2024-02-07" => [
                "day" => "Wednesday",
                "company_working" => true,
                "employee_working" => false,
                "note" => "absent",
                "isabsent" => true,
                "isleave" => false,
            ],
            "2024-02-08" => [
                "day" => "Thursday",
                "company_working" => true,
                "employee_working" => true,
                "note" => "present",
                "isabsent" => false,
                "isleave" => false,
            ],
            "2024-02-09" => [
                "day" => "Friday",
                "company_working" => true,
                "employee_working" => true,
                "note" => "present",
                "isabsent" => false,
                "isleave" => false,
            ],
            "2024-02-10" => [
                "day" => "Saturday",
                "company_working" => false,
                "employee_working" => false,
                "note" => "saturday week off",
                "isabsent" => false,
                "isleave" => false,
            ],
            "2024-02-11" => [
                "day" => "Sunday",
                "company_working" => false,
                "employee_working" => false,
                "note" => "sunday week off",
                "isabsent" => false,
                "isleave" => false,
            ],
            "2024-02-12" => [
                "day" => "Monday",
                "company_working" => true,
                "employee_working" => false,
                "note" => "compassionate leave",
                "isabsent" => false,
                "isleave" => true,
            ],
            "2024-02-13" => [
                "day" => "Tuesday",
                "company_working" => true,
                "employee_working" => false,
                "note" => "compassionate leave",
                "isabsent" => false,
                "isleave" => true,
            ],
            "2024-02-14" => [
                "day" => "Wednesday",
                "company_working" => true,
                "employee_working" => false,
                "note" => "compassionate leave",
                "isabsent" => false,
                "isleave" => true,
            ],
            "2024-02-15" => [
                "day" => "Thursday",
                "company_working" => true,
                "employee_working" => false,
                "note" => "compassionate leave",
                "isabsent" => false,
                "isleave" => true,
            ],
            "2024-02-16" => [
                "day" => "Friday",
                "company_working" => true,
                "employee_working" => false,
                "note" => "compassionate leave",
                "isabsent" => false,
                "isleave" => true,
            ],
            "2024-02-17" => [
                "day" => "Saturday",
                "company_working" => false,
                "employee_working" => false,
                "note" => "saturday week off",
                "isabsent" => false,
                "isleave" => false,
            ],
            "2024-02-18" => [
                "day" => "Sunday",
                "company_working" => false,
                "employee_working" => false,
                "note" => "sunday week off",
                "isabsent" => false,
                "isleave" => false,
            ],
            "2024-02-19" => [
                "day" => "Monday",
                "company_working" => true,
                "employee_working" => false,
                "note" => "casual leave",
                "isabsent" => false,
                "isleave" => true,
            ],
            "2024-02-20" => [
                "day" => "Tuesday",
                "company_working" => true,
                "employee_working" => true,
                "note" => "present",
                "isabsent" => false,
                "isleave" => false,
            ],
            "2024-02-21" => [
                "day" => "Wednesday",
                "company_working" => true,
                "employee_working" => true,
                "note" => "present",
                "isabsent" => false,
                "isleave" => false,
            ],
            "2024-02-22" => [
                "day" => "Thursday",
                "company_working" => true,
                "employee_working" => false,
                "note" => "sick leave",
                "isabsent" => false,
                "isleave" => true,
            ],
            "2024-02-23" => [
                "day" => "Friday",
                "company_working" => true,
                "employee_working" => false,
                "note" => "absent",
                "isabsent" => true,
                "isleave" => false,
            ],
            "2024-02-24" => [
                "day" => "Saturday",
                "company_working" => false,
                "employee_working" => false,
                "note" => "saturday week off",
                "isabsent" => false,
                "isleave" => false,
            ],
            "2024-02-25" => [
                "day" => "Sunday",
                "company_working" => false,
                "employee_working" => false,
                "note" => "sunday week off",
                "isabsent" => false,
                "isleave" => false,
            ],
            "2024-02-26" => [
                "day" => "Monday",
                "company_working" => true,
                "employee_working" => false,
                "note" => "absent",
                "isabsent" => true,
                "isleave" => false,
            ],
            "2024-02-27" => [
                "day" => "Tuesday",
                "company_working" => true,
                "employee_working" => false,
                "note" => "absent",
                "isabsent" => true,
                "isleave" => false,
            ],
            "2024-02-28" => [
                "day" => "Wednesday",
                "company_working" => true,
                "employee_working" => false,
                "note" => "floating leave",
                "isabsent" => false,
                "isleave" => true,
            ],
            "2024-02-29" => [
                "day" => "Thursday",
                "company_working" => true,
                "employee_working" => false,
                "note" => "absent",
                "isabsent" => true,
                "isleave" => false,
            ]
        ];
        $keys = array_keys($sandleavearr);
        // dd($keys);
        echo "<pre>";
        // print_r($sandleavearr);
        echo "</pre>";
        $i = 0;
        $prev = null;
        $arr = [];

        foreach ($sandleavearr as $key => $val) {
            if ($val['company_working'] == false && $val['employee_working'] == false) {
                array_push($arr, $key);
            }
        }
        foreach ($sandleavearr as $key => $val) {
            if ($val['company_working'] == false && $val['employee_working'] == false) {
                $crt = $keys[$i];
                $a = ($i - 1) - 1;
                $prev = $keys[$a];
                $prevs = $keys[$i - 1];
                $next = $keys[$i + 1];
                $nextafternext = $keys[$i + 2];
                if (array_key_exists($prev, $sandleavearr)) {
                    if ($sandleavearr[$prev]['company_working'] == true && $sandleavearr[$prev]['employee_working'] == true) {
                        if (array_key_exists($next, $sandleavearr)) {
                            if ($sandleavearr[$next]['company_working'] == true && $sandleavearr[$next]['employee_working'] == false) {
                                if (in_array($crt, $arr)) {
                                    $index = array_search($crt, $arr);
                                    unset($arr[$index]);
                                }

                                if (in_array($prevs, $arr)) {
                                    $index = array_search($prevs, $arr);
                                    unset($arr[$index]);
                                }
                            }
                        }
                    }
                }

                if (array_key_exists($prev, $sandleavearr)) {
                    if ($sandleavearr[$prev]['company_working'] == true && $sandleavearr[$prev]['employee_working'] == false) {
                        if (array_key_exists($next, $sandleavearr)) {
                            if ($sandleavearr[$next]['company_working'] == true && $sandleavearr[$next]['employee_working'] == true) {
                                if (in_array($crt, $arr)) {
                                    $index = array_search($crt, $arr);
                                    unset($arr[$index]);
                                }

                                if (in_array($prevs, $arr)) {
                                    $index = array_search($prevs, $arr);
                                    unset($arr[$index]);
                                }
                            }
                        }
                    }
                }

                if (array_key_exists($prev, $sandleavearr)) {
                    if ($sandleavearr[$prev]['company_working'] == true && $sandleavearr[$prev]['employee_working'] == false && $sandleavearr[$prev]['day'] == 'Friday') {
                        if (array_key_exists($next, $sandleavearr)) {
                            if ($sandleavearr[$next]['company_working'] == false && $sandleavearr[$next]['employee_working'] == false) {
                                if (array_key_exists($nextafternext, $sandleavearr)) {
                                    if ($sandleavearr[$nextafternext]['company_working'] == true && $sandleavearr[$nextafternext]['employee_working'] == true && $sandleavearr[$nextafternext]['day'] == 'Tuesday') {
                                        // dd($nextafternext);

                                        if (in_array($next, $arr)) {
                                            $index = array_search($next, $arr);
                                            unset($arr[$index]);
                                        }
                                        if (in_array($crt, $arr)) {
                                            $index = array_search($crt, $arr);
                                            unset($arr[$index]);
                                        }

                                        if (in_array($prevs, $arr)) {
                                            $index = array_search($prevs, $arr);
                                            unset($arr[$index]);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                if (array_key_exists($prev, $sandleavearr)) {
                    if ($sandleavearr[$prev]['company_working'] == true && $sandleavearr[$prev]['employee_working'] == true && $sandleavearr[$prev]['day'] == 'Friday') {
                        if (array_key_exists($next, $sandleavearr)) {
                            if ($sandleavearr[$next]['company_working'] == false && $sandleavearr[$next]['employee_working'] == false) {
                                if (array_key_exists($nextafternext, $sandleavearr)) {
                                    if (($sandleavearr[$nextafternext]['company_working'] == true && $sandleavearr[$nextafternext]['employee_working'] == false && $sandleavearr[$nextafternext]['day'] == 'Tuesday') || $sandleavearr[$nextafternext]['company_working'] == true && $sandleavearr[$nextafternext]['employee_working'] == true && $sandleavearr[$nextafternext]['day'] == 'Tuesday') {
                                        // dd($nextafternext);

                                        if (in_array($next, $arr)) {
                                            $index = array_search($next, $arr);
                                            unset($arr[$index]);
                                        }
                                        if (in_array($crt, $arr)) {
                                            $index = array_search($crt, $arr);
                                            unset($arr[$index]);
                                        }

                                        if (in_array($prevs, $arr)) {
                                            $index = array_search($prevs, $arr);
                                            unset($arr[$index]);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $i++;
        }

        echo "</pre>";
        echo "<pre>";
        print_r($arr);
    }

    public function form(Request $request)
    {
        $resp_data['title']='Form Ajax';
        return view('form',$resp_data);
    }

    public function save(Request $req)
    {
        
        $array=$req->all();
        unset($array['_token']);
        $dbid=$array['dbid'];
        if (isset($dbid)) {
            unset($array['dbid']);
            $array['updated_at'] = date('Y-m-d H:i:s');
            $result = form::where('id',$dbid)->update($array);
            if ($result) {
                return response()->json(['status' => 'true', 'message' => 'data updated sucessfully','id'=>(int)$dbid]);
            } else {
                return response()->json(['status' => 'false', 'message' => 'data updated failed']);
            }
        } else {
            unset($array['dbid']);
            $array['created_at'] = date('Y-m-d H:i:s');
            $data = form::where('first_name', $array['first_name'])->where('middle_name', $array['middle_name'])->where('last_name', $array['last_name'])->get()->first();
            if ($data==null) {
                $result = form::insert($array);
                $data = form::where('first_name', $array['first_name'])->where('middle_name', $array['middle_name'])->where('last_name', $array['last_name'])->get()->first();
                $id = $data['id'];
                return response()->json(['status' => 'true', 'message' => 'data inserted sucessfully','id'=>$id]);
            } else {
                return response()->json(['status' => 'false', 'message' => 'data inserted failed']);
            }
        }
    }
}
