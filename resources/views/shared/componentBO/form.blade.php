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
                'placeholder' => '',
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
            $checked = ($attr['type'] === 'checkbox' && !empty($attr['dataDefault'])) ? 'checked' : '';
            echo "<input name='{$attr['name']}' id='{$attr['id']}' type='{$attr['type']}' placeholder='{$attr['placeholder']}' value='{$attr['dataDefault']}' {$options} {$checked}>";
            echo "<span class='msg-{$attr['name']}'></span>";
            break;

        case 'textarea':
            echo "<textarea name='{$attr['name']}' id='{$attr['id']}' placeholder='{$attr['placeholder']}' {$options}>{$attr['dataDefault']}</textarea>";
            echo "<span class='msg-{$attr['name']}'></span>";
            break;
        case 'select':
            echo "<select name='{$attr['name']}' id='{$attr['id']}' {$options}>";

            foreach ($attr['dataDefault'] as $val => $text) {
                echo "<option value='{$val}'>{$text}</option>";
            }

            echo "</select>";
            echo "<span class='msg-{$attr['name']}'></span>";
            break;

        case 'radio':
            echo "<input type='radio' name='{$attr['name']}' id='{$attr['id']}' {$options}>";
            echo "<span class='msg-{$attr['name']}'></span>";
            break;
    }
    ?>
    <br>
    <?php endforeach;?>
    <button type="submit">Submit</button>
</form>

<script>
    $(document).ready(function() {
        // Khởi tạo mảng chứa thông tin các trường
        const formFields = [
                <?php foreach ($componentsForm['field'] as $key => $field) : ?>
            {
                id        : '<?= $field['attribute']['id'] ?>',
                name      : '<?= $field['attribute']['name'] ?>',
                className : '<?= $key ?>',
                options   : <?= json_encode($field['attribute']['option']) ?>
            },
            <?php endforeach; ?>
        ];
        console.log(formFields);
        const formValidator = FormValidator.getInstance();

        // Kiểm tra toàn bộ các trường
        $('#<?= $componentsForm['formID'] ?>').on('submit', function(event) {
            event.preventDefault();
            let isValid = true;

            formFields.forEach(field => {
                const $field = $('#' + field.id);
                const $class = $('.' + field.name);

                // Kiểm tra từng điều kiện trong `options`
                if (field.options.includes('required')) {
                    isValid &= formValidator.validateRequiredValue($field, $class, field.className);
                }
                if (field.options.includes('email')) {
                    isValid &= formValidator.validateRequiredEmail($field, $class, field.className);
                }

                // Thêm các điều kiện kiểm tra khác nếu cần
            });

            if (isValid) {
                this.submit(); // Nếu tất cả đều hợp lệ, submit form
            }
        });
    });
</script>

