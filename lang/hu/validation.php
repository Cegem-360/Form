<?php

declare(strict_types=1);

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

    'accepted' => 'A(z) :attribute mezőt el kell fogadni.',
    'accepted_if' => 'A(z) :attribute mezőt el kell fogadni, ha :other értéke :value.',
    'active_url' => 'A(z) :attribute mezőnek érvényes URL-nek kell lennie.',
    'after' => 'A(z) :attribute mezőnek :date utáni dátumnak kell lennie.',
    'after_or_equal' => 'A(z) :attribute mezőnek :date utáni vagy azzal megegyező dátumnak kell lennie.',
    'alpha' => 'A(z) :attribute mező csak betűket tartalmazhat.',
    'alpha_dash' => 'A(z) :attribute mező csak betűket, számokat, kötőjeleket és aláhúzásjeleket tartalmazhat.',
    'alpha_num' => 'A(z) :attribute mező csak betűket és számokat tartalmazhat.',
    'any_of' => 'A(z) :attribute mező érvénytelen.',
    'array' => 'A(z) :attribute mezőnek tömbnek kell lennie.',
    'ascii' => 'A(z) :attribute mező csak egybájtos alfanumerikus karaktereket és szimbólumokat tartalmazhat.',
    'before' => 'A(z) :attribute mezőnek :date előtti dátumnak kell lennie.',
    'before_or_equal' => 'A(z) :attribute mezőnek :date előtti vagy azzal megegyező dátumnak kell lennie.',
    'between' => [
        'array' => 'A(z) :attribute mezőnek :min és :max elem között kell lennie.',
        'file' => 'A(z) :attribute mezőnek :min és :max kilobájt között kell lennie.',
        'numeric' => 'A(z) :attribute mezőnek :min és :max között kell lennie.',
        'string' => 'A(z) :attribute mezőnek :min és :max karakter között kell lennie.',
    ],
    'boolean' => 'A(z) :attribute mező csak igaz vagy hamis lehet.',
    'can' => 'A(z) :attribute mező jogosulatlan értéket tartalmaz.',
    'confirmed' => 'A(z) :attribute és :other mező nem egyezik.',
    'contains' => 'A(z) :attribute mezőből hiányzik egy kötelező érték.',
    'current_password' => 'A jelszó helytelen.',
    'date' => 'A(z) :attribute mezőnek érvényes dátumnak kell lennie.',
    'date_equals' => 'A(z) :attribute mezőnek :date dátummal egyezőnek kell lennie.',
    'date_format' => 'A(z) :attribute mezőnek meg kell egyeznie a következő formátummal: :format.',
    'decimal' => 'A(z) :attribute mezőnek :decimal tizedesjegyet kell tartalmaznia.',
    'declined' => 'A(z) :attribute mezőt el kell utasítani.',
    'declined_if' => 'A(z) :attribute mezőt el kell utasítani, ha :other értéke :value.',
    'different' => 'A(z) :attribute és :other mezőknek különbözniük kell.',
    'digits' => 'A(z) :attribute mezőnek :digits számjegyből kell állnia.',
    'digits_between' => 'A(z) :attribute mezőnek :min és :max számjegy között kell lennie.',
    'dimensions' => 'A(z) :attribute mező érvénytelen képmérettel rendelkezik.',
    'distinct' => 'A(z) :attribute mező ismétlődő értéket tartalmaz.',
    'doesnt_end_with' => 'A(z) :attribute mező nem végződhet a következők egyikével: :values.',
    'doesnt_start_with' => 'A(z) :attribute mező nem kezdődhet a következők egyikével: :values.',
    'email' => 'A(z) :attribute mezőnek érvényes e-mail címnek kell lennie.',
    'ends_with' => 'A(z) :attribute mezőnek a következők egyikével kell végződnie: :values.',
    'enum' => 'A kiválasztott :attribute érvénytelen.',
    'exists' => 'A kiválasztott :attribute érvénytelen.',
    'extensions' => 'A(z) :attribute mezőnek a következő kiterjesztések egyikével kell rendelkeznie: :values.',
    'file' => 'A(z) :attribute mezőnek fájlnak kell lennie.',
    'filled' => 'A(z) :attribute mezőnek tartalmaznia kell értéket.',
    'gt' => [
        'array' => 'A(z) :attribute mezőnek több mint :value elemet kell tartalmaznia.',
        'file' => 'A(z) :attribute mezőnek nagyobbnak kell lennie, mint :value kilobájt.',
        'numeric' => 'A(z) :attribute mezőnek nagyobbnak kell lennie, mint :value.',
        'string' => 'A(z) :attribute mezőnek nagyobbnak kell lennie, mint :value karakter.',
    ],
    'gte' => [
        'array' => 'A(z) :attribute mezőnek legalább :value elemet kell tartalmaznia.',
        'file' => 'A(z) :attribute mezőnek legalább :value kilobájtnak kell lennie.',
        'numeric' => 'A(z) :attribute mezőnek legalább :value-nek kell lennie.',
        'string' => 'A(z) :attribute mezőnek legalább :value karakternek kell lennie.',
    ],
    'hex_color' => 'A(z) :attribute mezőnek érvényes hexadecimális színnek kell lennie.',
    'image' => 'A(z) :attribute mezőnek képnek kell lennie.',
    'in' => 'A kiválasztott :attribute érvénytelen.',
    'in_array' => 'A(z) :attribute mezőnek léteznie kell a következőben: :other.',
    'integer' => 'A(z) :attribute mezőnek egész számnak kell lennie.',
    'ip' => 'A(z) :attribute mezőnek érvényes IP-címnek kell lennie.',
    'ipv4' => 'A(z) :attribute mezőnek érvényes IPv4-címnek kell lennie.',
    'ipv6' => 'A(z) :attribute mezőnek érvényes IPv6-címnek kell lennie.',
    'json' => 'A(z) :attribute mezőnek érvényes JSON karakterláncnak kell lennie.',
    'list' => 'A(z) :attribute mezőnek listának kell lennie.',
    'lowercase' => 'A(z) :attribute mezőnek kisbetűsnek kell lennie.',
    'lt' => [
        'array' => 'A(z) :attribute mezőnek kevesebb mint :value elemet kell tartalmaznia.',
        'file' => 'A(z) :attribute mezőnek kisebbnek kell lennie, mint :value kilobájt.',
        'numeric' => 'A(z) :attribute mezőnek kisebbnek kell lennie, mint :value.',
        'string' => 'A(z) :attribute mezőnek kisebbnek kell lennie, mint :value karakter.',
    ],
    'lte' => [
        'array' => 'A(z) :attribute mező nem tartalmazhat több mint :value elemet.',
        'file' => 'A(z) :attribute mezőnek legfeljebb :value kilobájtnak kell lennie.',
        'numeric' => 'A(z) :attribute mezőnek legfeljebb :value-nek kell lennie.',
        'string' => 'A(z) :attribute mezőnek legfeljebb :value karakternek kell lennie.',
    ],
    'mac_address' => 'A(z) :attribute mezőnek érvényes MAC-címnek kell lennie.',
    'max' => [
        'array' => 'A(z) :attribute mező nem tartalmazhat több mint :max elemet.',
        'file' => 'A(z) :attribute mező nem lehet nagyobb, mint :max kilobájt.',
        'numeric' => 'A(z) :attribute mező nem lehet nagyobb, mint :max.',
        'string' => 'A(z) :attribute mező nem lehet több, mint :max karakter.',
    ],
    'max_digits' => 'A(z) :attribute mező nem tartalmazhat több mint :max számjegyet.',
    'mimes' => 'A(z) :attribute mezőnek a következő típusúnak kell lennie: :values.',
    'mimetypes' => 'A(z) :attribute mezőnek a következő típusúnak kell lennie: :values.',
    'min' => [
        'array' => 'A(z) :attribute mezőnek legalább :min elemet kell tartalmaznia.',
        'file' => 'A(z) :attribute mezőnek legalább :min kilobájtnak kell lennie.',
        'numeric' => 'A(z) :attribute mezőnek legalább :min-nek kell lennie.',
        'string' => 'A(z) :attribute mezőnek legalább :min karakternek kell lennie.',
    ],
    'min_digits' => 'A(z) :attribute mezőnek legalább :min számjegyet kell tartalmaznia.',
    'missing' => 'A(z) :attribute mezőnek hiányzónak kell lennie.',
    'missing_if' => 'A(z) :attribute mezőnek hiányzónak kell lennie, ha :other értéke :value.',
    'missing_unless' => 'A(z) :attribute mezőnek hiányzónak kell lennie, kivéve ha :other értéke :value.',
    'missing_with' => 'A(z) :attribute mezőnek hiányzónak kell lennie, ha :values jelen van.',
    'missing_with_all' => 'A(z) :attribute mezőnek hiányzónak kell lennie, ha :values jelen vannak.',
    'multiple_of' => 'A(z) :attribute mezőnek a(z) :value többszörösének kell lennie.',
    'not_in' => 'A kiválasztott :attribute érvénytelen.',
    'not_regex' => 'A(z) :attribute mező formátuma érvénytelen.',
    'numeric' => 'A(z) :attribute mezőnek számnak kell lennie.',
    'password' => [
        'letters' => 'A(z) :attribute mezőnek tartalmaznia kell legalább egy betűt.',
        'mixed' => 'A(z) :attribute mezőnek tartalmaznia kell legalább egy nagy- és egy kisbetűt.',
        'numbers' => 'A(z) :attribute mezőnek tartalmaznia kell legalább egy számot.',
        'symbols' => 'A(z) :attribute mezőnek tartalmaznia kell legalább egy szimbólumot.',
        'uncompromised' => 'A megadott :attribute szerepel egy adatszivárgásban. Kérjük, válasszon másikat.',
    ],
    'present' => 'A(z) :attribute mezőnek jelen kell lennie.',
    'present_if' => 'A(z) :attribute mezőnek jelen kell lennie, ha :other értéke :value.',
    'present_unless' => 'A(z) :attribute mezőnek jelen kell lennie, kivéve ha :other értéke :value.',
    'present_with' => 'A(z) :attribute mezőnek jelen kell lennie, ha :values jelen van.',
    'present_with_all' => 'A(z) :attribute mezőnek jelen kell lennie, ha :values jelen vannak.',
    'prohibited' => 'A(z) :attribute mező tiltott.',
    'prohibited_if' => 'A(z) :attribute mező tiltott, ha :other értéke :value.',
    'prohibited_if_accepted' => 'A(z) :attribute mező tiltott, ha :other elfogadott.',
    'prohibited_if_declined' => 'A(z) :attribute mező tiltott, ha :other elutasított.',
    'prohibited_unless' => 'A(z) :attribute mező tiltott, kivéve ha :other szerepel a következők között: :values.',
    'prohibits' => 'A(z) :attribute mező tiltja, hogy :other jelen legyen.',
    'regex' => 'A(z) :attribute mező formátuma érvénytelen.',
    'required' => 'A(z) :attribute mező kitöltése kötelező.',
    'required_array_keys' => 'A(z) :attribute mezőnek tartalmaznia kell a következő bejegyzéseket: :values.',
    'required_if' => 'A(z) :attribute mező kitöltése kötelező, ha :other értéke :value.',
    'required_if_accepted' => 'A(z) :attribute mező kitöltése kötelező, ha :other elfogadott.',
    'required_if_declined' => 'A(z) :attribute mező kitöltése kötelező, ha :other elutasított.',
    'required_unless' => 'A(z) :attribute mező kitöltése kötelező, kivéve ha :other szerepel a következők között: :values.',
    'required_with' => 'A(z) :attribute mező kitöltése kötelező, ha :values jelen van.',
    'required_with_all' => 'A(z) :attribute mező kitöltése kötelező, ha :values jelen vannak.',
    'required_without' => 'A(z) :attribute mező kitöltése kötelező, ha :values nincs jelen.',
    'required_without_all' => 'A(z) :attribute mező kitöltése kötelező, ha egyik :values sincs jelen.',
    'same' => 'A(z) :attribute mezőnek meg kell egyeznie a(z) :other mezővel.',
    'size' => [
        'array' => 'A(z) :attribute mezőnek :size elemet kell tartalmaznia.',
        'file' => 'A(z) :attribute mezőnek :size kilobájtnak kell lennie.',
        'numeric' => 'A(z) :attribute mezőnek :size-nak kell lennie.',
        'string' => 'A(z) :attribute mezőnek :size karakternek kell lennie.',
    ],
    'starts_with' => 'A(z) :attribute mezőnek a következők egyikével kell kezdődnie: :values.',
    'string' => 'A(z) :attribute mezőnek karakterláncnak kell lennie.',
    'timezone' => 'A(z) :attribute mezőnek érvényes időzónának kell lennie.',
    'unique' => 'A(z) :attribute már foglalt.',
    'uploaded' => 'A(z) :attribute feltöltése nem sikerült.',
    'uppercase' => 'A(z) :attribute mezőnek nagybetűsnek kell lennie.',
    'url' => 'A(z) :attribute mezőnek érvényes URL-nek kell lennie.',
    'ulid' => 'A(z) :attribute mezőnek érvényes ULID-nek kell lennie.',
    'uuid' => 'A(z) :attribute mezőnek érvényes UUID-nek kell lennie.',

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
            'rule-name' => 'egyedi-üzenet',
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
