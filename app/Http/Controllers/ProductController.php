<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateproductRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    
    {
        $products =Product::all()->sortByDesc("created_at");
        //dd($products);
        return  view('products.indexProduct',compact('products'));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }


    public function store(Request $request)
    {
        
        $request->validate([
            'titre'=>'required|string|max:255   ',
            'image_path'=>'required|mimes:jpg,png,jpeg|max:5040',
            'prix_achat'=>'required|numeric',
            'prix_vente'=>'required|numeric',
            'quantite'=>'required|numeric',
           
            
        ]);
       
        $newImageName = time().'-'.$request->titre .'.'.$request->image_path->extension(); 
     
        $request->image_path->move(public_path('images'), $newImageName);
        
        
        $produit = new Product();
        
        $produit = Product::create([
            
            'titre'=> $request->titre,
            'prix_achat'=> $request->prix_achat,
            'prix_vente'=> $request->prix_vente,
            'quantite'=> $request->quantite,
        
            'created_at' => Carbon::now(),
            'user_id'=> Auth::user()->id,
            'image_path'=> $newImageName,   
        ]);

        if($produit->save()){

            return redirect('/home')->with('product_created','Le produit a été ajouter avec succès');
        }else{
            return redirect('/home')->with('product_created_fail','Le produit n\'a pas pu  etre ajouter');

        }

    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::where('id',$id)->first();
  
        return  view('products.editProduct',compact('product'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateproductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product $product)
    {
        
        $request->validate([
            'titre'=>'required|string|max:255   ',
            'image_path'=>'required|mimes:jpg,png,jpeg|max:5040',
            'prix_achat'=>'required|numeric',
            'prix_vente'=>'required|numeric',
            'quantite'=>'required|numeric',
           
            
        ]);

        $oldPath =$product->image_path;

        $newImageName = time().'-'.$request->titre .'.'.$request->image_path->extension(); 
        
        $request->image_path->move(public_path('images'), $newImageName);

        try{
            
            Product::where('id',$product->id)->update([
            'titre'=> $request->titre,
            'prix_achat'=> $request->prix_achat,
            'prix_vente'=> $request->prix_vente,
            'quantite'=> $request->quantite,
            'image_path'=> $newImageName,   

        ]);
        if(File::exists('images/'.$oldPath)) {
            File::delete('images/'.$oldPath);
        }
        
        return   redirect('/home')->with('product_update','Le produit a été mis à jour avec succès');

    
    } catch (Throwable $e){
        return   redirect('/home')->with('product_update_fail','Le produit n\'a pas pu etre mis à jour');
    }
        
     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $oldPath = $product->image_path;
        if($product->delete($product)){

            if(File::exists('images/'.$oldPath)) {
                File::delete('images/'.$oldPath);
            }
            return   redirect('/home')->with('product_update','Le produit a été supprimé avec succès');
        }else{
            return   redirect('/home')->with('product_update_fail','Le produit n\'a pas pu etre supprimer');
        }
    }
}
