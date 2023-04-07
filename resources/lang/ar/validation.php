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

    'accepted' => 'The :attribute must be accepted.',
    'active_url' => 'The :attribute is not a valid URL.',
    'after' => 'The :attribute must be a date after :date.',
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'alpha' => 'The :attribute may only contain letters.',
    'alpha_dash' => 'The :attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute may only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'string' => 'The :attribute must be between :min and :max characters.',
        'array' => 'The :attribute must have between :min and :max items.',
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
        'numeric' => 'حقل :attribute على الأقل :min.',
        'file' => 'حقل :attribute على الأقل :min كيلوبايت.',
        'string' => 'حقل :attribute على الأقل :min محارف.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'password' => 'The password is incorrect.',
    'present' => 'The :attribute field must be present.',
    'regex' => 'تنسيق حقل :attribute غير صالح.',
    'required' => 'حقل :attribute مطلوب.',
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
    'unique' => 'الحقل :attribute موجود مسبقاً.',
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
        //? settings table
        'company_name_ar'           => 'اسم الشركة بالعربي',
        'company_name_en'           => 'اسم الشركة بالانكليزي',
        'company_code'              => 'رمز الشركة',
        'address'                   => 'العنوان',
        'mobile'                    => 'الهاتف',
        'is_active'                 => 'نشط',
        'current_password'          => 'كلمة المرور الحالية',
        'password_confirmation'     => 'تأكيد كلمة المرور',

        //? admins table
        'name'          => 'الاسم',
        'bio'           => 'السيرة الذاتية',
        'email'         => 'البريد الألكتروني',
        'password'      => 'كلمة المرو',
        'status'        => 'الحالة',

        //? treasuries table
        'is_master'             => 'رئيسية',
        'is_active'             => 'مُفعلة',
        'last_payment_receipt'  => 'آخر إيصال دفع',
        'last_payment_collect'  => 'آخر إيصال تجميع',
        'treasury_name_ar'      => 'اسم الخزنة بالعربي',
        'treasury_name_en'      => 'اسم الخزنة بالأنكليزي',

        //? treasuries delivery table
        'treasury_delivery_id'  => 'الخزنة المسلم',
        'name_ar'               => 'الاسم بالعربي',
        'name_en'               => 'الاسم بالأنكليزي',

        //? categories
        'section_id'            => 'القسم',
        'category_id'           => 'الفئة',
        'parent_id'             => 'فئة الأب',
        'description'           => 'الوصف',
        'photo'                 => 'صورة',

        //? card items
        'barcode'               => 'باركود',
        'item_name'             => 'اسم الصنف',
        'item_type'             => 'نوع الصنف',
        'item_category'         => 'فئة الصنف',
        'has_retail_unit'       => 'الصنف يحوي واحدة تجزئة؟',
        'retail_unit_id'        => 'وحدة تجزئة',
        'wholesale_unit_id'     => 'وحدة جملة',
        'cost_price'            => 'سعر التكلفة',
        'wholesale_cost_price'  => 'سعر تكلفة الشراء للوحدة الرئيسية',
        'retail_cost_price'     => 'سعر تكلفة الشراء للوحدة التجزئة',
        'has_fixed_price'       => 'لديه سعر ثابت للفواتير؟',

        'wholesale_retail_prices'           => 'أسعار الجمل والتجزئة',
        'retail_count_for_wholesale'        => 'عدد وحدات التجزئة في وحدة الرئيسية',
        'wholesale_price'                   => 'سعر الجملة',
        'wholesale_price_for_block'         => 'سعر الجملة لوحدة قياس الرئيسية',
        'wholesale_price_for_half_block'    => 'سعر النصف جملة لوحدة قياس الرئيسية',
        'retail_price'                      => 'سعر التجزئة',
        'retail_price_for_block'            => 'سعر الجملة لوحدة قياس التجزئة',
        'retail_price_for_half_block'       => 'سعر النصف جملة لوحدة قياس التجزئة',


        'account_type_id'               => 'نوع الحساب',
        'account_number'                => 'رقم الحساب',
        'parent_id'                     => 'الحساب الأب',
        'parent_accounts'               => 'الحسابات الأب',
        'initial_balance'               => 'الرصيد الأبتدائي',
        'initial_balance_status'        => 'حالة الرصيد الأبتدائي',
        'current_balamce'               => 'الرصيد الحالي',
        'is_archived'                   => 'مؤرشف',
        'notes'                         => 'الملاحظات',
        'is_parent'                     => 'هل أب',

    ],

];
