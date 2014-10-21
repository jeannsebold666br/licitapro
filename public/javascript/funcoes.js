$(document).ready(function(){

    $("select").select2({
        placeholder: "--Selecione--",
        allowClear: true,
        width: 200
    });

    $('.date').datetimepicker({
        timepicker:false,
        format:'d/m/Y',
        mask: false,
        lang: 'pt'
    });

    $('.datetime').datetimepicker({
        format:'d/m/Y H:i:s',
        lang: 'pt'
    });

    $('.objetivo').popover().click(function(){
        return false;
    });

    /*tinymce.init({
        language: 'pt_BR',
        selector: "textarea",
        height: 300,
        plugins: [
            "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "table contextmenu directionality emoticons template textcolor paste fullpage textcolor colorpicker textpattern moxiemanager"
        ],

        toolbar1: "bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect | bullist numlist outdent indent | link unlink | media image insertfile | code",
        toolbar2: "undo redo | outdent indent blockquote | insertdatetime preview | forecolor backcolor | table | hr removeformat | subscript superscript | charmap emoticons | ltr rtl | spellchecker | visualchars visualblocks pagebreak",
        toolbar3: "",

        menubar: false,
        toolbar_items_size: 'small',

        style_formats: [
            {title: 'Bold text', inline: 'b'},
            {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
            {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
            {title: 'Example 1', inline: 'span', classes: 'example1'},
            {title: 'Example 2', inline: 'span', classes: 'example2'},
            {title: 'Table styles'},
            {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
        ],

        templates: [
            {title: 'Test template 1', content: 'Test 1'},
            {title: 'Test template 2', content: 'Test 2'}
        ]
    });*/
});
