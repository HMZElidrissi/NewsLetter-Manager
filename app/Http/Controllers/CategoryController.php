<?php

namespace App\Http\Controllers;
use App\Models\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index(){
        $categorie =  new Category;
        $categories = $categorie->simplePaginate();
        return view ('categories.index' , compact('categories'));
    }


    public function deleteCategory(Request $request){
        $id = $request->id;
        $categorie =  new Category;
        $categorie->find($id)->delete();
        return redirect('categoriePage')->with('msg' , "La Categorie a ete supprimer avec succes");

    }   

    public function categoriesAddPage(Request $request){
          return view ('categories.create');

}
    public function addcategorie(Request $request){
        $request->validate([
            'name' => 'required',
        ]);
        $categorie = new Category();
        $categorie->name = $request->name;
        $categorie->save();
        return redirect('/categoriePage');

        }

     public function pageUpdateCategory(Request $request){
            $id= $request->id;
            $getcategories = new Category();
            $categorie = $getcategories->find($id);
            return view ('categories.edit' , compact('categorie'));
        }

        public function updateCategory(Request $request){
            $id= $request->id;
            $name = $request->name;
            $getcategories = new Category();
            $category = $getcategories->find($id);
            $category->name = $name;
            $category->update();
            return redirect('/categoriePage');    
    
        }
    }





































//         public function recherchecategorie(Request $request){
//             $search = $request->serch;
//             $categorie = New Categorie();
//

