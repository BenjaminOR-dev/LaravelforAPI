<?php

namespace App\Helpers;

use App\Enums\HttpStatusEnum;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

/**
 * ValidatorHelper class
 *
 * @author Ing. Benjamin Olvera Rosales
 */
class ValidatorHelper
{
    /**
     * Make validation for service.
     *
     * @param bool $returnValidated
     * @param array $data
     * @param array $rules
     * @param array $messages
     * @param array $customAttributes
     * @return array $data
     * @throws \Exception
     * @author Ing. Benjamín Olvera Rosales
     */
    public static function makeForService(bool $returnValidated = true, array $data, array $rules, array $messages = [], array $customAttributes = [])
    {
        $validator = Validator::make($data, $rules, $messages, $customAttributes);
        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            foreach ($errors as $errorKey => $errorValues) {
                $firstError = (object) [
                    'key'     => $errorKey,
                    'message' => $errorValues[0]
                ];
                break;
            }

            abort(HttpStatusEnum::UNPROCESSABLE_ENTITY, "'{$firstError->key}' {$firstError->message}");
        }

        if ($returnValidated) $data = $validator->validated();
        return $data;
    }

    /**
     * Make validation for service VERSION 2.
     * Obtiene los datos requeridos para la validación directamente de la clase request indicada,
     * [NO es compatible con los métodos prepareForValidation ni passedValidation]
     *
     * @param string $classNameRequest
     * @param array $data
     * @param bool $returnValidated
     * @return array
     * @throws \HttpException
     * @author Ing. Benjamín Olvera Rosales
     */
    public static function makeForServiceV2(string $classNameRequest, array $data, bool $returnValidated = true)
    {
        class_exists($classNameRequest) or abort(HttpStatusEnum::INTERNAL_SERVER_ERROR, "Class '{$classNameRequest}' not found.");

        $classRequest               = new $classNameRequest;
        $authorizeMethod            = method_exists($classRequest, 'authorize')  ? $classRequest->authorize()  : true;
        $rulesMethod                = method_exists($classRequest, 'rules')      ? $classRequest->rules()      : [];
        $messagesMethod             = method_exists($classRequest, 'messages')   ? $classRequest->messages()   : [];
        $customAttributesMethod     = method_exists($classRequest, 'attributes') ? $classRequest->attributes() : [];

        if (!$authorizeMethod) abort(HttpStatusEnum::UNAUTHORIZED, 'Unauthorized.');

        $validator = Validator::make($data, $rulesMethod, $messagesMethod, $customAttributesMethod);
        if ($validator->fails()) throw new ValidationException($validator);

        if ($returnValidated) $data = $validator->validated();
        return $data;
    }
}
