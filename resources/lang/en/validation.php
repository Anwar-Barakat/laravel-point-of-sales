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

    'accepted'          => 'The :attribute must be accepted.',
    'active_url'        => 'The :attribute is not a valid URL.',
    'after'             => 'The :attribute must be a date after :date.',
    'after_or_equal'    => 'The :attribute must be a date after or equal to :date.',
    'alpha'             => 'The :attribute may only contain letters.',
    'alpha_dash'        => 'The :attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num'         => 'The :attribute may only contain letters and numbers.',
    'array'             => 'The :attribute must be an array.',
    'before'            => 'The :attribute must be a date before :date.',
    'before_or_equal'   => 'The :attribute must be a date before or equal to :date.',
    'between'           => [
        'numeric'       => 'The :attribute must be between :min and :max.',
        'file'          => 'The :attribute must be between :min and :max kilobytes.',
        'string'        => 'The :attribute must be between :min and :max characters.',
        'array'         => 'The :attribute must have between :min and :max items.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'date' => 'The :attribute is not a valid date.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => 'The :attribute must be a valid email address.',
    'ends_with' => 'The :attribute must end with one of the following: :values.',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'The :attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'The :attribute must be an integer.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file' => 'The :attribute may not be greater than :max kilobytes.',
        'string' => 'The :attribute may not be greater than :max characters.',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'The :attribute must be at least :min characters.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'password' => 'The password is incorrect.',
    'present' => 'The :attribute field must be present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'The :attribute field is required.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid zone.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute format is invalid.',
    'uuid' => 'The :attribute must be a valid UUID.',

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

    'attributes' => [
        //_______________________
        // Settings
        //_______________________
        'company_name_ar'           => 'arabic company name',
        'company_name_en'           => 'english company name',
        'company_code'              => 'company code',
        'address'                   => 'address',
        'mobile'                    => 'mobile',
        'is_active'                 => 'status',
        'current_password'          => 'current password',
        'password_confirmation'     => 'password Confirmation',

        //_______________________
        // Admins
        //_______________________
        'name'          => 'name',
        'bio'           => 'bio',
        'email'         => 'email',
        'password'      => 'password',
        'status'        => 'status',


        //_______________________
        // Treasuries
        //_______________________
        'is_master'             => 'treasury type',
        'last_payment_receipt'  => 'last payment receipt',
        'last_payment_collect'  => 'last payment collect',
        'treasury_name_ar'      => 'arabic treasury name',
        'treasury_name_en'      => 'english treasury name',
        'treasury_delivery_id'  => 'treasury delivery',
        'name_ar'               => 'arabic name',
        'name_en'               => 'english name',



        //_______________________
        // Categories
        //_______________________
        'section_id'            => 'section',
        'parent_id'             => 'category parent',
        'description'           => 'description',
        'photo'                 => 'photo',

        //_______________________
        // Items
        //_______________________
        'barcode'               => 'barcode',
        'item_name'             => 'item name',
        'category_id'           => 'category',
        'item_type'             => 'item type',
        'retail_unit_id'        => 'retail unit',
        'wholesale_unit_id'     => 'wholesale unit',
        'has_retail_unit'       => 'item has retails unit?',
        'wholesale_cost_price'  => 'wholesale cost price',
        'retail_cost_price'     => 'retail cost price',
        'has_fixed_price'       => 'has fixed price for invoices',

        'retail_count_for_wholesale'        => 'retail unit count for one wholesale',
        'wholesale_price'                   => 'wholesale price',
        'wholesale_price_for_block'         => 'wholesale price for block',
        'wholesale_price_for_half_block'    => 'wholesale price for half block',
        'retail_price'                      => 'retail price',
        'retail_price_for_block'            => 'retail price for block',
        'retail_price_for_half_block'       => 'retail price for block',


        //_______________________
        // Accounts
        //_______________________
        'account_type_id'               => 'Account type',
        'account_number'                => 'Account number',
        'parent_id'                     => 'Account parent',
        'is_parent_account'             => 'Is it parent account',
        'parent_accounts'               => 'Parent accounts',
        'initial_balance'               => 'Initial balance',
        'initial_balance_status'        => 'Initial balance status',
        'current_balamce'               => 'Current balance',
        'is_archived'                   => 'Archived',
        'notes'                         => 'Notes',
        'is_parent'                     => 'Is parent',

        //_______________________
        // Orders
        //_______________________
        'vendor_id'                 => 'Vendor',
        'store_id'                  => 'Store',
        'item_id'                   => 'Item',
        'account_id'                => 'Account',
        'invoice_type'              => 'Invoice type',
        'invoice_date'              => 'Invoice date',
        'discount_type'             => 'Discount type',
        'discount'                  => 'discount',
        'tax_type'                  => 'Tax type',
        'tax'                       => 'Tax',
        'qty'                       => 'Quantity',
        'production_date'           => 'Production history',
        'expiration_date'           => 'Expiration date',
    ],

];
