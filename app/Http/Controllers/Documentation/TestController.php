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
     *     @OA\Response(
     *         response=200,
     *         description="Cria um toke de autentiicação",
     *     )
     * )
     */
    public function test(Request $request){
        return response()->json([
          'message' => 'Welcome to the API',
          'data' => $request
        ]);
      }
}
