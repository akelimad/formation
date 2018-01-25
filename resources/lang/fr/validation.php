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

    'accepted'             => 'Le :attribute doit être accepted.',
    'active_url'           => 'Le :attribute is not a valid URL.',
    'after'                => 'Le :attribute doit être une date aprés :date.',
    'alpha'                => 'Le :attribute ne peut contenir que des lettres.',
    'alpha_dash'           => 'Le :attribute ne peut contenir que des lettres, numéros, et les -.',
    'alpha_num'            => 'Le :attribute ne peut contenir que des letters et numéros.',
    'array'                => 'Le :attribute doit être un tableau.',
    'before'               => 'Le :attribute doit être une date avant :date.',
    'between'              => [
        'numeric' => 'Le :attribute doit être entre :min et :max.',
        'file'    => 'Le :attribute doit être entre :min et :max KB.',
        'string'  => 'Le :attribute doit être entre :min et :max characters.',
        'array'   => 'Le :attribute must have entre :min et :max items.',
    ],
    'boolean'              => 'Le :attribute champs doit être vrai or faux.',
    'confirmed'            => 'Le :attribute la confirmation ne correspond pas.',
    'date'                 => 'Le :attribute ce n\'est pas une date valide.',
    'date_format'          => 'Le :attribute ne correspond pas au format :format.',
    'different'            => 'Le :attribute et :other doit être different.',
    'digits'               => 'Le :attribute doit être :digits digits.',
    'digits_between'       => 'Le :attribute doit être entre :min et :max digits.',
    'distinct'             => 'Le :attribute champs a une value dupliquée.',
    'email'                => 'Le :attribute doit être une addresse email valide',
    'exists'               => 'Le selected :attribute est invalide.',
    'filled'               => 'Le :attribute champs est obligatoire.',
    'image'                => 'Le :attribute doit être une image.',
    'in'                   => 'Le selected :attribute est invalide.',
    'in_array'             => 'Le :attribute champs n\'existe pas dans :other.',
    'integer'              => 'Le :attribute doit être un entier.',
    'ip'                   => 'Le :attribute doit être a valid IP address.',
    'json'                 => 'Le :attribute doit être a valid JSON string.',
    'max'                  => [
        'numeric' => 'Le :attribute ne peut pas être suppérieur à :max.',
        'file'    => 'Le :attribute ne peut pas être suppérieur à :max KB.',
        'string'  => 'Le :attribute ne peut pas être suppérieur à :max characters.',
        'array'   => 'Le :attribute may not have more than :max items.',
    ],
    'mimes'                => 'Le :attribute doit être a file of type: :values.',
    'min'                  => [
        'numeric' => 'Le :attribute doit être au moins :min.',
        'file'    => 'Le :attribute doit être au moins :min KB.',
        'string'  => 'Le :attribute doit être au moins :min characters.',
        'array'   => 'Le :attribute must have au moins :min items.',
    ],
    'not_in'               => 'The selected :attribute est invalide.',
    'numeric'              => 'Le :attribute doit être un numéro.',
    'present'              => 'Le :attribute champs doit être present.',
    'regex'                => 'Le :attribute format est invalide.',
    'required'             => 'Le :attribute champs est obligatoire.',
    'required_if'          => 'Le :attribute champs est obligatoire when :other is :value.',
    'required_unless'      => 'Le :attribute champs est obligatoire unless :other is in :values.',
    'required_with'        => 'Le :attribute champs est obligatoire when :values is present.',
    'required_with_all'    => 'Le :attribute champs est obligatoire when :values is present.',
    'required_without'     => 'Le :attribute champs est obligatoire when :values is not present.',
    'required_without_all' => 'Le :attribute champs est obligatoire when none of :values are present.',
    'same'                 => 'Le :attribute et :other must match.',
    'size'                 => [
        'numeric' => 'Le :attribute doit être :size.',
        'file'    => 'Le :attribute doit être :size KB.',
        'string'  => 'Le :attribute doit être :size characters.',
        'array'   => 'Le :attribute must contain :size items.',
    ],
    'string'               => 'Le :attribute doit être une chaine de caractères.',
    'timezone'             => 'Le :attribute doit être a valid zone.',
    'unique'               => 'Le :attribute existe déjà.',
    'url'                  => 'Le :attribute format est invalide.',

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
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
