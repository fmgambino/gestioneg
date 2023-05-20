$(function () {
    //$("#celular").mask("(00)00000-0000")
    $("#cep").mask("0000")
    $('#cpfUser').mask('00-00000000-00', { reverse: true });
    $('.cnpjEmitente').mask('00-00000000-00', { reverse: true });
});

$(function () {
    if ($('.cpfcnpjmine').val() != null) {
        if ($('.cpfcnpjmine').val() != "") {
            $(".cpfcnpjmine").prop('readonly', true);
        }
    }
    if ($('.cpfUser').val() != null) {
        var cpfUser = $('.cpfUser').val().length;
        if (cpfUser == "14") {
            $(".cpfUser").prop('readonly', true);
        }
    }
});

$(function () {
    var telefoneN = function (val) {
        var len = val.replace(/\D/g, '').length
        if (len > 0 && len < 9) {
            return '(00)0000-0000'
        } else if(len > 9 && len < 10) {
            return '(000)0000-0000'
        } else {
            return '(0000)00-00-00'
        }
    },
        telefoneOptions = {
            onKeyPress: function (val, e, field, options) {
                field.mask(telefoneN.apply({}, arguments), options);
            },
        };
    $('#telefone').mask(telefoneN, telefoneOptions);
    $('#telefone').on('paste', function (e) {
        e.preventDefault();
        var clipboardCurrentData = (e.originalEvent || e).clipboardData.getData('text/plain');
        $('#telefone').val(clipboardCurrentData);
    });

    $('#celular').mask(telefoneN, telefoneOptions);
    $('#celular').on('paste', function (e) {
        e.preventDefault();
        var clipboardCurrentData = (e.originalEvent || e).clipboardData.getData('text/plain');
        $('#telefone').val(clipboardCurrentData);
    });
});

$(function () {
    // INICIO FUNÇÃO DE MASCARA CPF/CNPJ
    var cpfMascara = function (val) {
        //return val.replace(/\D/g, '').length > 11 ? '00.000.000/0000-00' : '000.000.000-009';
        return '00-00000000-00';
    },
        cpfOptions = {
            onKeyPress: function (val, e, field, options) {
                field.mask(cpfMascara.apply({}, arguments), options);
            },
        };
    $('.cpfcnpj').mask(cpfMascara, cpfOptions);
    $('.cpfcnpj').on('paste', function (e) {
        e.preventDefault();
        var clipboardCurrentData = (e.originalEvent || e).clipboardData.getData('text/plain');
        $('.cpfcnpj').val(clipboardCurrentData);
    });
    // FIM FUNÇÃO DE MASCARA CPF/CNPJ
});

$(document).ready(function () {
    if ($("[name='idClientes']").val()) {
        $("#nomeCliente").focus();
    } else {
        $("#documento").focus();
    }

    function capitalizeFirstLetter(string) {
        if (typeof string === 'undefined') {
            return;
        }

        return string.charAt(0).toUpperCase() + string.slice(1).toLocaleLowerCase();
    }

    function capital_letter(str) {
        if (typeof str === 'undefined') { return; }
        str = str.toLocaleLowerCase().split(" ");

        for (var i = 0, x = str.length; i < x; i++) {
            str[i] = str[i][0].toUpperCase() + str[i].substr(1);
        }

        return str.join(" ");
    }
});
