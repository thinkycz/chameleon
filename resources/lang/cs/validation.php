<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute musí být akceptován.',
    'active_url' => ':attribute není validní URL.',
    'after' => ':attribute musi být doba po :date.',
    'after_or_equal' => ':attribute musí být doba po nebo roven :date.',
    'alpha' => ':attribute může obsahovat jen písma.',
    'alpha_dash' => ':attribute může obsahovat jen písma, čísla, pomlčky and podtržítka.',
    'alpha_num' => ':attribute může obsahovat jen písma, čísla.',
    'array' => ':attribute může obsahovat jen pole.',
    'before' => ':attribute musí být doba před :date.',
    'before_or_equal' => ':attribute musí být doba před nebo roven :date.',
    'between' => [
        'numeric' => ':attribute musí být mezi :min a :max.',
        'file' => ':attribute musí být mezi :min a :max kilobytů.',
        'string' => ':attribute musí být mezi :min a :max charakterů.',
        'array' => ':attribute musí být mezi :min a :max předmětů.',
    ],
    'boolean' => ':attribute pole musí být buď Pravda nebo Nepravda.',
    'confirmed' => ':attribute potvrzení neodpovídá.',
    'date' => ':attribute není validní datum.',
    'date_equals' => ':attribute musí být datum rovno :date.',
    'date_format' => ':attribute neodpovídá formátu :format.',
    'different' => ':attribute a :other musí být odlišntý.',
    'digits' => ':attribute musí být :digits číslic.',
    'digits_between' => ':attribute musí být mezi :min a :max číslic.',
    'dimensions' => ':attribute nemá validní rozměr obrazu.',
    'distinct' => 'Pole :attribute má duplicitní hodnoty.',
    'email' => ':attribute musí být validní emailová adresa.',
    'exists' => 'Zvolený :attribute není validní.',
    'file' => ':attribute musí být soubor.',
    'filled' => 'Pole :attribute musí mít hodnotu.',
    'gt' => [
        'numeric' => ':attribute musí být větší než :value.',
        'file' => ':attribute musí být větší než :value kilobytů.',
        'string' => ':attribute musí být větší než :value charakterů.',
        'array' => ':attribute musí být větší než :value předmětů.',
    ],
    'gte' => [
        'numeric' => ':attribute musí být větší než nebo rovno :value.',
        'file' => ':attribute musí být větší než nebo rovno :value kilobytů.',
        'string' => ':attribute musí být větší než nebo rovno :value charakterů.',
        'array' => ':attribute musí mít :value předmětů nebo více.',
    ],
    'image' => ':attribute musí být obrázek.',
    'in' => 'Vybraný :attribute není validní.',
    'in_array' => 'Pole :attribute neexistuje v :other.',
    'integer' => ':attribute musí být celé číslo.',
    'ip' => ':attribute musí být validní IP adresa.',
    'ipv4' => ':attribute musí být validní IPv4 adresa.',
    'ipv6' => ':attribute musí být validní IPv6 adresa.',
    'json' => ':attribute musí být validní JSON řetězec.',
    'lt' => [
        'numeric' => ':attribute musí být menší než :value.',
        'file' => ':attribute musí být menší než :value kilobytů.',
        'string' => ':attribute musí být menší než :value charakterů.',
        'array' => ':attribute musí mít míň než :value předmětů.',
    ],
    'lte' => [
        'numeric' => ':attribute musí být menší nebo rovno než :value.',
        'file' => ':attribute musí být menší nebo rovno než :value kilobytů.',
        'string' => ':attribute musí být menší nebo rovno než :value charakterů.',
        'array' => ':attribute nesmí mít více než :value předmětů.',
    ],
    'max' => [
        'numeric' => ':attribute nesmí být větší než :max.',
        'file' => ':attribute nesmí být větší než :max kilobytů.',
        'string' => ':attribute nesmí být větší než :max charakterů.',
        'array' => ':attribute nesmí mít více než :max předmětů.',
    ],
    'mimes' => ':attribute musí být soubor typu: :values.',
    'mimetypes' => ':attribute musí být soubor typu: :values.',
    'min' => [
        'numeric' => ':attribute musí mít aspoň :min.',
        'file' => ':attribute musí mít aspoň :min kilobytů.',
        'string' => ':attribute musí mít aspoň :min charakterů.',
        'array' => ':attribute musí mít aspoň :min předmětů.',
    ],
    'not_in' => 'Vybraný :attribute je neplatný.',
    'not_regex' => 'Formát :attribute je neplatný.',
    'numeric' => ':attribute musí být číslo.',
    'present' => 'Pole :attribute musí být přítomen.',
    'regex' => 'Formát :attribute je neplatný.',
    'required' => 'Pole :attribute je požadováno.',
    'required_if' => 'Pole :attribute je požadováno, když :other je :value.',
    'required_unless' => 'Pole :attribute je požadováno, když pokud :other je v :values.',
    'required_with' => 'Pole :attribute je požadováno, když :values je přítomen.',
    'required_with_all' => 'Pole :attribute je požadováno, když :values je přítomen.',
    'required_without' => 'Pole :attribute je požadováno, když :values není přítomen.',
    'required_without_all' => 'Pole :attribute je požadováno, když žádný z :values jsou přítomni.',
    'same' => ':attribute a :other musí se shodnout.',
    'size' => [
        'numeric' => ':attribute musí být :size.',
        'file' => ':attribute musí být :size kilobytů.',
        'string' => ':attribute musí být:size charakterů.',
        'array' => ':attribute musí obsahovat :size předmětů.',
    ],
    'string' => ':attribute musí být řetězec.',
    'timezone' => ':attribute musí být validní zóna.',
    'unique' => ':attribute je už zabraná.',
    'uploaded' => ':attribute se nepodařilo nahrát.',
    'url' => 'Formát :attribute je validní.',
    'uuid' => ':attribute musí být validní UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
