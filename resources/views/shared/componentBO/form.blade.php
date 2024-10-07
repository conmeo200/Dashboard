<?php
$componentsForm = [
    'formID'    => 'CustomForm',
    'actionURL' => '',
    'method'    => 'POST',
    'field' => [
        'Name' => [
            'attribute' => [
                'name'        => 'txtName',
                'id'          => 'txtName',
                'tag'         => 'input',
                'type'        => 'text',
                'dataDefault' => '',
                'placeholder' => 'Please Enter Name',
                'option'      => [
                    'required',
                ]
            ]
        ],
        'Email' => [
            'attribute' => [
                'name'        => 'txtEmail',
                'id'          => 'txtEmail',
                'tag'         => 'input',
                'type'        => 'email',
                'placeholder' => 'Please Enter Email',
                'dataDefault' => '',
                'option'      => [
                    'required', 'email'
                ]
            ]
        ],
        'File' => [
            'attribute' => [
                'name'        => 'txtFile[]',
                'id'          => 'txtFile',
                'tag'         => 'input',
                'type'        => 'file',
                'dataDefault' => '',
                'placeholder' => 'Please Choose File',
                'option'      => [
                    'required',
                ]
            ]
        ],
        'Country' => [
            'attribute' => [
                'name'        => 'slcCountry',
                'id'          => 'slcCountry',
                'tag'         => 'select',
                'type'        => '',
                'dataDefault' => ['vn' => 'VietNam', 'ca' => 'Canada'],
                'placeholder' => 'Please Select Country',
                'option'      => [
                    'required'
                ]
            ]
        ],
        'Content' => [
            'attribute' => [
                'name'        => 'txtContent',
                'id'          => 'txtContent',
                'tag'         => 'textarea',
                'type'        => '',
                'dataDefault' => '',
                'placeholder' => 'Please Enter Content',
                'option'      => [
                    'required'
                ]
            ]
        ],
        'Active' => [
            'attribute' => [
                'name'        => 'slcActive',
                'id'          => 'slcActive',
                'tag'         => 'input',
                'type'        => 'checkbox',
                'dataDefault' => '',
                'option'      => [
                    'required'
                ]
            ]
        ]
    ]
];

?>
<style>
    .custom-form {
        width: 100%;
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #f9f9f9;
    }

    .custom-form label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
        color: #333;
    }

    /* Các input, textarea, select */
    .custom-form input[type="text"],
    .custom-form input[type="email"],
    .custom-form input[type="file"],
    .custom-form select,
    .custom-form textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        resize: vertical;
    }

    /* Hiển thị lỗi */
    .custom-form .error-msg {
        color: red;
        font-size: 0.9em;
    }

    /* Button */
    .custom-form button[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .custom-form button[type="submit"]:hover {
        background-color: #45a049;
    }


</style>
<form action="<?= $componentsForm['actionURL']?>" method="<?= $componentsForm['method']?>" id="<?= $componentsForm['formID']?>" class="custom-form">
    <?php foreach ($componentsForm['field'] as $key => $value) :?>
    <label><?= $key ?></label>
    <?php
    $attr    = $value['attribute'];
    $options = implode(' ', array_map(function($opt) {
        return "data-{$opt}='{$opt}'";
    }, $attr['option'] ?? []));

    switch ($attr['tag']) {
        case 'input':
            echo "<input name='{$attr['name']}' id='{$attr['id']}' type='{$attr['type']}' placeholder='{$attr['placeholder']}' value='{$attr['dataDefault']}' {$options}>";
            break;
        case 'textarea':
            echo "<textarea name='{$attr['name']}' id='{$attr['id']}' placeholder='{$attr['placeholder']}' {$options}>{$attr['dataDefault']}</textarea>";
            break;
        case 'select':
            echo "<select name='{$attr['name']}' id='{$attr['id']}' {$options}><option value='1'>Select 1</option><option value='2'>Select 2</option></select>";
            break;
        case 'radio':
            echo "<input type='radio' name='{$attr['name']}' id='{$attr['id']}' {$options}>";
            break;
    }
    ?>
    <br>
    <?php endforeach;?>
    <button type="submit">Submit</button>
</form>

