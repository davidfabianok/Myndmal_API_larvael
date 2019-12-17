<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Mostrar una lista del recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::select('products.*', 'categories.name as name_category')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $products,
        ]);

        //todo poner en un try catch
    }

    /**
     * Almacene un recurso recién creado en el almacenamiento.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'category_id' => 'numeric|required',
            'title' => 'required|min:3|unique:products,title|max:200',
            'description' => 'string|nullable',
            'price' => 'numeric|required',
            'stock' => 'numeric|nullable',
            'image' => 'string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => $validator->messages(),

            ]);
        }

        try {

            Product::create($input);
            return response()->json([
                'success' => true,
                'message' => 'El producto se agrego con exito',
            ]);

        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'error' => $ex->getMessage(),
            ]);
        }

    }

    /**
     * Mostrar el recurso especificado.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = Product::select('products.*', 'categories.name as name_category')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('products.id', $id)
            ->first();

        return response()->json([
            'success' => true,
            'data' => $products,
        ]);
    }

    /**
     * Actualiza el recurso especificado en el almacenamiento.
     *
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'category_id' => 'numeric|required',
            'title' => 'required|min:3|unique:products,title|max:200',
            'description' => 'string|nullable',
            'price' => 'numeric|required',
            'stock' => 'numeric|nullable',
            'image' => 'string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => $validator->messages(),
            ]);
        }

        try {

            $product = Product::find($id);
            if($product == false){
                return response()->json([
                    'success' => false,
                    'error' => 'El producto no se encontro',
                ]);
            }

            $product->update($input);

            return response()->json([
                'success' => true,
                'message' => 'El producto se actualizo con exito',
            ]);

        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'error' => $ex->getMessage(),
            ]);
        }
    }

    /**
     * Eliminar el recurso especificado del almacenamiento.
     *
     * @param $id
     * @return void
     */
    public function destroy($id)
    {
        try {

            $product = Product::find($id);
            if($product == false){
                return response()->json([
                    'success' => false,
                    'error' => 'El producto no se encontro',
                ]);
            }

            $product->update([
                'state' => $product->state == 1 ? 0 : 1
            ]);

            return response()->json([
                'success' => true,
                'message' => 'El producto se actualizo con exito',
            ]);

        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'error' => $ex->getMessage(),
            ]);
        }
    }
}
