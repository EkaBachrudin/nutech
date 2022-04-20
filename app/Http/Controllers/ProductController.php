<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request){

        $search =  $request->search;
        if(!$search){
            $products = Product::latest()->paginate(10);
        }
        else{
            $products = Product::where(function ($query) use ($search){
                $query->where('namaBarang', 'like', '%'.$search.'%');
            })
            ->paginate(10);
        }
        
        return view('welcome', compact('products'));
    }
    public function create(Request $request){
        $validated = $request->validate([
            'namaBarang' => 'required|unique:products',
            'hargaBeli' => 'required',
            'hargaJual' => 'required',
            'stok'  => 'required',
            'gambar' => 'required|mimes:png,jpg,jpeg|max:100',
        ]);
        
        // $data = new Product();
 
        // $data->image = $request->gambar;
        // if($data->image){
        //         try {
        //             $filePath = $this->UserImageUpload($data->image); //Passing $data->image as parameter to our created method
        //             $data->image = $filePath;
        //     } catch (Exception $e) {
        //         //Write your error message here
        //     }
        // }

        $image_name = Str::random(20);
        $ext = strtolower($request->gambar->getClientOriginalExtension()); // You can use also getClientOriginalName()
        $image_full_name = $image_name.'.'.$ext;
        $upload_path = 'image/';    //Creating Sub directory in Public folder to put image
        $image_url = $upload_path.$image_full_name;
        $success = $request->gambar->move($upload_path,$image_full_name);

        
        $product = Product::create([
            'namaBarang'    => $validated['namaBarang'],
            'hargaBeli'     => str_replace('.', '', $validated['hargaBeli']),
            'hargaJual'     => str_replace('.', '', $validated['hargaJual']),
            'stok'          => $validated['stok'],
            'gambar'        => $image_url,
        ]);
        return back();
    }

    public function getData($id){
        $product = Product::find($id);
        return response()->json([
            'product' => $product
        ]);
    }

    public function update($id, Request $request){
        $validated = $request->validate([
            'namaBarang' => 'required',
            'hargaBeli' => 'required',
            'hargaJual' => 'required',
            'stok'  => 'required',
            'gambar' => 'mimes:png,jpg,jpeg|max:100',
        ]);
        
        // $data = new Product();
 
        // $data->image = $request->gambar;
        // if($data->image){
        //         try {
        //             $filePath = $this->UserImageUpload($data->image); //Passing $data->image as parameter to our created method
        //             $data->image = $filePath;
        //     } catch (Exception $e) {
        //         //Write your error message here
        //     }
        // }

        if($request->gambar){
            $image_name = Str::random(20);
            $ext = strtolower($request->gambar->getClientOriginalExtension()); // You can use also getClientOriginalName()
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'image/';    //Creating Sub directory in Public folder to put image
            $image_url = $upload_path.$image_full_name;
            $success = $request->gambar->move($upload_path,$image_full_name);

            $product = Product::find($id)->update([
                'namaBarang'    => $validated['namaBarang'],
                'hargaBeli'     => str_replace('.', '', $validated['hargaBeli']),
                'hargaJual'     => str_replace('.', '', $validated['hargaJual']),
                'stok'          => $validated['stok'],
                'gambar'        => $image_url,
            ]);
        }else{
            $product = Product::find($id)->update([
                'namaBarang'    => $validated['namaBarang'],
                'hargaBeli'     => str_replace('.', '', $validated['hargaBeli']),
                'hargaJual'     => str_replace('.', '', $validated['hargaJual']),
                'stok'          => $validated['stok'],
            ]);
        }
        return back();
    }

    public function delete($id){
        $product = Product::find($id);
        $product->delete();
        return response()->json([
            'data' => 'success', 
        ]);
    }
}
