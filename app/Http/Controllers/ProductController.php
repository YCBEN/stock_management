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
            'prix_achat'=>'required|numeric|max:10000000000|min:0', /* numeric validation ne prend pas en considiration la taille alors
            on doit specifier la taille max 10000000000 vu que en base de donnees 
            l attribut est integer et l integer en mysql a un max de 10 chiffres*/

            'prix_vente'=>'required|numeric|min:0', //dans le cas de la validation  numeric sans declaration de taille limit l 'erreur sera elevé par le sgbd comme dans ce cas


            'quantite'=>'required|numeric|max:10000000000|min:0', 
           
           
        ]);
       
        $newImageName = time().'-'.$request->titre .'.'.$request->image_path->extension(); 
     
        $request->image_path->move(public_path('images'), $newImageName);
        
        
        $produit = new Product();
        
        $produit = Product::create([
            
            'titre'=> $request->titre,
            'prix_achat'=> $request->prix_achat,
            'prix_vente'=> $request->prix_vente,
            'quantite'=> $request->quantite,
        
            'created_at' => Carbon::now(), // on peut avoir la forme qu on veut 
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
        $product = Product::where('id',$product->id)->first();
  
        return  view('products.showProduct',compact('product'));
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
            'prix_achat'=>'required|numeric|max:10000000000|min:0',
            'prix_vente'=>'required|numeric|min:0',
            'quantite'=>'required|numeric|max:10000000000|min:0', 
            
        ]);

        

        

        if($request->image_path){
            $request->validate([
                'image_path'=>'required|mimes:jpg,png,jpeg|max:5040',]);

        $oldPath =$product->image_path;

        $newImageName = time().'-'.$request->titre .'.'.$request->image_path->extension(); 
        
        $request->image_path->move(public_path('images'), $newImageName);

       
                
        }else{
            $oldPath =$product->image_path;
            $newImageName = $product->image_path;
        }
        try{
            
            Product::where('id',$product->id)->update([
            'titre'=> $request->titre,
            'prix_achat'=> $request->prix_achat,
            'prix_vente'=> $request->prix_vente,
            'quantite'=> $request->quantite,
            'image_path'=> $newImageName,   

        ]); 

        if($request->image_path){
        if(File::exists('images/'.$oldPath)) {
            File::delete('images/'.$oldPath);
        }} //je veux pas supprimer l'ancienne jusqu'a ce que j'assure         
        
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


    public function search(Request $request){

        $products = Product::where('titre','LIKE','%'.$request->search.'%')->orderBy('created_at','DESC')->get();
       
        return  view('home',compact('products'));
    }
}
