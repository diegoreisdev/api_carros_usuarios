<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class ValidateDataMiddleware
 * @package App\Http\Middleware
 */
class ValidateDataMiddleware
{

    /* MÉTODO RESPONSÁVEL PELA VALIDAÇÃO
    ***************************************************************************************/
    public function handle(Request $request, \Closure $next)
    {
        $validate = $this->validate($request);
        $response = [
            'status_code'       => 400,
            'error'             => true,
            'error_message'     => 'Dados Inválidos',
            'error_description' => $validate->messages()
        ];

        /* Verifica se as validações foram aprovadas */
        if ($validate->passes()) {
            $response = $next($request);
        }

        return $response;
    }

    /* MÉTODO RESPONSÁVEL PELA VALIDAÇÃO DA MODEL
    ***************************************************************************************/
    private function defineModel(string $namespace): ?Model
    {
        $model = null;

        if (class_exists($namespace)) {
            $model = new $namespace();
        }
        return $model;
    }

    /* MÉTODO RESPONSÁVEL EM BUSCAR AS REGRAS
    ***************************************************************************************/
    private function validate(Request $request)
    {
        $alias = $request->route()[1]['as'];
        $model = $this->defineModel($alias);

        if (empty($model)) {
            throw new \InvalidArgumentException('A model ' . $alias . ' não existe.');
        }

        return Validator::make(
            $request->toArray(),
            $model->rules
        );
    }
}
