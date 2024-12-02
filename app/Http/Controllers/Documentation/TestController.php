<?php

namespace App\Http\Controllers\Documentation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="Biblioteca",
 *     version="1.0.0",
 *     description="Documentação da API utilizando Swagger"
 * )
 */
class TestController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/register",
     *     tags={"Cadastrar"},
     *     summary="Retorna Token de autenticação",
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     oneOf={
     *                     	   @OA\Schema(type="string"),
     *                     	   @OA\Schema(type="integer"),
     *                     }
     *                 ),
     *                 example={"name": "Jessica Smith", "email": "jessica@email.com", "senha": 123456}
     *             )
     *         )
     *     ),
     *      @OA\Response(
     *         response=200,
     *         description="Cadastra um Usuario no sistema",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="user",
     *                 type="object",
     *                  @OA\Property(
     *                      property="name",
     *                      type="string",
     *                      example="Jessica Smith"
     *                  ),
     *                  @OA\Property(
     *                      property="email",
     *                      type="string",
     *                      example="Jessica@email.com"
     *                  ),
     *                  @OA\Property(
     *                      property="id",
     *                      type="string",
     *                      example="1"
     *                  ),
     *             ),
     *             @OA\Property(
     *                 property="token",
     *                 type="string",
     *                 example="eyJ0eXAiOi.......fuwwQYb3k"
     *             )
     *         )
     *     )
     * ),
     * @OA\Post(
     *     path="/api/login",
     *     tags={"Login"},
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     oneOf={
     *                     	   @OA\Schema(type="string"),
     *                     	   @OA\Schema(type="integer"),
     *                     }
     *                 ),
     *                 example={"email": "jessica@email.com", "senha": 123456}
     *             )
     *         )
     *     ),
     *      @OA\Response(
     *         response=200,
     *         description="Cadastra um Usuario no sistema",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="token",
     *                 type="string",
     *                 example="eyJ0eXAiOi.......fuwwQYb3k"
     *             )
     *         )
     *     )
     * ),
     * @OA\Get(
     *     path="/api/user/book",
     *     tags={"User Livros"},
     *      @OA\Response(
     *         response=200,
     *         description="Cadastra um Usuario no sistema",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="[]",
     *                 type="array",
     *                 collectionFormat="multi",
     *                 @OA\Items(type="string"),
     *             )
     *         )
     *     )
     * ),
     * @OA\Get(
     *     path="/api/user/book/{id}",
     *     tags={"User Livros"},
     *      @OA\Response(
     *         response=200,
     *         description="Cadastra um Usuario no sistema",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="[]",
     *                 type="array",
     *                 collectionFormat="multi",
     *                 @OA\Items(type="string"),
     *             )
     *         )
     *     )
     *  ),
     * @OA\Post(
     *     path="/api/admin/book/",
     *     tags={"Admin Livros"},
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="title",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="publication_date",
     *                     type="date"
     *                 ),
     *                 @OA\Property(
     *                     property="author",
     *                     oneOf={
     *                     	   @OA\Schema(type="string"),
     *                     }
     *                 ),
     *                 example={"title": "Livro nome", "publication_date": "12-12-2000", "author" : {}}
     *             )
     *         )
     *     ),
     *      @OA\Response(
     *         response=200,
     *         description="Cadastra um Usuario no sistema",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="[]",
     *                 type="array",
     *                 collectionFormat="multi",
     *                 @OA\Items(type="string"),
     *             )
     *         )
     *     )
     *  )
     * @OA\Get(
     *     path="/api/admin/book/{id}",
     *     tags={"Admin Livros"},
     *      @OA\Response(
     *         response=200,
     *         description="Cadastra um Usuario no sistema",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="[]",
     *                 type="array",
     *                 collectionFormat="multi",
     *                 @OA\Items(type="string"),
     *             )
     *         )
     *     )
     *  ),
     * @OA\Get(
     *     path="/api/admin/book",
     *     tags={"Admin Livros"},
     *      @OA\Response(
     *         response=200,
     *         description="Cadastra um Usuario no sistema",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="[]",
     *                 type="array",
     *                 collectionFormat="multi",
     *                 @OA\Items(type="string"),
     *             )
     *         )
     *     )
     *  ),
     * @OA\Put(
     *     path="/api/admin/book/{id}",
     *     tags={"Admin Livros"},
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="title",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="publication_date",
     *                     type="date"
     *                 ),
     *                 example={"title": "Livro nome", "publication_date": "12-12-2000",}
     *             )
     *         )
     *     ),
     *      @OA\Response(
     *         response=200,
     *         description="Cadastra um Usuario no sistema",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="[]",
     *                 type="array",
     *                 collectionFormat="multi",
     *                 @OA\Items(type="string"),
     *             )
     *         )
     *     )
     *  ),
     * @OA\Delete(
     *     path="/api/admin/book/{id}",
     *     tags={"Admin Livros"},
     *      @OA\Response(
     *         response=200,
     *         description="Cadastra um Usuario no sistema",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="[]",
     *                 type="array",
     *                 collectionFormat="multi",
     *                 @OA\Items(type="string"),
     *             )
     *         )
     *     )
     *  ),
     * @OA\Get(
     *     path="/api/admin/author",
     *     tags={"Admin Author"},
     *      @OA\Response(
     *         response=200,
     *         description="Cadastra um Usuario no sistema",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="[]",
     *                 type="array",
     *                 collectionFormat="multi",
     *                 @OA\Items(type="string"),
     *             )
     *         )
     *     )
     *  ),
     * @OA\Get(
     *     path="/api/admin/author/{id}",
     *     tags={"Admin Author"},
     *      @OA\Response(
     *         response=200,
     *         description="Cadastra um Usuario no sistema",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="[]",
     *                 type="array",
     *                 collectionFormat="multi",
     *                 @OA\Items(type="string"),
     *             )
     *         )
     *     )
     *  ),
     * @OA\Post(
     *     path="/api/admin/author",
     *     tags={"Admin Author"},
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="birthday_date",
     *                     type="date"
     *                 ),
     *                 example={"name": "Nome Author", "birthday_date": "12-12-2000",}
     *             )
     *         )
     *     ),
     *      @OA\Response(
     *         response=200,
     *         description="Cadastra um Usuario no sistema",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="[]",
     *                 type="array",
     *                 collectionFormat="multi",
     *                 @OA\Items(type="string"),
     *             )
     *         )
     *     )
     *  ),
     * @OA\Put(
     *     path="/api/admin/author/{id}",
     *     tags={"Admin Author"},
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="birthday_date",
     *                     type="date"
     *                 ),
     *                 example={"name": "Nome Author", "birthday_date": "12-12-2000",}
     *             )
     *         )
     *     ),
     *      @OA\Response(
     *         response=200,
     *         description="Cadastra um Usuario no sistema",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="[]",
     *                 type="array",
     *                 collectionFormat="multi",
     *                 @OA\Items(type="string"),
     *             )
     *         )
     *     )
     *  ),
     * @OA\Delete(
     *     path="/api/admin/author/{id}",
     *     tags={"Admin Author"},
     *      @OA\Response(
     *         response=200,
     *         description="Cadastra um Usuario no sistema",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="[]",
     *                 type="array",
     *                 collectionFormat="multi",
     *                 @OA\Items(type="string"),
     *             )
     *         )
     *     )
     *  ),
     * @OA\Get(
     *     path="/api/user/loan",
     *     tags={"User emprestimo"},
     *      @OA\Response(
     *         response=200,
     *         description="Cadastra um Usuario no sistema",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="[]",
     *                 type="array",
     *                 collectionFormat="multi",
     *                 @OA\Items(type="string"),
     *             )
     *         )
     *     )
     *  ),
     * @OA\Post(
     *     path="/api/user/loan",
     *     tags={"User emprestimo"},
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="loan_date_final",
     *                     type="date"
     *                 ),
     *                 @OA\Property(
     *                     property="book_id",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="cliente_id",
     *                     type="integer"
     *                 ),
     *                 example={"loan_date_final": "12-12-2024", "book_id": "1","cliente_id": "1"}
     *             )
     *         )
     *     ),
     *      @OA\Response(
     *         response=200,
     *         description="Cadastra um Usuario no sistema",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="{}",
     *                 type="array",
     *                 collectionFormat="multi",
     *                 @OA\Items(type="string"),
     *             )
     *         )
     *     )
     *  ),
     * @OA\Get(
     *     path="/api/admin/loan",
     *     tags={"Admin emprestimo"},
     *      @OA\Response(
     *         response=200,
     *         description="Cadastra um Usuario no sistema",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="[]",
     *                 type="array",
     *                 collectionFormat="multi",
     *                 @OA\Items(type="string"),
     *             )
     *         )
     *     )
     *  ),
     * @OA\Get(
     *     path="/api/admin/loan/{id}",
     *     tags={"Admin emprestimo"},
     *      @OA\Response(
     *         response=200,
     *         description="Cadastra um Usuario no sistema",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="[]",
     *                 type="array",
     *                 collectionFormat="multi",
     *                 @OA\Items(type="string"),
     *             )
     *         )
     *     )
     *  ),
     * @OA\Post(
     *     path="/api/admin/loan",
     *     tags={"Admin emprestimo"},
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="loan_date_final",
     *                     type="date"
     *                 ),
     *                 @OA\Property(
     *                     property="book_id",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="cliente_id",
     *                     type="integer"
     *                 ),
     *                 example={"loan_date_final": "12-12-2024", "book_id": "1","cliente_id": "1"}
     *             )
     *         )
     *     ),
     *      @OA\Response(
     *         response=200,
     *         description="Cadastra um Usuario no sistema",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="[]",
     *                 type="array",
     *                 collectionFormat="multi",
     *                 @OA\Items(type="string"),
     *             )
     *         )
     *     )
     *  ),
     */
    public function test(Request $request){
        return response()->json([
          'message' => 'Welcome to the API',
          'data' => $request
        ]);
      }
}
