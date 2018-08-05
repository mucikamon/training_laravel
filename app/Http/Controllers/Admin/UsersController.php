<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User as UserMod;
use App\Model\Shop as ShopMod;
use App\Model\Product as ProductMod;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // return view('test')->with('name', 'My Name')
       //                     ->with('email', 'My Name@gmail');



       // $data = [
       //      'name' => 'My Name',
       //      'surname' => 'My SurName',
       //      'email' => 'myemail@gmail.com'
       //  ];

       //  $item = [
       //      'item1' => 'My Value1',
       //      'item2' => 'My Value2'
       //  ];

       //  $results = [
       //      'data' => $data,
       //      'item' => $item
       //  ];

       //  return view('test', $results);


      // $data = [
      //      'name' => 'My Name',
      //      'surname' => 'My SurName',
      //      'email' => 'myemail@gmail.com'
      //  ];


      //     $user = UserMod::find(1);
      //    $mods = UserMod::all();
      //   return view('test', compact('data', 'user', 'mods'));
              
        $mods = UserMod::orderBy('id','desc')->paginate(10);
        return view('admin.user.lists' ,compact('mods'));

        // return view('admin.user.lists');



        //
       // $mods = UserMod::where('active', 1)
       //          ->where('city','bangkok')
       //         ->orderBy('name', 'desc')
       //         // ->take(10)
       //         ->get();

        // $mods = UserMod::find([1, 2, 3,5]);
                
        // foreach ($mods as $item) {
        //     echo $item->name." ".$item->surname." ".$item->email."<br />";
        // }

       // $count = UserMod::where('active', 1)->count();
       // echo "Total =  $count";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //  
        // $mod = new UserMod;
        // $mod->name = $request->name;
       
        //  $mod->password = bcrypt ($request->password);
        // $mod->email = $request->email;
        // $mod->save();
           request()->validate([
            'name' => 'required|min:2|max:50',
            'surname' => 'required|min:2|max:50',
            'mobile' => 'required|numeric',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'age' => 'required|numeric',
            'confirm_password' => 'required|min:6|max:20|same:password',
            ], [
            'name.required' => 'Name is required',
            'name.min' => 'Name must be at least 2 characters.',
            'name.max' => 'Name should not be greater than 50 characters.',
             ]);

        $mod = new UserMod;
        $mod->email    = $request->email;
        $mod->password = bcrypt($request->password);
        $mod->name     = $request->name;
        $mod->surname  = $request->surname;
        $mod->mobile   = $request->mobile;
        $mod->age      = $request->age;
        $mod->address  = $request->address;
        $mod->city     = $request->city;
        $mod->save();

        

        return redirect('admin/users')
                    ->with('success', 'User ['.$request->name.'] created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // echo "<br />";
        // $mod = UserMod::find($id);

        // echo $mod->name." ".$mod->surname." ".$mod->shop->name;
        //  echo "<br />";
        //  $shop = UserMod::find($id)->shop;
        //  echo $shop->name;

        // $mod = ShopMod::find($id);
        // echo $mod->name;

        // echo "<br />";
        // echo $mod->user->name;    

        // $products = ShopMod::find($id)->products;
 
        // foreach ($products as $product) {
        //     echo $product->name;
        //    echo "<br />";
        //  }

        //  echo "OR <br />";


        // $shop = ShopMod::find($id);
        // echo $shop->name;
        // echo "<br />";
        // foreach ($shop->products as $product) {
        //     echo $product->name;
        //    echo "<br />";
        //  }
        $product = ProductMod::find($id);
        echo "<br />";
        echo "product name is".$product->name;
        echo "<br />";
        echo "shop owner is".$product->shop->name;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $item = UserMod::find($id);
         return view('admin.user.edit',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        // $mod = UserMod::find($id);
         
        // $mod->name = $request->name;
        // $mod->password = bcrypt ($request->password);
        // $mod->email = $request->email;
        // $mod->save();
        // echo "Suscess";

         request()->validate([
            'name' => 'required|min:2|max:50',
            'surname' => 'required|min:2|max:50',
            'mobile' => 'required|numeric',
            'age' => 'required|numeric',
        ], [
            'name.required' => 'Name is required',
            'name.min' => 'Name must be at least 2 characters.',
            'name.max' => 'Name should not be greater than 50 characters.',
        ]);

        $mod = UserMod::find($id);
        $mod->name     = $request->name;
        $mod->surname  = $request->surname;
        //$mod->email    = $request->email;
        $mod->mobile   = $request->mobile;
        $mod->surname  = $request->surname;
        $mod->age      = $request->age;
        $mod->address  = $request->address;
        $mod->city     = $request->city;
        $mod->save();

        return redirect('admin/users')
                    ->with('success', 'User ['.$request->name.'] updated successfully.');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $mod = UserMod::find($id);
        $mod->delete();


    return redirect('admin/users')
                    ->with('success', 'User ['.$id.'] updated successfully.');

    }
}
