const BASE_URL = "http://localhost/Curso_CodeIgniter/";

//tradução do DataTables para Português-----------------------------
const DATATABLE_PTBR = { 
    "sEmptyTable": "Nenhum registro encontrado",
    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
    "sInfoPostFix": "",
    "sInfoThousands": ".",
    "sLengthMenu": "_MENU_ resultados por página",
    "sLoadingRecords": "Carregando...",
    "sProcessing": "Processando...",
    "sZeroRecords": "Nenhum registro encontrado",
    "sSearch": "Pesquisar",
    "oPaginate": {
        "sNext": "Próximo",
        "sPrevious": "Anterior",
        "sFirst": "Primeiro",
        "sLast": "Último"
    },
    "oAria": {
        "sSortAscending": ": Ordenar colunas de forma ascendente",
        "sSortDescending": ": Ordenar colunas de forma descendente"
    }
}//fim da tradução do DataTables -------------------------------------

function clearErrors() {
	$(".has-error").removeClass("has-error");
	$(".help-block").html("");
}

function showErrors(error_list) {
	clearErrors();

	$.each(error_list, function(id, message) {
		$(id).parent().parent().addClass("has-error");
		$(id).parent().siblings(".help-block").html(message)
	})
} 

function showErrorsModal(error_list) {
	clearErrors();

	$.each(error_list, function(id, message) {
		$(id).parent().parent().addClass("has-error");
		$(id).siblings(".help-block").html(message)
	})
} 

function loadingImg(message="") { //para mostrar animação de carregando (círculo girando)
	return "<i class='fa fa-circle-o-notch fa-spin'></i>&nbsp;" + message
}

function uploadImg(input_file, img, input_path) {

	src_before = img.attr("src");
	img_file = input_file[0].files[0];
	form_data = new FormData();

	form_data.append("image_file", img_file); //pega a imagem

	$.ajax({
		url: BASE_URL + "restrict/ajax_import_image", //para chamar o método ajax_import_image do Controller Restrict
		dataType: "json",
		cache: false,
		contentType: false,
		processData: false,
		data: form_data, //data recebe o formulário
		type: "POST",
		beforeSend: function() {
			clearErrors();
			input_path.siblings(".help-block").html(loadingImg("Carregando imagem...")); //mostra ao usuário status de carregando
		},
		success: function(response) {
			clearErrors();
			if (response["status"]) { //se o resultado status == true
				img.attr("src", response["img_path"]);
				input_path.val(response["img_path"]); //quando salvar o formulário esse campo será enviado

			} else { //se deu erro
				img.attr("src", src_before);
				input_path.siblings(".help-block").html(response["error"]); //mostra mensagem de erro
			}
		},
		error: function() { //erro genérico
			img.attr("src", src_before); //volta para a imagem já carregada, para não precisar carregar de novo
		}
	})

}