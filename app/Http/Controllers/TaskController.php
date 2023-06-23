<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
     
    }



    public function index(Request $request)
    {

        /*
 * Using collection pipeline programming, find the employee who made
 * the most valuable sale.
 *
 * Do not use any loops, if statements, or ternary operators.
 *
 * 
 */

        $employees = collect([
            [
                'name' => 'John',
                'email' => 'john3@example.com',
                'sales' => [
                    ['customer' => 'The Blue Rabbit Company', 'order_total' => 7444],
                    ['customer' => 'Black Melon', 'order_total' => 1445],
                    ['customer' => 'Foggy Toaster', 'order_total' => 700],
                ],
            ],
            [
                'name' => 'Jane',
                'email' => 'jane8@example.com',
                'sales' => [
                    ['customer' => 'The Grey Apple Company', 'order_total' => 203],
                    ['customer' => 'Yellow Cake', 'order_total' => 8730],
                    ['customer' => 'The Piping Bull Company', 'order_total' => 3337],
                    ['customer' => 'The Cloudy Dog Company', 'order_total' => 5310],
                ],
            ],
            [
                'name' => 'Dave',
                'email' => 'dave1@example.com',
                'sales' => [
                    ['customer' => 'The Acute Toaster Company', 'order_total' => 1091],
                    ['customer' => 'Green Mobile', 'order_total' => 2370],
                ],
            ],
        ]);

   

        $keyed = $employees->map(function ($item, $key) {
            return collect(["total"=>collect($item['sales'])->sum('order_total'),"name"=>$item['name']]);
        });
        $keyed->all();
        $maxvalue= collect($keyed)->max()["name"];
        

        /*
 * Using collection pipeline programming, calculate ranks for the given teams based on their respective scores. Same scores should be ranked equally
 * If multiple teams get the same rank, the next ranks should be skipped based on the team count.
 * e.g. If Team B & C gets second rank, 3rd rank should skipped & the team eligible for the 3rd rank should be given 4th rank.
 *
 * Do not use any loops, if statements, or ternary operators.
 */
        $scores = collect ([
            ['score' => 76, 'team' => 'A'],
            ['score' => 62, 'team' => 'B'],
            ['score' => 82, 'team' => 'C'],
            ['score' => 86, 'team' => 'D'],
            ['score' => 91, 'team' => 'E'],
            ['score' => 67, 'team' => 'F'],
            ['score' => 67, 'team' => 'G'],
            ['score' => 82, 'team' => 'H'],
        ]);

        $sorted = $scores->sortBy([
            ['score', 'desc']
        ]);
        $sorted= $sorted->values()->all();
       $unique = collect($sorted)->unique("score");
       $counted = collect($sorted)->countBy('score');
       $dupi = collect($sorted)->duplicatesStrict('score');
       print_r("Ranking <br>");
       $rankpreces = $unique->map(function ($item, $key) use($counted,$dupi ){
           
        print_r(str_repeat("Team ".$item["team"]." - ".($key+1).'<br>',$counted[$item["score"]])) ;
        $key += $counted[$item["score"]];
       });

       	
		/*
 * Download the sample sql dataset from https://www.mysqltutorial.org/wp-content/uploads/2018/03/mysqlsampledatabase.zip
 * Write controllers to find the first customer who spent more money on orders & the first customer who has highest number of orders.
 * Use Eloquent, Relationships, SQL Query Optimisation methods. Code execution time and the memory used would be assessed here.
 */
    $privilaged_users = Customer::leftJoin('orders', 'orders.customerNumber',"=", 'customers.customerNumber')
                ->select('customers.customerName',DB::raw('count(orders.orderNumber) as orders_total'))
                     ->groupBy('customers.customerNumber')->orderBy("orders_total", 'desc') 
                    ->first();

    $highest=$privilaged_users["customerName"];

    $privilaged_users1 = Customer::leftJoin('orders', 'orders.customerNumber',"=", 'customers.customerNumber')->leftJoin('orderdetails', 'orders.orderNumber',"=", 'orderdetails.orderNumber')
    ->select('customers.customerName',DB::raw('sum(orderdetails.priceEach) as orders_total'))
    ->groupBy('customers.customerNumber')->orderBy("orders_total", 'desc') 
    ->first();

    $highes_amt= $privilaged_users1["customerName"];
    return view('result',compact('employees','maxvalue','scores','highest',"highes_amt"));
    }


}