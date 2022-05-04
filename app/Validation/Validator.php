<?php

namespace App\Validation;

class Validator{

    private $data;
    private $errors;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * dynamiquement prend les info de POST et applique des règles de vérification prédéfinies et stocke le résultat dans un tableau par $name reçu du POST
     */
    public function validate(array $rules): ?array
    {
        foreach ($rules as $name => $rulesArray) {
            if (array_key_exists($name, $this->data)) {
                foreach ($rulesArray as $rule) {
                    switch ($rule) {
                        case 'required':
                            $this->required($name, $this->data[$name]);
                            break;
                        case substr($rule, 0, 3) === 'min':
                            $this->min($name, $this->data[$name], $rule);
                            break;
                        default:
                            break;
                    }
                }
            }
        }

        return $this->getErrors();

    }

    /**
     * checks if required key values are filled
     */
    private function required(string $name, string $value)
    {
        $value = trim($value);

        if (!isset($value) || is_null($value) || empty($value)) {
            $this->errors[$name][] = "{$name} est requis.";
        }
    }

    /**
     * on récupère dynamiquement la valeur min du controller pour ensuite check si la chaine de char est superieure au minimum
     */
    private function min(string $name, string $value, string $rule)
    {
        /**
         * On recupere tous les 'digitals' de la chaine de char et on check pour des matchs
         */
        preg_match_all('/(\d+)/', $rule, $matches);

        //limit reçois le nombre passé par le controller
        $limit = (int) $matches[0][0];

        if (strlen($value) < $limit) {
            $this->errors[$name][] = "{$name} doit comprendre un minimum de {$limit} charactères";
        }
    }

    private function getErrors(): ?array
    {
        return $this->errors;
    }

}